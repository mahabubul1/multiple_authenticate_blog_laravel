<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function  index(){
        $favoritePosts= Auth::user()->favorite_posts;
        return view("admin.favorite.index",compact('favoritePosts'));

    }
}
