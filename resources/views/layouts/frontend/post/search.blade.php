@extends('layouts.frontend.app')
@section('title')
    {{$query}}

@endsection

    @push('css')
        <link href="{{asset('assets/frontend/css/category/styles.css')}}" rel="stylesheet">
        <link href="{{asset('assets/frontend/css/category/responsive.css')}}" rel="stylesheet">
        <style>
            .fovarite-post i{
                color:#e60808;
            }

        </style>
    @endpush

@section("content")
    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b> {{$posts->count()}}  Result for  {{$query}}</b></h1>
    </div><!-- slider -->

    <section class="blog-area section">
        <div class="container">

            <div class="row">
             @if($posts->count()>0)
                @foreach($posts as $post)

                <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">

                            <div class="blog-image"><img src="{{Storage::disk('public')->url('post/'.$post->image)}}" alt="Blog Image"></div>

                            <a class="avatar" href="{{route('author.post',$post->user->username)}}"><img src="{{Storage::disk('public')->url('user/'.$post->user->image)}}" alt="Profile Image"></a>

                            <div class="blog-info">

                                <h4 class="title"><a href="{{route('post.postDetails',$post->slug)}}"><b>How Did Van Gogh's Turbulent Mind Depict One of the Most Complex
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


                                    <li><a href="#"><i class="ion-chatbubble"></i>{{$post->comments->count()}}</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
                                </ul>

                            </div><!-- blog-info -->
                        </div><!-- single-post -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                @endforeach

                @else
                    <div class="commnets-area ">

                        <div class="comment" style="text-align: center">
                            <div class="text-center">No found post</div>
                        </div>
                    </div><!-- commnets-area -->

                @endif


            </div><!-- row -->

        </div><!-- container -->
    </section><!-- section -->

@endsection

@push('js')

@endpush