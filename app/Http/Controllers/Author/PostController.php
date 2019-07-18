<?php

namespace App\Http\Controllers\Author;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\authorNewPost;
use PhpParser\Node\Expr\New_;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $posts= Post::where('user_id',Auth::id())->latest()->get();

        return view('author.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories=Category::latest()->get();
        $tags = Tag::latest()->get();

        return view("author.post.create",compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $post= new Post();
        $this->validate($request,[
            'title'=>'required',
            'image'=>'required|image|mimes:jpg,jpeg,png',
            'description'=>'required',
            'categories'=>'required',
            'tags'=>"required"

        ]);

        $image=$request->file('image');
        $slug=str_slug($request->title);
        if($image){
            $currentDate=Carbon::now()->toDateString();

              $imageName= $slug."-".$currentDate."-".uniqid().'.'.$image->getClientOriginalExtension();

              if(!Storage::disk('public')->exists('post')){
                  Storage::disk('public')->makeDirectory('post');
              }

              $postImage= Image::make($image)->resize(1600,1066)->stream();

               Storage::disk('public')->put('post/'.$imageName,$postImage);
          }else{
            $post->image= "default.png";

           }

         $post->title=$request->title;
         $post->user_id=Auth::id();
         $post->slug=$slug;
         $post->description=$request->description;
         $post->image=$imageName;
         if($request->status){
             $post->status=true;
         }else{
             $post->status=true;
         }
         $post->is_approved=false;
         $post->save();

         $post->categories()->attach($request->categories);
         $post->tags()->attach($request->tags);
         $users = User::where('role_id',1)->get();

         Notification::send($users,  new authorNewPost($post) );

         Toastr::success("Post Save Successfully",'Success');
          return redirect()->route("author.post.index");


    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)

    {      if($post->user_id != Auth::id()   ){
               return redirect()->route('author.post.index');
           }
           $categories= Category::latest()->get();
           $tags =Tag::latest()->get();
           return view("author.post.show",compact('post', 'categories','tags'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post->user_id != Auth::id()   ){
            return redirect()->route('author.post.index');
        }
         $categories= Category::latest()->get();
         $tags= Tag::latest()->get();
         return view("author.post.edit",compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request,[
            'title'=>'required',
            'image'=>'image',
            'description'=>'required',
            'categories'=>'required',
            'tags'=>"required"

        ]);
        if($post->user_id != Auth::id()   ){
            return redirect()->route('author.post.index');
        }

        $image=$request->file('image');
        $slug=str_slug($request->title);
        if($image){
            $currentDate=Carbon::now()->toDateString();

            $imageName= $slug."-".$currentDate."-".uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('post')){
                Storage::disk('public')->makeDirectory('post');
            }


            if(Storage::disk('public')->exists('post/'.$post->image)){

                Storage::disk('public')->delete('post/'.$post->image);
            }
            $postImage= Image::make($image)->resize(1600,1066)->stream();

            Storage::disk('public')->put('post/'.$imageName,$postImage);
        }else{
            $imageName=$post->image;

        }

        $post->title=$request->title;
        $post->user_id=Auth::id();
        $post->slug=$slug;
        $post->description=$request->description;
        $post->image=$imageName;
        if($request->status){
            $post->status=true;
        }else{
            $post->status=false;
        }
        $post->is_approved=false;

        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success("Post Save Successfully",'Success');
        return redirect()->route("author.post.index");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        if($post->user_id != Auth::id()   ){
            return redirect()->route('author.post.index');
        }
        if(Storage::disk('public')->exists('post/'.$post->image)){
             Storage::disk('public')->delete('post/'.$post->image);
        }

        $post->categories()->detach();
        $post->tags()->detach();
        $post->delete();
        Toastr::Success("Post data delete Successfully","Success");
        return  redirect()->route("author.post.index");

    }
}
