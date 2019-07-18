@extends('layouts.backend.app')
@section('title')
    @push('css')

    @endpush

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
                        <form action="{{route('admin.tag.update', $tagId->id)}}" method="post">
                            @csrf
                             @method("PUT")

                            <input type="hidden" name="_token" value="HMA2GDn1HOnTeUF2KF3fSCW5HvBYzai4Kx4tqM54">                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="name" name="tagname" value="{{$tagId->tagname}}" class="form-control">
                                    <label class="form-label">Tag Name</label>
                                </div>
                            </div>

                            <a href="http://127.0.0.1:8000/admin/tag" class="btn btn-danger m-t-15 waves-effect">Back</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Vertical Layout -->

    </div>

@endsection

@push('js')

@endpush