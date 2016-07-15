<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use App\User;
use App\Cart;
use App\Order;
use App\OrderProduct;
use Auth;
use Session;
use Redirect;

class PaypalController extends Controller
{
    private $_api_context;
 
    public function __construct()
    {
        $this->middleware('auth');
        $config = \App\Payment::first();
        $settings = [
            'mode' => 'live',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path() . '/logs/paypal.log',
            'log.LogLevel' => 'FINE'
        ];
        $this->_api_context = new ApiContext(new OAuthTokenCredential($config->paypal_client_id, $config->paypal_secret));
        $this->_api_context->setConfig($settings);
    }

    public function postPayment()
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        
        $items = [];
        $num = 1;
        $total = 0;
        foreach (Auth::user()->cart as $item) {
            ${"item_".$num} = new Item();
            ${"item_".$num}->setName($item->product->name)
            ->setCurrency('USD')
            ->setQuantity($item->amount)
            ->setPrice($item->product->price);
            $items[] = ${"item_".$num};
            $num++;
            $total += $item->product->price*$item->amount;
        }
        if (Session::has('coupon')) {
            $discount = (($total*Session::get('coupon.discount'))/100);
            $total = $total-$discount;
            ${"item_".$num} = new Item();
            ${"item_".$num}->setName('discount')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(-$discount);
            $items[] = ${"item_".$num};
        }
        // add item to list
        $item_list = new ItemList();
        $item_list->setItems($items);
     
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($total);
     
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription(Auth::user()->email);
     
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('payment.status')) // Specify return URL
            ->setCancelUrl(route('home'));
            // ->setCancelUrl(route('payment.status'));
     
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
     
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occur, sorry for inconvenient');
            }
        }
     
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
     
        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());
     
        if (isset($redirect_url)) {
            // redirect to paypal
            return Redirect::away($redirect_url);
        }
     
        return Redirect('/')
            ->with('error', 'Unknown error occurred');
    }


    public function getPaymentStatus(Request $request)
    {
        // Get the payment ID before session clear
        $payment_id = Session::get('paypal_payment_id');
     
        // clear the session payment ID
        Session::forget('paypal_payment_id');
     
        if (!empty($request->PayerID) || !empty($request->token)) {
            return Redirect('/')
                ->with('error', 'Payment failed');
        }
     
        $payment = Payment::get($payment_id, $this->_api_context);
     
        // PaymentExecution object includes information necessary 
        // to execute a PayPal account payment. 
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);
     
        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);
     
        // echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later

        if ($result->getState() == 'approved') { // payment made
            $userCart = Auth::user()->cart;
            $total = 0;
            foreach ($userCart as $item) {
                $total += ($item->product->price)*($item->amount);
            }
            if (Session::has('coupon')) {
                $total = $total-(($total*Session::get('coupon.discount'))/100);
            }
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'amount' => $total,
                'status' => 'Processing',
                'firstname' => Session::get('shipping.firstname'),
                'lastname' => Session::get('shipping.lastname'),
                'shipping_address' => Session::get('shipping.address'),
                'shipping_city' => Session::get('shipping.city'),
                'shipping_zipcode' => Session::get('shipping.zipcode'),
                'shipping_country' => Session::get('shipping.country'),
                'payment_method' => 'Paypal',
                'phone' => Session::get('shipping.phone'),
                'coupon_id' => Session::get('coupon.id')
            ]);
            Session::forget('coupon');
            foreach ($userCart as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'options' => $item->options,
                    'amount' => $item->amount,
                ]);
                $item->product->quantity -= $item->amount;
                $item->product->save();
            }
            Auth::user()->cart()->delete();
            return Redirect('/dashboard')->with([
                'alert-success' => 'Paypal Payment success'
            ]);
        }
        return Redirect()->back()
            ->with('alert-error', 'Payment failed');
    }
}
