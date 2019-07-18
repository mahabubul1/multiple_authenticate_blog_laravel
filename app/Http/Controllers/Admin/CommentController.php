<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
     public function  index(){
         $comments= Comment::latest()->get();
         return view('admin.commnet.index',compact('comments'));

     }
     public function  destroy($id){

         Comment::findOrfail($id)->delete();
         Toastr::Success("commnet delete has been successfully");
         return redirect()->back();

     }
}
