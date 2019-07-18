@extends('layouts.backend.app')
@section('title','post/update')
@push('css')
    <link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet">
@endpush

@section("content")
    <div class="container-fluid">
        <form action="{{route('author.post.update',$post->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="block-header">
                                <h4> Post Update</h4>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="title" value="{{$post->title}}" name="title" class="form-control">
                                    <label class="form-label">Post Title</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="file" id="image" name="image" class="form-control">

                                </div>
                            </div>

                            <div class="body">

                                <img class="responsive-img thumbnail" src="{{Storage::disk('public')->url('post/'.$post->image)}}" alt="" width="100px" height="100px">
                            </div>
                            <div class="form-group form-float">

                                <input type="checkbox" class="filled-in"  value="1"  {{($post->status==true) ?"checked":"" }}   id="ig_checkbox" id="publish" name="status">
                                <label for="ig_checkbox">Published</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="block-header">
                                <h4>Category and Tags</h4>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label >Select Category</label>
                                    <select name="categories[]" id="category" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"

                                            @foreach($post->categories as $postCategory)

                                                 {{$postCategory->id ==$category->id?"selected":""}}

                                                    @endforeach>

                                                {{$category->name}}


                                            </option>

                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <label >Select Tag</label>

                                    <select name="tags[]" id="tag" class="form-control show-tick" data-live-search="true" multiple>

                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}"

                                             @foreach($post->tags as $postTag)
                                                 {{$postTag->id==$tag->id?"selected": ""}}

                                             @endforeach

                                            >
                                                {{$tag->tagname}}</option>

                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <a href="{{route('author.post.index')}}" class="btn btn-danger m-t-15 waves-effect">Back</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                        </div>

                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="block-header">
                                <h4>Add Description</h4>
                            </div>
                            <div class="form-group form-float">
                                <textarea name="description" id="tinymce">{!!$post->description  !!} </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

@endsection

@push('js')

    <!-- Select Plugin Js -->
    <script src="{{asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/tinymce/tinymce.min.js')}}"></script>
    <!-- Custom Js -->

    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{asset('assets/backend/plugins/tinymce')}}';
        });
    </script>

@endpush