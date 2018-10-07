@extends('layouts.backend.app')

@section('title', 'Update Profile')

@push('css')
	
@endpush

@section('content')
	<div class="container-fluid">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                        <div class="header">
                            <h2>
                                Edit Profile
                            </h2>
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#profile_with_icon_title" data-toggle="tab" aria-expanded="false">
                                        <i class="material-icons">face</i> PROFILE
                                    </a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#password_with_icon_title" data-toggle="tab" aria-expanded="true">
                                        <i class="material-icons">lock_open</i> Change Password
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="profile_with_icon_title">
									<div class="card">
				                        <div class="header">
				                            <h2>
				                                Edit Profile
				                            </h2>
				                        </div>
				                        <div class="body">
				                            <form action="{{ route('author.profile.edit') }}" method="post" enctype="multipart/form-data">
				                            	@csrf
				                            	@method('PUT')
				                            	<label for="name">Name</label>
				                                <div class="form-group">
				                                    <div class="form-line">
				                                        <input type="text" id="name" class="form-control" placeholder="Enter your name" value="{{ Auth::user()->name }}" name="name">
				                                    </div>
				                                </div>
				                                <label for="email">Email Address</label>
				                                <div class="form-group">
				                                    <div class="form-line">
				                                        <input type="text" id="email_address" class="form-control" placeholder="Enter your email address" value="{{ Auth::user()->email }}" name="email">
				                                    </div>
				                                </div>
				                                <label for="about">About</label>
				                                <div class="form-group">
				                                    <div class="form-line">
				                                        <textarea class="form-control" name="about">
				                                        	{{ Auth::user()->about }}
				                                        </textarea>
				                                    </div>
				                                </div>
				                                <label for="email_address">Image</label>
				                                <div class="form-group">
				                                    <div class="form-line">
				                                        <input type="file" name="image">
				                                    </div>
				                                </div>

				                                
				                                <br>
				                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
				                            </form>
				                        </div>
                    				</div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="password_with_icon_title">
                                    <div class="card">
				                        <div class="header">
				                            <h2>
				                                Edit Password
				                            </h2>
				                        </div>
				                        <div class="body">
				                            <form action="{{ route('author.change.password') }}" method="post">
				                            	@csrf
				                        	@method('PUT')
				                            	<label for="old_password">Old Password</label>
				                                <div class="form-group">
				                                    <div class="form-line">
				                                        <input type="password" id="name" class="form-control" placeholder="Old Password" name="old_password">
				                                    </div>
				                                </div>
				                            	<label for="password">New Password</label>
				                                <div class="form-group">
				                                    <div class="form-line">
				                                        <input type="password" id="name" class="form-control" placeholder="New Password" name="password">
				                                    </div>
				                                </div>
				                            	<label for="password_confirmation">Confirm Password</label>
				                                <div class="form-group">
				                                    <div class="form-line">
				                                        <input type="password" id="name" class="form-control" placeholder="Confirm Password" name="password_confirmation">
				                                    </div>
				                                </div>

				                                
				                                <br>
				                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
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
	
@endpush