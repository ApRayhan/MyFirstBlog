@extends('layouts.frontend.app')

@section('title', '')

@push('css')
	<link href="{{ asset('public/assets/frontend/css/home/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/frontend/css/home/responsive.css') }}" rel="stylesheet">
@endpush

@section('content')
	<section class="blog-area section">
        <div class="container">
            @if ($posts->count() > 0)
                <div class="row">
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6">
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

            </div><!-- row -->
            @else
                <h2>No Post Abailable In This Category</h2>
            @endif

            

        </div><!-- container -->
    </section><!-- section -->
@endsection

@push('js')
	
@endpush