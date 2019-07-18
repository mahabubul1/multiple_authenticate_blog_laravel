@extends('layouts.backend.app')
@section('title','post/show')


@section("content")
    <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <a style="margin-bottom: 10px" class="btn btn-primary" href="{{route('author.post.index')}}">Back</a>

                    <div class="card">

                        <div class="header">
                            <h2> {{$post->title}} <small> Posted By <strong>{{$post->user->name}}</strong> on {{$post->created_at->toformatteddatestring ()}}</small></h2>
                        </div>
                        <div class="body">

                            {!! $post->description !!}

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">


                    @if($post->is_approved == true)


                     <button  style="margin-bottom: 10px" type="submit" class="btn btn-success" disabled="true">
                       <i class="material-icons">done</i> Approve

                     </button>

                     @else
                        <button  style="margin-bottom: 10px" type="submit" class="btn btn-success" disabled="true">
                            <i class="material-icons">done</i> Approved
                        </button>

                    @endif



                    <div class="card">
                        <div class="block-header bg-cyan">
                            <h2 style="text-align: center; padding: 10px 0px">Categories</h2>
                        </div>
                        <div class="body">

                            @foreach($categories as $category)
                                <span class="bg-cyan" style="margin: 0px 2px;">{{ $category->name}}</span>

                            @endforeach
                        </div>

                    </div>
                    <div class="card">
                        <div class="block-header bg-green">
                            <h2 style="text-align: center; padding: 10px 0px">Tags</h2>
                        </div>
                        <div class="body">

                            @foreach($tags as $tag)
                                <span style="margin: 0px 2px;" class="bg-green">{{ $tag->tagname}}</span>

                            @endforeach
                        </div>

                    </div>
                    <div class="card">
                        <div class="block-header bg-yellow">
                            <h2 style="text-align: center; padding: 10px 0px">Featured Images </h2>
                        </div>
                        <div class="body">

                            <img class="responsive-img thumbnail" src="{{Storage::disk('public')->url('post/'.$post->image)}}" alt="" width="100px" height="100px">
                        </div>

                    </div>

                 </div>
            </div>




    </div>

@endsection

