@extends('layouts.backend.app')

@section('title', 'Add New Category')

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('public/assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.post.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Edit post
                                </h2>
                            </div>
                            <div class="body">
                                    <label for="email_address">Title</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="name" name="title" class="form-control" value="{{ $post->title }}" placeholder="Post Title">
                                        </div>
                                    </div>
                                    <label for="email_address">Thumbnail</label>
                                    <div class="form-group">
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <input id="publish" class="filled-in" type="checkbox" name="status" value="1" {{ $post->status == true ? 'checked' : ''}}>
                                    <label for="publish">Publish</label>
                            </div>
                        </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Select Category
                                </h2>
                            </div>
                            <div class="body">
                                    <label for="category">Category Name</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select id="category" class="form-control show-tick" data-live-search="true" name="category[]" multiple>
                                                @foreach ($categorys as $category)
                                                    <option 
                                                    @foreach ($post->categorys as $postcategory)
                                                        {{ $postcategory->id == $category->id ? 'selected' : ''}}
                                                    @endforeach
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label for="tags">Tags</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select id="tags" class="form-control show-tick" data-live-search="true" name="tags[]" multiple>
                                                @foreach ($tags as $tag)
                                                    <option 
                                                    @foreach ($post->tags as $posttag)
                                                        {{ $posttag->id == $tag->id ? 'selected' : '' }}
                                                    @endforeach 
                                                    value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                            </div>
                        </div>
                </div>
                
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    Body
                                </h2>
                            </div>
                            <div class="body">
                                <textarea id="tinymce" name="body">{{ $post->body }}</textarea>
                            </div>
                        </div>
                </div>
            </div>
        </form>
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