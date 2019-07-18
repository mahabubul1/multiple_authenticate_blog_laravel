<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\Types\Compound;

class DashboardController extends Controller
{
     public function index(){
         $posts = Post::all();
         $all_popular_posts=Post::withCount(['favorite_to_users','comments'])
                               ->where(["status"=>1,'is_approved'=>1])
                               ->orderBy('view_count','desc')
                               ->orderBy('favorite_to_users_count')
                               ->orderBy('comments_count')
                               ->take(5)
                               ->get();
         $total_pending_post= Post::Approved(0)->count();
         $total_views= Post::sum('view_count');

         $total_authors= User::Authors(2)->count();
         $new_authors = User::Authors(2)->whereDate('created_at',Carbon::today())->count();

         $active_authors= User::Authors(2)
                           ->withCount(['posts','favorite_posts','comments'])
                           ->orderBy('posts_count','desc')
                           ->orderBy('favorite_posts_count','desc')
                           ->orderBy('comments_count','desc')
                           ->take(10)
                           ->get();

          $categories=Category::all()->count();
          $tags=Tag::all()->count();

        return view('admin.dashboard',compact('posts','all_popular_posts', 'all_popular_posts','total_pending_post','total_views','total_authors','new_authors','active_authors','categories','tags'));
     }
}
