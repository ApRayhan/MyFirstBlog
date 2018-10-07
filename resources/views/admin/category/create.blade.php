@extends('layouts.backend.app')

@section('title', 'Add New Category')

@push('css')
	
@endpush

@section('content')
	<div class="container-fluid">
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Add Category
                            </h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
                            	@csrf
                                <label for="email_address">Category Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Category Name">
                                    </div>
                                </div>
                                <label for="email_address">Image</label>
                                <div class="form-group">
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
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