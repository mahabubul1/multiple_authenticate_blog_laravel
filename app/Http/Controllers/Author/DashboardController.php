<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index(){


        $user =Auth::user();

        $posts =$user->posts;
        $all_popular_post=$user->posts()
            ->withCount('favorite_to_users')
            ->withCount('comments')
            ->orderBy('view_count','desc')
            ->orderBy('comments_count')
            ->orderBy('favorite_to_users_count')
            ->take(50)
            ->get();




        $user_pending_post=$user->posts()->where("is_approved",0)->count();
        $favorite_post=$user->favorite_posts()->count();
        $total_post_viewcount=$user->posts()->sum('view_count');
        return view('author.dashboard',compact('user','posts','all_popular_post','favorite_post','total_post_viewcount','user_pending_post'));
    }

}
