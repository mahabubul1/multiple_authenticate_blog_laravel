<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
     public function  subscriberUser(Request $request){
         $this->validate($request,[
             'email' =>"required|email|unique:subscribers"
         ]);
         $subscribers = new  Subscriber ();
         $subscribers->email =$request->email;
         $subscribers->save();
         Toastr::Success(' Subscribe has been Successfully','Success');
          return  redirect()->back();
     }
}
