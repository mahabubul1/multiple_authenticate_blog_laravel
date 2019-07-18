<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
          $posts=  Post::with('user')->where(['status'=>1,'is_approved'=>1])->latest()->take(10)->get();
          $categories= Category::latest()->get();
          return view('layouts.frontend.home.home',compact('posts','categories'));


    }
}
