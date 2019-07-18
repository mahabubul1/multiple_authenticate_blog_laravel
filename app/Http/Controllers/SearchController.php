<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
     public function searchResult(Request $request){

           $query=$request->input('query');
           $posts= Post::Where('title','like', "%$query%")
                ->where('status','=',1)
                ->where('is_approved','=',1)
                ->get();
           return view('layouts.frontend.post.search',compact('query','posts'));

     }
}
