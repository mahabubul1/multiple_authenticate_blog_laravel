<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
     public  function  index(){
          $authors= User::Authors(1)->withCount(['posts','favorite_posts','comments'])->get();
          return view("admin.author.index",compact('authors'));
     }


     public  function  destroy($id){
          User::findOrfail($id)->delete();
          Toastr::success("Author delete has been successfully",'success');
          return redirect()->back();
     }
}
