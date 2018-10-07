@extends('layouts.backend.app')

@section('title', 'Edit Tag')

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
                                Edit Tags
                            </h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('admin.tag.update', $tag->id) }}" method="post">
                            	@csrf
                                @method('PUT')
                                <label for="email_address">New Tag Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Tag Name" value="{{ $tag->name }}">
                                    </div>
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