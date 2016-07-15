<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Message;
use App\Section;
use App\Cart;
use Auth;
use Session;
use \Illuminate\Database\Eloquent\Collection;
use \Ecommerce\helperFunctions;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin', ['only' => [
            'delete',
        ]]);
    }

    public function show()
    {
        helperFunctions::getPageInfo($sections,$cart,$total);
        return view('site.contact', compact('sections', 'total', 'cart'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);
        $message = $request->all();
        $message['user_id'] = Auth::user()->id;
        Message::create($message);
        return \Redirect('/dashboard')->with([
            'alert-success' => 'Message Successfully Sent !'
        ]);
    }

    public function delete($id)
    {
        Message::destroy($id);
        return \Redirect('/admin/messages');
    }
}
