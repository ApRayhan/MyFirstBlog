@extends('layouts.frontend.app')

@section('title', '')

@push('css')
	<link href="{{ asset('public/assets/frontend/css/single-post/styles.css') }}" rel="stylesheet">

	<link href="{{ asset('public/assets/frontend/css/single-post/responsive.css') }}" rel="stylesheet">
	<style>
		.post_thumnail {
			background-image: url({{ Storage::disk('public')->url('post/'.$posts->image) }});
			width: 100%;
			height: 700px;
		}
		.favorite{
            color: blue;
        }
	</style>

@endpush

@section('content')
	<div class="post_thumnail">
		<div class="display-table  center-text">
			<h1 class="title display-table-cell"><b>{{ $posts->title }}</b></h1>
		</div>
	</div><!-- slider -->

	<section class="post-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12 no-right-padding">

					<div class="main-post">

						<div class="blog-post-inner">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profileimg/'.$posts->user->image) }}" alt="Profile Image"></a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b>{{ $posts->user->name }}</b></a>
									<h6 class="date">{{ $posts->created_at->diffForHumans() }}</h6>
								</div>

							</div><!-- post-info -->

							<h3 class="title"><a href="#"><b>{{ $posts->title }}</b></a></h3>

							<div class="para">
								{!! html_entity_decode($posts->body) !!}
							</div>

							<ul class="tags">
								@foreach ($posts->tags as $tags)
									<li><a href="{{ route('tag.post', $tags->slug) }}">{{ $tags->name }}</a></li>
								@endforeach
							</ul>
						</div><!-- blog-post-inner -->

						<div class="post-icons-area">
							<ul class="post-icons">
								<li>
                                        @guest
                                           <a href="javascript:void(0);" onclick="toastr.info('if You want Add This in Favorite . You Need to Login First ', 'info', {
                                                    closeButton: true,
                                                    progressBar: true,
                                           })"><i class="ion-heart"></i>{{ $posts->favorite_to_users()->count() }}</a> 
                                        @else
                                            <a href="javascript:void(0);" onclick="document.getElementById('add-favorite-{{ $posts->id }}').submit();" class="{{ Auth::user()->favorite_posts->where('pivot.post_id', $posts->id)->count() == 0 ? '' : 'favorite' }}"><i class="ion-heart"></i>{{ $posts->favorite_to_users()->count() }}</a> 

                                            <form id="add-favorite-{{ $posts->id }}" action="{{ route('add.favorite',$posts->id) }}" method="post" style="display: none;">
                                                @csrf
                                                
                                            </form>
                                        @endguest
                                        
                                    </li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{ $posts->view_count }}</a></li>
							</ul>

							<ul class="icons">
								<li>SHARE : </li>
								<li><a href="#"><i class="ion-social-facebook"></i></a></li>
								<li><a href="#"><i class="ion-social-twitter"></i></a></li>
								<li><a href="#"><i class="ion-social-pinterest"></i></a></li>
							</ul>
						</div>
					</div><!-- main-post -->
				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 no-left-padding">

					<div class="single-post info-area">

						<div class="sidebar-area about-area">
							<h4 class="title"><b>ABOUT {{ $posts->user->name }}</b></h4>
							<p> {{ $posts->user->about }}</p>
						</div>


						<div class="tag-area">

							<h4 class="title"><b>Categorys</b></h4>
							<ul>
								@foreach ($posts->categorys as $category)
									<li><a href="{{ route('category.post', $category->slug) }}">{{ $category->name }}</a></li>
								@endforeach
							</ul>

						</div><!-- subscribe-area -->

					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- post-area -->


	<section class="recomended-area section">
		<div class="container">
			<div class="row">
				@foreach ($randomposts as $randompost)
					<div class="col-lg-4 col-md-6">
						<div class="card h-100">
							<div class="single-post post-style-1">

								<div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'.$randompost->image) }}" alt="Blog Image"></div>

								<a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profileimg/'.$randompost->user->image) }}" alt="Profile Image"></a>

								<div class="blog-info">

									<h4 class="title"><a href="#"><b>{{ $randompost->title }}</b></a></h4>

									<ul class="post-footer">
										<li>
                                        @guest
                                           <a href="javascript:void(0);" onclick="toastr.info('if You want Add This in Favorite . You Need to Login First ', 'info', {
                                                    closeButton: true,
                                                    progressBar: true,
                                           })"><i class="ion-heart"></i>{{ $randompost->favorite_to_users()->count() }}</a> 
                                        @else
                                            <a href="javascript:void(0);" onclick="document.getElementById('add-favorite-{{ $randompost->id }}').submit();" class="{{ Auth::user()->favorite_posts->where('pivot.post_id', $randompost->id)->count() == 0 ? '' : 'favorite' }}"><i class="ion-heart"></i>{{ $randompost->favorite_to_users()->count() }}</a> 

                                            <form id="add-favorite-{{ $randompost->id }}" action="{{ route('add.favorite',$randompost->id) }}" method="post" style="display: none;">
                                                @csrf
                                                
                                            </form>
                                        @endguest
                                        
                                    </li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{ $randompost->view_count }}</a></li>
									</ul>

								</div><!-- blog-info -->
							</div><!-- single-post -->
						</div><!-- card -->
					</div><!-- col-md-6 col-sm-12 -->
				@endforeach

			</div><!-- row -->

		</div><!-- container -->
	</section>

	<section class="comment-section">
		<div class="container">
			<h4><b>POST COMMENT</b></h4>
			<div class="row">

				<div class="col-lg-8 col-md-12">
					@guest
						<div class="comment-form">
							<p>To Add A New Comment You Need To Login First ! </p> <strong><a href="{{ route('login') }}" style="color: red">Login</a></strong>
						</div>
					@else
						<div class="comment-form">
							<form method="post" action="{{ route('comment.store', $posts->id) }}">
								@csrf
								<div class="row">

									<div class="col-sm-12">
										<textarea name="comment" rows="2" class="text-area-messge form-control"
											placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
									</div><!-- col-sm-12 -->
									<div class="col-sm-12">
										<button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
									</div><!-- col-sm-12 -->

								</div><!-- row -->
							</form>
						</div><!-- comment-form -->
					@endguest

					<h4><b>COMMENTS ({{ $posts->comments()->count() }})</b></h4>

					@foreach ($posts->comments as $comment)
						<div class="commnets-area ">
						<div class="comment">

							<div class="post-info">

								<div class="left-area">
									<a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profileimg/'. $comment->user->image ) }}" alt="Profile Image"></a>
								</div>

								<div class="middle-area">
									<a class="name" href="#"><b>{{ $comment->user->name }}</b></a>
									<h6 class="date">{{ $comment->created_at->diffForHumans() }}</h6>
								</div>

							</div><!-- post-info -->

							<p>{{ $comment->comment }}</p>

						</div>
						</div><!-- commnets-area -->
					@endforeach

					
					@if ($posts->comments->count() > 0 )
						<a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>
					@endif
					

				</div><!-- col-lg-8 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section>

@endsection

@push('js')
	
@endpush