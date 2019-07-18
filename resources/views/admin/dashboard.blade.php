@extends('layouts.backend.app')

@section('content')

        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Posts</div>
                            <div class="number count-to" data-from="0" data-to="{{$posts->count()}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">favorite</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Favorite</div>
                            <div class="number count-to" data-from="0" data-to="{{Auth::user()->favorite_posts()->count()}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">library_books</i>
                        </div>
                        <div class="content">
                            <div class="text">Pending Posts</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_pending_post}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">visibility</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Views</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_views}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->

            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-purple zoomIn  hover-expand-effect">
                        <div class="icon zoomIn">
                            <i class="material-icons">apps</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Categories</div>
                            <div class="number count-to" data-from="0" data-to="{{$categories}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                    <div class="info-box bg-grey zoomIn  hover-expand-effect">
                        <div class="icon zoomIn">
                            <i class="material-icons">label</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Tags</div>
                            <div class="number count-to" data-from="0" data-to="{{$categories}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                    <div class="info-box bg-deep-purple zoomIn  hover-expand-effect">
                        <div class="icon zoomIn">
                            <i class="material-icons">account_box</i>
                        </div>
                        <div class="content">
                            <div class="text">Tatol Authors</div>
                            <div class="number count-to" data-from="0" data-to="{{$total_authors}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                    <div class="info-box bg-deep-orange zoomIn  hover-expand-effect">
                        <div class="icon zoomIn">
                            <i class="material-icons">fiber_new</i>
                        </div>
                        <div class="content">
                            <div class="text">Taoday New Authors</div>
                            <div class="number count-to" data-from="0" data-to="{{$new_authors}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <div class="card">
                        <div class="header">
                            <h2> Popular Posts</h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>title</th>
                                        <th>Author</th>
                                        <th> <i class="material-icons">visibility</i></th>
                                        <th> <i class="material-icons">favorite</i></th>
                                        <th> <i class="material-icons">comment</i></th>
                                        <th>status</th>
                                        <th>action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                     @foreach($all_popular_posts as $keys=>$post)
                                      <tr>
                                        <td>{{$keys+1}}</td>
                                        <td>{{str_limit($post->title,20)}}</td>
                                        <td>{{$post->user->username}}</td>
                                        <td>{{$post->view_count}}</td>
                                        <td>{{$post->favorite_to_users_count}}</td>
                                        <td>{{$post->comments_count}}</td>
                                        <td>
                                            @if($post->status==1 && $post->is_approved==1)
                                                <span class="label bg-green">published</span>
                                             @else
                                                <span class="label bg-danger">pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-green" href="{{route('post.postDetails',$post->slug)}}"> <i class="material-icons">visibility</i> </a>
                                        </td>
                                      </tr>
                                      @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <div>

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Top 10 Active Authors</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Posts</th>
                                        <th>Author</th>
                                        <th> <i class="material-icons">favorite</i></th>
                                        <th> <i class="material-icons">comment</i></th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($active_authors as $keys=>$post)
                                        <tr>
                                            <td>{{$keys+1}}</td>
                                            <td>{{$post->posts_count}}</td>
                                            <td>{{$post->username}}</td>
                                            <td>{{$post->favorite_posts_count}}</td>
                                            <td>{{$post->comments_count}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->

            </div>
        </div>

@endsection
