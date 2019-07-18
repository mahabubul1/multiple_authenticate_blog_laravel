@extends('layouts.backend.app')
@section('title','post/comnet')
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
                            All  Post comment <strong class="btn btn-success">{{$comments->count()}}</strong>
                        </h2>

                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th style="text-align: center">Commnet info</th>
                                    <th style="text-align: center">Post into</th>
                                    <th style="text-align: center">Actions</th>

                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th style="text-align: center">Commnet info</th>
                                    <th style="text-align: center">Post into</th>
                                    <th style="text-align: center">Actions</th>

                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($comments as $keys=>$comment)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                 <div class="media-left">
                                                     <a href=""> <img class="media-object" src="{{Storage::disk("public")->url("user/".$comment->user->image)}}" alt="" width="60" height="60"></a>
                                                 </div>
                                                <div class="media-body">
                                                     <h4 class="media-heading"> {{$comment->user->name}}
                                                         <small> on {{ $comment->created_at->diffForHumans()}}</small>
                                                     </h4>
                                                </div>
                                                <p>{{$comment->comment}}</p>
                                                <a target="_blank" href="{{route('post.postDetails',$comment->post->slug)}}"> Replay </a>

                                            </div>


                                        </td>
                                        <td>
                                            <div class="media">
                                                 <div class="media-right" style=" padding-right: 8px;" >
                                                     <a  target="_blank" href="{{route('post.postDetails',$comment->post->slug)}}"> <img class="media-object" src="{{Storage::disk("public")->url("post/".$comment->post->image)}}" alt="" width="60" height="60"></a>
                                                 </div>

                                                <div class="media-body">
                                                    <a target="_blank" href="{{route('post.postDetails',$comment->post->slug)}}">
                                                        <h4 class="media-heading"> {{str_limit($comment->post->title,30)}}</h4>
                                                    </a>
                                                    <p>  by  <Strong>{{$comment->user->name}}</Strong> </p>

                                                </div>



                                            </div>

                                        </td>

                                        <td>

                                            <button class="btn btn-danger" type="submit" onclick="removeComment({{$comment->id }})">
                                                <i class="material-icons ">delete</i>
                                            </button>
                                            <form  id="remove-form-{{$comment->id}}" action="{{route('admin.commnet.destroy',$comment->id)}}" method="POST" style="display: none">
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
        function removeComment(id){

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You want  to  comment remove this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, comment remove it!',
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