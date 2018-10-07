@extends('layouts.backend.app')

@section('title', 'Post')

@push('css')
	<link href="{{ asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Comment info</th>
                                            <th class="text-center">Post Info</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">Comment info</th>
                                            <th class="text-center">Post Info</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($posts as $key=>$post)
                                            @foreach ($post->comments as $comment)
                                                <tr>
                                                <td>
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <img src="{{ Storage::disk('public')->url('profileimg/'. $comment->user->image) }}" class="media-object" width="64x" height="64px">
                                                        </div>
                                                        <div class="media-body">
                                                            <h3 class="media-heading">{{ $comment->user->name }}</h3> <small>{{ $comment->created_at->diffForHumans() }}</small>
                                                            <p>{{ $comment->comment }}</p>
                                                            <a href="#"><strong>Reply</strong></a>
                                                        </div>
                                                        
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="media">
                                                        <div class="media-right">
                                                            <img src="{{ Storage::disk('public')->url('post/'. $comment->post->image) }}" class="media-object" width="64x" height="64px">
                                                        </div>
                                                        <div class="media-body">
                                                            <h3 class="media-heading">{{ $comment->post->title }}</h3> <small>{{ $comment->post->created_at->diffForHumans() }}</small>
                                                            <p>{{ $comment->post->user->name }}</p>
                                                            <a href="#"><strong>Reply</strong></a>
                                                        </div>
                                                        
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger waves-effect btn-sm" onclick="removeComment({{ $comment->id }})"><i class="material-icons">delete</i></button>

                                                    <form action="{{ route('author.comment.destroy', $comment->id) }}" method="post" style="display: none" id="delete-form-{{ $comment->id}}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
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
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
     <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function removeComment(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush