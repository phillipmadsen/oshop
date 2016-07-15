<?php

namespace app\Http\Controllers\Auth;

use App\User;
use App\UserInfo;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use File;
use App\Section;
use Session;
use App\Cart;
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    protected $redirectTo = '/dashboard';
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        File::makeDirectory(public_path()."/content/".$user->username);
        File::makeDirectory(public_path()."/content/".$user->username."/photos/");
        $dest = public_path()."/content/".$user->username."/photos/profile.png";
        $file = public_path()."/img/profile.png";
        File::copy($file, $dest);
        UserInfo::create(["user_id" => $user->id, "photo" => "/content/".$user->username."/photos/profile.png"]);
        return $user;
    }

    public function getLogin()
    {
        $sections = Section::all();
        if (Auth::user()) {
            $cart = Auth::user()->cart;
        } else {
            $cart = new Collection;
            if (Session::has('cart')) {
                foreach (Session::get('cart') as $item) {
                    $elem = new Cart;
                    $elem->product_id = $item['product_id'];
                    $elem->amount = $item['qty'];
                    if (isset($item['options'])) {
                        $elem->options = $item['options'];
                    }
                    $cart->add($elem);
                }
            }
        }
        $total = 0;
        foreach ($cart as $item) {
            $total += $item->product->price*$item->amount;
        }
        return view('auth.login', compact('sections', 'total', 'cart'));
    }

    public function getRegister()
    {
        $sections = Section::all();
        if (Auth::user()) {
            $cart = Auth::user()->cart;
        } else {
            $cart = new Collection;
            if (Session::has('cart')) {
                foreach (Session::get('cart') as $item) {
                    $elem = new Cart;
                    $elem->product_id = $item['product_id'];
                    $elem->amount = $item['qty'];
                    if (isset($item['options'])) {
                        $elem->options = $item['options'];
                    }
                    $cart->add($elem);
                }
            }
        }
        $total = 0;
        foreach ($cart as $item) {
            $total += $item->product->price*$item->amount;
        }
        return view('auth.register', compact('sections', 'cart', 'total'));
    }

    public function moveCartToDB()
    {
        if (Session::has('cart')) {
            foreach (Session::get('cart') as $item) {
                if (count($cart = Cart::whereProduct_idAndUser_id($item['product_id'], Auth::user()->id)->first())) {
                    $cart->amount += $item['qty'];
                    $cart->save();
                } else {
                    $cart = new Cart;
                    $cart->user_id = Auth::user()->id;
                    $cart->product_id = $item['product_id'];
                    $cart->amount = $item['qty'];
                    if (isset($item['options'])) {
                        $cart->options = $item['options'];
                    }
                    $cart->save();
                }
            }
        }
    }

    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        $this->moveCartToDB();
        return redirect()->intended($this->redirectPath());
    }

    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        Auth::login($this->create($request->all()));
        $this->moveCartToDB();
        return redirect($this->redirectPath());
    }
}
