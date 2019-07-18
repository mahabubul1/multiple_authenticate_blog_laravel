<?php

namespace App\Http\Controllers;

use App\Comment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function  store(Request $request, $post){
         $this->validate($request,[
             "comment"=>'required',
         ]) ;


        $comments= new Comment ();
        $comments->post_id=$post;
        $comments->user_id=Auth::id();
        $comments->comment =$request->comment;
        $comments->save();

        Toastr::success('Comment  has been sent successfully','success');
          return redirect()->back();

    }
}
