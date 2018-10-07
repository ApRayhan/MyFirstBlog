@extends('layouts.backend.app')

@section('title', 'Add New Category')

@push('css')
	<!-- Bootstrap Select Css -->
    <link href="{{ asset('public/assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')
	<div class="container-fluid">
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    {{ $post->title }}
                                </h2>
                            </div>
                            <div class="body">
                                <small>Posted By <strong>{{ $post->user->name }}</strong><br>
                                on {{ $post->created_at->toFormattedDateString() }}</small>
                                <p>
                                    {!! $post->body !!}
                                </p>
                            </div>
                        </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header bg-blue">
                                <h2>
                                    Category
                                </h2>
                            </div>
                            <div class="body">
                                @foreach ($post->categorys as $postcategory)
                                    <small class="labal bg-green">{{ $postcategory->name }}</small>
                                @endforeach
                            </div>
                        </div>
                        <div class="card">
                            <div class="header bg-blue">
                                <h2>
                                    Tags
                                </h2>
                            </div>
                            <div class="body">
                                @foreach ($post->tags as $posttags)
                                    <small class="labal bg-green">{{ $posttags->name }}</small>
                                @endforeach
                            </div>
                        </div>
                        <div class="card">
                            <div class="header bg-blue">
                                <h2>
                                    Feture Image
                                </h2>
                            </div>
                            <div class="body">
                                <img class="img-responsive img-thumbnail" src="{{ Storage::disk('public')->url('post/'.$post->image) }}">
                            </div>
                        </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->
        </div>
@endsection

@push('js')
	<!-- Select Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('public/assets/backend/plugins/tinymce/tinymce.js') }}"></script>
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
        tinyMCE.baseURL = '{{ asset('public/assets/backend/plugins/tinymce') }}';
    });
    </script>
@endpush