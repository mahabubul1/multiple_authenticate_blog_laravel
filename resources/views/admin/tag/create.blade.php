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
                        <form action="{{route('admin.tag.store')}}" method="post">
                            @csrf
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="name" name="tagname" class="form-control">
                                    <label class="form-label">Tag Name</label>
                                </div>
                            </div>

                            <a href="{{route('admin.tag.index')}}" class="btn btn-danger m-t-15 waves-effect">Back</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Save</button>
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