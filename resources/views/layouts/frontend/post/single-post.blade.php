@extends('layouts.frontend.app')
@section('title',$post->title)

    @push('css')
        <link href="{{asset('assets/frontend/css/single-post/styles.css')}}" rel="stylesheet">
        <link href="{{asset('assets/frontend/css/single-pos/responsive.css')}}" rel="stylesheet">
        <style>
            .fovarite-post i{
                color:#e60808;
            }
            .slider{ height: 420px; width: 100%; background-size: cover; margin: 0;
                background-image: url({{Storage::disk('public')->url("post/".$post->image)}}); }
        </style>

    @endpush

@section("content")
    <div class="slider">
        <div class="display-table  center-text">
            <h1 class="title display-table-cell"><b></b></h1>
        </div>
    </div><!-- slider -->

    <section class="post-area section">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 col-md-12 no-right-padding">
                    <div class="main-post">
                        <div class="blog-post-inner">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="{{route('author.post',$post->user->username)}}"><img src="{{Storage::disk("public")->url('user/'.$post->user->image)}}" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{$post->user->name}}</b></a>
                                    <h6 class="date">{{$post->created_at->diffForHumans()}}</h6>
                                </div>

                            </div><!-- post-info -->

                            <h3 class="title"><a href="#"><b>{{$post->title}}</b></a></h3>

                            <p class="para"> {!!  substr($post->description,0,150) !!}</p>

                            <div class="post-image"><img src="{{Storage::disk("public")->url('post/'.$post->image)}}" alt="Blog Image"></div>

                            <p class="para"> {!!  substr($post->description,151,1500000) !!}</p>

                            <ul class="tags">
                                @foreach($post->tags as $tag)
                                     <li><a href="{{route('tag.post',$tag->slug)}}">{{$tag->tagname}}</a></li>
                                @endforeach

                            </ul>
                        </div><!-- blog-post-inner -->

                        <div class="post-icons-area">
                            <ul class="post-icons">
                                <li>
                                    @guest
                                        <a href="javascript:void(0);" onclick="Toastr::info('if you want to add favorite list, your need to login fast','Info',{

                                           closeButton : true,
                                           progressBar : true,

                                       })"><i class="ion-heart"></i>{{$post->favorite_to_users->count()}}</a>

                                    @else

                                        <a href="javascript:void(0);" onclick=" document.getElementById('favorite-form-{{$post->id}}').submit()"  class="{{!Auth::user()->favorite_posts->where("pivot.post_id",$post->id)->count()==0?"fovarite-post":'' }}" ><i class="ion-heart"></i>{{$post->favorite_to_users->count()}}</a>


                                        <form  id="favorite-form-{{$post->id}}"  method="post" action="{{route('favorite.post',$post->id)}}" style="display: none">
                                            @csrf
                                        </form>

                                    @endguest
                                </li>


                                <li><a href="#"><i class="ion-chatbubble"></i>{{$post->comments->count()}}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
                            </ul>

                            <ul class="icons">
                                <li>SHARE : </li>

                                     <div class="social-buttons">
                                         <a href="{{'https://www.facebook.com/sharer/sharer.php?u=urlencode("http://127.0.0.1:8000/".$post->title) '}}"
                                            target="_blank">
                                             <i class="material-icons">image</i>
                                             facebook
                                         </a>
                                     </div>


                                <li><a href="https://www.facebook.com/sharer/sharer.php?u=urlencode('http://127.0.0.1:8000/')}}"><i class="ion-social-twitter"></i>asdfasfa</a></li>
                            </ul>
                        </div>




                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 no-left-padding">

                    <div class="single-post info-area">

                        <div class="sidebar-area about-area">
                            <h4 class="title"><b>ABOUT Author</b></h4>
                            <p>{!! $post->user->about  !!}</p>
                        </div>



                        <div class="tag-area">

                            <h4 class="title"><b>Category CLOUD</b></h4>
                            <ul>

                                @foreach($post->categories as $category)
                                   <li><a href="{{route('category.post',$category->slug)}}">{{$category->name}}</a></li>

                                 @endforeach


                            </ul>

                        </div><!-- subscribe-area -->

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- post-area -->


    <section class="recomended-area section">
        <div class="container">
            <div class="row">
              @foreach($randomposts as $randompost)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img src="{{Storage::disk("public")->url("post/".$randompost->image)}}" alt="Blog Image"></div>

                            <a class="avatar" href="{{route('post.postDetails',$randompost->slug)}}"><img src="{{Storage::disk("public")->url("user/".$randompost->user->image)}}" alt="Profile Image"></a>

                            <div class="blog-info">

                                <h4 class="title"><a href="{{route('post.postDetails',$randompost->slug)}}"><b>How Did Van Gogh's Turbulent Mind Depict One of the Most Complex
                                            Concepts in Physics?</b></a></h4>

                                <ul class="post-footer">
                                    <li>
                                        @guest
                                            <a href="javascript:void(0);" onclick="Toastr::info('if you want to add favorite list, your need to login fast','Info',{

                                           closeButton : true,
                                           progressBar : true,

                                       })"><i class="ion-heart"></i>{{$post->favorite_to_users->count()}}</a>

                                        @else

                                            <a href="javascript:void(0);" onclick=" document.getElementById('favorite-form-{{$post->id}}').submit()"  class="{{!Auth::user()->favorite_posts->where("pivot.post_id",$post->id)->count()==0?"fovarite-post":'' }}" ><i class="ion-heart"></i>{{$post->favorite_to_users->count()}}</a>


                                            <form  id="favorite-form-{{$post->id}}"  method="post" action="{{route('favorite.post',$post->id)}}" style="display: none">
                                                @csrf
                                            </form>

                                        @endguest
                                    </li>


                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
                                </ul>

                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-md-6 col-sm-12 -->

               @endforeach


            </div><!-- row -->

        </div><!-- container -->
    </section>

    <section class="comment-section">
        <div class="container">
            <h4><b>POST COMMENT</b></h4>
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    @guest
                        <p style=" font-size:16px; font-weight:500"> if you want to comment this post . you need to login first <a style=" font-weight:600" href="{{route('login')}}">Login</a></p>
                    @else
                    <div class="comment-form">
                            <form method="post"  method="post" action="{{route('comment.store',$post->id)}}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
                                              placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                                    </div><!-- col-sm-12 -->
                                    <div class="col-sm-12">
                                        <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                    </div><!-- col-sm-12 -->

                                </div><!-- row -->
                            </form>

                    </div><!-- comment-form -->

                    @endguest
                    @if($post->comments->count() >0 )
                            <h4 style="margin-top: 10px"><b>COMMENTS({{$post->comments->count()}})</b></h4>
                            <div class="commnets-area ">

                                @foreach($post->comments as $comment)

                                <div class="comment">

                                    <div class="post-info">

                                        <div class="left-area">
                                            <a class="avatar" href="#"><img src="{{Storage::disk("public")->url("user/".$comment->user->image)}}" alt="Profile Image"></a>
                                        </div>

                                        <div class="middle-area">
                                            <a class="name" href="#"><b>{{$comment->user->name}}</b></a>
                                            <h6 class="date">on {{$comment->created_at->diffForHumans()}}</h6>
                                        </div>

                                    </div><!-- post-info -->

                                    <p>{!! $comment->comment  !!}</p>

                                </div>
                               @endforeach

                            </div><!-- commnets-area -->

                       @else

                            <div class="commnets-area ">

                                <div class="comment">
                                      <div class="text-center">No comment</div>
                                </div>
                            </div><!-- commnets-area -->
                       @endif



                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>



@endsection

@push('js')

@endpush