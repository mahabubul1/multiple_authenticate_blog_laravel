<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function  authorByPost($username){
       $author= User::where('username',$username)->first();

       $posts= $author->posts()->where(['status'=>1,'is_approved'=>1])->paginate(10);

        return view('layouts.frontend.post.author-post',compact('author','posts'));


    }
}
