<?php

namespace App\Http\Controllers\Admin;

use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscribeController extends Controller
{

    public function  index(){
      $subscribers=  Subscriber::latest()->get();
       return view ("admin.post.subscribe-index",compact('subscribers'));

    }


     public function  destroy($subscriber){

         Subscriber::findOrfail($subscriber)->delete();
         Toastr::success("Subscriber user delete successfully");

          return redirect()->route('admin.subscriber.index');

     }
}
