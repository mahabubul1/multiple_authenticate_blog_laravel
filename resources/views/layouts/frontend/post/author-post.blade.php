@extends('layouts.frontend.app')
@section('title')
     {{$author->username}}

@endsection
@push('css')
    <link href="{{asset('assets/frontend/css/category-sidebar/styles.css')}}" rel="stylesheet">
    <link href="{{asset('assets/frontend/css/category-sidebar/responsive.css')}}" rel="stylesheet">
    <style>
        .fovarite-post i{
            color:#e60808;
        }

    </style>
@endpush

@section("content")
    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>{{$author->name}}</b></h1>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="row">
                       @foreach($posts as $post)
                        <div class="col-md-6 col-sm-12">
                            <div class="card h-100">
                                <div class="single-post post-style-1">

                                    <div class="blog-image"><img src="{{Storage::disk('public')->url('post/'.$post->image)}}" alt="Blog Image"></div>

                                    <a class="avatar" href="{{route('post.postDetails',$post->slug)}}"><img src="{{Storage::disk('public')->url('user/'.$post->user->image)}}" alt="Profile Image"></a>

                                    <div class="blog-info">

                                        <h4 class="title"><a href="{{route('post.postDetails',$post->slug)}}"><b>How Did Van Gogh's Turbulent Mind Depict One of the Most Complex
                                                    Concepts in Physics?</b></a></h4>
                                        <ul class="post-footer">
                                            <li>
                                                @guest
                                                    <a href="javascript:void(0);" onclick="Toastr::info('if you want to add favorite list, your need to login fast','Info',{

                                                 closeButton : true,
                                                 progressBar : true,

                                          })">
                                                        <i class="ion-heart"></i>{{$post->favorite_to_users->count()}}</a>

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

                                    </div><!-- blog-info -->
                                </div><!-- single-post -->
                            </div><!-- card -->
                        </div><!-- col-md-6 col-sm-12 -->

                       @endforeach

                       {{$posts->links()}}

                    </div><!-- row -->


                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 ">

                    <div class="single-post info-area ">

                        <div class="about-area">
                            <h4 class="title"><b>ABOUT {{$author->name}} </b></h4>
                            <p>{!! $author->about !!}</p>
                        </div>
                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- section -->

@endsection

@push('js')

@endpush