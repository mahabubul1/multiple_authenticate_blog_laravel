<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class favoriteController extends Controller
{

    public function  favoriteAdd($post){

        $users=  Auth::user();

        $favorite= $users->favorite_posts()->where("post_id",$post)->count();
         if($favorite ==0){
             $users->favorite_posts()->attach($post);
             Toastr::success('Favorite post has been successfully to your Favorite list','success');
             return redirect()->back();

         }else{

             $users->favorite_posts()->detach($post);
             Toastr::info('Favorite post has been remove successfully to your Favorite list','info');
             return redirect()->back();
         }



    }
}
