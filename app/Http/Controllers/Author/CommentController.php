<?php

namespace App\Http\Controllers\Author;

use App\Comment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function  index(){
        $comments= Comment::latest()->where("user_id",Auth::id())->get();
        return view('author.commnet.index',compact('comments'));

    }
    public function  destroy($id){

        Comment::findOrfail($id)->delete();
        Toastr::Success("commnet delete has been successfully");
        return redirect()->back();

    }
}
