@extends('layouts.frontend.app')

@section('title', 'User Profile')

@push('css')
	<link href="{{ asset('public/assets/frontend/css/category-sidebar/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/frontend/css/category-sidebar/css/responsive.css') }}" rel="stylesheet">

@endpush

@section('content')
	<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>BEAUTY</b></h1>
	</div><!-- slider -->

	<section class="blog-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="row">

						@if ($posts->count() > 0)
							@foreach ($posts as $post)
								<div class="col-lg-6 col-md-4">
			                    <div class="card h-100">
			                        <div class="single-post post-style-1">

			                            <div class="blog-image"><img src="{{ asset(Storage::disk('public')->url('post/'.$post->image)) }}" alt=""></div>

			                            <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profileimg/'.$post->user->image) }}" alt="Profile Image"></a>

			                            <div class="blog-info">

			                                <h4 class="title"><a href="{{ route('show.post', $post->slug) }}"><b>{{ $post->title }}</b></a></h4>

			                                <ul class="post-footer">
			                                    <li>
			                                        @guest
			                                           <a href="javascript:void(0);" onclick="toastr.info('if You want Add This in Favorite . You Need to Login First ', 'info', {
			                                                    closeButton: true,
			                                                    progressBar: true,
			                                           })"><i class="ion-heart"></i>{{ $post->favorite_to_users()->count() }}</a> 
			                                        @else
			                                            <a href="javascript:void(0);" onclick="document.getElementById('add-favorite-{{ $post->id }}').submit();" class="{{ Auth::user()->favorite_posts->where('pivot.post_id', $post->id)->count() == 0 ? '' : 'favorite' }}"><i class="ion-heart"></i>{{ $post->favorite_to_users()->count() }}</a> 

			                                            <form id="add-favorite-{{ $post->id }}" action="{{ route('add.favorite',$post->id) }}" method="post" style="display: none;">
			                                                @csrf
			                                                
			                                            </form>
			                                        @endguest
			                                        
			                                    </li>
			                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
			                                    <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
			                                </ul>

			                            </div><!-- blog-info -->
			                        </div><!-- single-post -->
			                    </div><!-- card -->
			                </div><!-- col-lg-4 col-md-6 -->
							@endforeach
						@else
							No post Fount :(
 						@endif

						

					</div><!-- row -->

					

				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 ">

					<div class="single-post info-area ">

						<div class="about-area">
							<h4 class="title"><b>{{ $user->name }}</b></h4>
							<p>{{ $user->about }}</p>
							Total Post <strong>{{ $posts->count() }}</strong>
							Total Comment <strong>{{ $user->comments->count() }}</strong>
						</div>

					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- section -->
@endsection

@push('js')
	
@endpush