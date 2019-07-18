<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public  function index(){
        $posts= Post::latest()->where(['status'=>1,"is_approved"=>1])->paginate(12);
         return view("layouts.frontend.post.post",compact('posts'));
    }


     public  function  postDetails($slug){
         $post =Post::where(['slug'=>$slug])->first();

           $blogKey= "blog_".$post->id;

           if(!Session::has($blogKey)){
               $post->increment('view_count');
               Session::put($blogKey);
           }

         $randomposts=Post::latest()->where(["status"=>1,"is_approved"=>1])->take(3)->inRandomOrder()->get();
         return view('layouts.frontend.post.single-post',compact('post','randomposts'));

     }

     public function  postByCategory($slug){
          $categoryPost=  Category::where('slug',$slug)->first();
          $posts=$categoryPost->posts()->where(['status'=>1,'is_approved'=>1])->get();
        return view('layouts.frontend.post.category-post',compact('categoryPost','posts'));

     }

     public function tagByPost($slug){
       $tagByPost= Tag::where("slug",$slug)->first();
       $posts=$tagByPost->posts->where(['status'=>1,'is_approved'=>1])->get();

        return view("layouts.frontend.post.tag-post",compact('tagByPost','posts'));

     }








}
