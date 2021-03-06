<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function subscribe(Request $request)
    {
    	$this->validate($request, [
    		'email' => 'required|email|unique:subscribers'

    	]);

    	$subscriber = new Subscriber();
    	$subscriber->email = $request->email;
    	$subscriber->save();
    	Toastr::info('Your Subscription Will Success ;)', 'Success Message');
    	return redirect()->back();
    }
}
