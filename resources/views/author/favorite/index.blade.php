@extends('layouts.backend.app')
@section('title','post/favorite')
@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endpush


@section("content")

    <div class="container-fluid">

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            All Favorites Post <strong class="btn btn-success">{{$favoritePosts->count()}}</strong>
                        </h2>

                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>User</th>
                                    <th><i class="material-icons">favorite</i></th>
                                    <th><i class="material-icons">visibility</i></th>
                                    <th>Actions</th>

                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>User</th>
                                    <th><i class="material-icons">favorite</i></th>
                                    <th><i class="material-icons">visibility</i></th>

                                    <th>Actions</th>

                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($favoritePosts as $keys=>$favoritePost)
                                    <tr>
                                        <td>{{$keys +1}}</td>
                                        <td>{{str_limit($favoritePost->title,12)}}</td>
                                        <th>{{$favoritePost->user->name}}</th>
                                        <th>{{$favoritePost->favorite_to_users->count()}}</th>
                                        <th>{{$favoritePost->view_count}}</th>


                                        <td>

                                            <a  class="btn btn-info" href="{{route('admin.post.show',$favoritePost->id)}}">
                                                <i class="material-icons ">visibility</i>
                                            </a>


                                            <button class="btn btn-danger" type="submit" onclick="removeFavorie({{$favoritePost->id }})">
                                                <i class="material-icons ">delete</i>
                                            </button>
                                            <form  id="remove-form-{{$favoritePost->id}}" action="{{route('favorite.post',$favoritePost->id)}}" method="POST" style="display: none">
                                                @csrf

                                            </form>

                                        </td>

                                    </tr>
                                @endforeach


                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>




@endsection


@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.13.0/dist/sweetalert2.all.min.js"></script>

    <script>
        function removeFavorie(id){

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You want  to  avorite remove this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, favorite remove it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    swalWithBootstrapButtons.fire(
                        event.preventDefault(),
                        document.getElementById('remove-form-'+id).submit(),
                    )
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'this data is safe :)',
                        'error'
                    )
                }
            })
        }

    </script>
@endpush