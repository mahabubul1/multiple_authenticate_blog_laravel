<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



///common
///



Route::get('/','HomeController@index');
Route::get('/post/{slug}','PostController@postDetails')->name("post.postDetails");
Route::get('/post','PostController@index')->name("post.index");
Route::get("category/{slug}",'PostController@postByCategory')->name('category.post');
Route::get("tag/{slug}",'PostController@tagByPost')->name('tag.post');
Route::get("/search",'SearchController@searchResult')->name('search');
Route::get("/profile/{username}",'AuthorController@authorByPost')->name('author.post');

Route::post('/subscribe','SubscribeController@subscriberUser')->name('subscribe.store');


 Route::group(["middleware"=>'auth'],function (){
        Route::post( "favorite/{post}/add","favoriteController@favoriteAdd")->name('favorite.post');
        Route::post("comment/{post}","CommentController@store")->name('comment.store');

 });


Auth::routes();


///admin

Route::group(['as'=>'admin.','prefix'=>'admin', 'namespace'=>'admin','middleware'=>['auth','admin'] ],function (){
      Route::get('dashboard', 'DashboardController@index')->name('dashboard');
      Route::resource('tag','TagController');
      Route::resource('category','CategoryController');
      Route::resource('post','PostController');

      Route::get('pending','PostController@pending')->name('pending');
      Route::put("post/{id}/approved" ,'PostController@approval')->name('post.approved');
      Route::get('/subscriber','SubscribeController@index')->name('subscriber.index');
      Route::delete('/subscriber/{subscriber}','SubscribeController@destroy')->name('subscriber.destroy');
      Route::get('/setting','settingController@index')->name('profile.setting');
      Route::put('/profile-update','settingController@updateProfile')->name('profile.update');
      Route::put('/password-update','settingController@updatePassword')->name('password.update');
      Route::get("/favorite/post",'FavoriteController@index')->name('favorite.post');
      Route::get("/comment",'CommentController@index')->name('commnet.index');
      Route::delete("/comment/{id}",'CommentController@destroy')->name('commnet.destroy');
      Route::get("/author",'AuthorController@index')->name('author.index');
      Route::delete("/author/{id}",'AuthorController@destroy')->name('author.destroy');

});


///author user

Route::group(['as'=>'author.','prefix'=>'author', 'namespace'=>'Author','middleware'=>['auth','author'] ],function (){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('post','PostController');
    Route::get("/favorite/post",'FavoriteController@index')->name('favorite.post');
    Route::get("/comment",'CommentController@index')->name('commnet.index');
    Route::delete("/comment/{id}",'CommentController@destroy')->name('commnet.destroy');

});



 View::composer('layouts.frontend.include.footer',function ($view){
     $categories= \App\Category::all();
     $view->with("categories",$categories);




 });


