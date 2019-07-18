@extends('layouts.backend.app')
@section('title','post')
@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endpush


@section("content")

    <div class="container-fluid">
        <div class="block-header">
            <a href="{{route('admin.post.create')}}" class="btn btn-primary"> <i class="material-icons"> add</i> Add New Post </a>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            All Post <strong>{{$posts->count()}}</strong>
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
                                    <th><i class="material-icons">visibility</i></th>
                                    <th>Status</th>
                                    <th>Is Approved</th>
                                    <th>Actions</th>

                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>User</th>
                                    <th><i class="material-icons">visibility</i></th>
                                    <th>Status</th>
                                    <th>Is Approved</th>
                                    <th>Actions</th>

                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($posts as $keys=>$post)
                                    <tr>
                                        <td>{{$keys +1}}</td>
                                        <td>{{str_limit($post->title,12)}}</td>
                                        <th>{{$post->user->name}}</th>
                                        <th>{{$post->view_count}}</th>
                                        <td>

                                            {{$post->status=='1'?"published":"pending"}}


                                        </td>
                                        <td>
                                            {{$post->is_approved=='1'?"Approved":"pending"}}

                                        </td>



                                        <td>
                                            <a  class="btn btn-info" href="{{route('admin.post.edit',$post->id)}}">
                                                <i class="material-icons ">edit</i>
                                            </a>


                                            <a  class="btn btn-info" href="{{route('admin.post.show',$post->id)}}">
                                                <i class="material-icons ">visibility</i>
                                            </a>


                                            <button class="btn btn-danger" type="submit" onclick="deletePost($post->id )">
                                                <i class="material-icons ">delete</i>
                                            </button>
                                            <form  id="delete-form-{{$post->id}}" action="{{route('admin.post.destroy',$post->id)}}" method="POST" style="display: none">
                                                @csrf
                                                @method("DELETE")


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
        function deletePost(id){

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    swalWithBootstrapButtons.fire(
                        event.preventDefault(),
                        document.getElementById('delete-form-'+id).submit(),
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