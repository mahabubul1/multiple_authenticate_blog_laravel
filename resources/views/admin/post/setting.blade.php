@extends('layouts.backend.app')
@section('title','profile/setting')

    @push('css')

    @endpush

@section("content")
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-3">
                <div class="card profile-card">
                    <div class="profile-header">&nbsp;</div>
                    <div class="profile-body">

                        <div class="image-area">
                            <img src="{{Storage::disk('public')->url('user/'.$userprofile->image)}}" height="150" width="150">
                        </div>
                        <div class="content-area">
                            <h3>{{$userprofile->name}}</h3>
                            <p>Web Software Developer</p>
                            <p>Administrator</p>
                        </div>
                    </div>
                    <div class="profile-footer">
                        <ul>
                            <li>
                                <span>Total Post</span>
                                <span>1.234</span>
                            </li>
                            <li>
                                <span>Following</span>
                                <span>1.201</span>
                            </li>

                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-sm-9">
                <div class="card">
                    <div class="body">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
                                <li role="presentation"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
                                <li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Change Password</a></li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home">
                                    <div class="panel panel-default panel-post">

                                    </div>

                                </div>
                                <div role="tabpanel" class="tab-pane fade in" id="profile_settings">
                                    <form class="form-horizontal" method="post" action="{{route('admin.profile.update')}}" enctype="multipart/form-data">
                                        @method("PUT")
                                        @csrf
                                        <div class="form-group">
                                            <label for="NameSurname" class="col-sm-2 control-label">User Name</label>
                                            <div class="col-sm-10">
                                                <div class="form-line focused">
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="Name Surname" value="{{Auth::user()->username}}" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Email" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                                <div class="form-line focused">
                                                    <input type="email" class="form-control" id="Email" name="email" placeholder="Email" value="{{Auth::user()->email}}" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Email" class="col-sm-2 control-label">Profile Image</label>
                                            <div class="col-sm-10">
                                                <div class="form-line focused">
                                                    <input type="file" class="form-control" id="image" name="image" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Email" class="col-sm-2 control-label">About Me</label>
                                            <div class="col-sm-10">
                                                <div class="form-line focused" name="about">
                                                    <textarea  name="about" id="tinymce">{!! Auth::user()->about !!} </textarea>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">SUBMIT</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div role="tabpanel" class="tab-pane fade in" id="change_password_settings">
                                    <form class="form-horizontal" method="POST" action="{{route('admin.password.update')}}">
                                         @method("PUT")
                                           @csrf
                                        <div class="form-group">
                                            <label for="OldPassword" class="col-sm-3 control-label">Old Password</label>
                                            <div class="col-sm-9">
                                                <div class="form-line">
                                                    <input type="password" class="form-control" id="OldPassword" name="OldPassword" placeholder="Old Password" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="NewPassword" class="col-sm-3 control-label">New Password</label>
                                            <div class="col-sm-9">
                                                <div class="form-line">
                                                    <input type="password" class="form-control" id="NewPassword" name="password" placeholder="New Password" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="NewPasswordConfirm" class="col-sm-3 control-label">New Password (Confirm)</label>
                                            <div class="col-sm-9">
                                                <div class="form-line">
                                                    <input type="password" class="form-control" id="NewPasswordConfirm" name="password_confirmation" placeholder="New Password (Confirm)" required="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <button type="submit" class="btn btn-danger">SUBMIT</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')
    <script src="{{asset('assets/backend/plugins/tinymce/tinymce.min.js')}}"></script>
    <!-- Custom Js -->

    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 150,
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