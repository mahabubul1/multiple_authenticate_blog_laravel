@extends('layouts.backend.app')
@section('title')

@section("content")
    <div class="container-fluid">
        <div class="block-header">
            <h2>FORM EXAMPLES</h2>
        </div>

        <!-- Vertical Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">

                    <div class="body">
                        <form action="{{route('admin.category.update', $categoryById->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="name" name="name" value="{{$categoryById->name}}" class="form-control">
                                    <label class="form-label">Category Name</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="file" id="image" name="image"  class="form-control">
                                    <a href="#"><img src="{{ asset('public/category/'.$categoryById->image)}}" alt=""></a>
                                </div>
                            </div>

                            <a href="http://127.0.0.1:8000/admin/category" class="btn btn-danger m-t-15 waves-effect">Back</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Vertical Layout -->

    </div>

@endsection
