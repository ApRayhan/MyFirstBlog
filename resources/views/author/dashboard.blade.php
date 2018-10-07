@extends('layouts.backend.app')

@section('title', 'Dashboard')

@push('css')
    {{-- expr --}}
@endpush
@section('content')
    <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">calendar_today</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Post</div>
                            <div class="number count-to" data-from="0" data-to="{{ Auth::user()->posts()->count()}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">favorite</i>
                        </div>
                        <div class="content">
                            <div class="text">Favorite Post</div>
                            <div class="number count-to" data-from="0" data-to="{{ $user->favorite_posts->count() }}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">visibility</i>
                        </div>
                        <div class="content">
                            <div class="text">Total View</div>
                            <div class="number count-to" data-from="0" data-to="{{ $total_view }}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">Panding Post</div>
                            <div class="number count-to" data-from="0" data-to="{{ $panding_post }}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Top Posts</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Title</th>
                                            <th>Views</th>
                                            <th>Comment</th>
                                            <th>Favorite</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($top_posts as $key=>$post)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ str_limit($post->title, 30) }}</td>
                                                <td>{{ $post->view_count }}</td>
                                                <td>{{ $post->comments_count }}</td>
                                                <td>{{ $post->favorite_to_users_count }}</td>
                                                <td>
                                                    @if ($post->is_approved == true)
                                                        <span class="label bg-blue">Approved</span>
                                                    @else
                                                        `<span class="label bg-red">Not Approved</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
            </div>
        </div>
@endsection
@push('js')
    <script src="{{ asset('public/assets/backend/js/pages/index.js') }}"></script>
        <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/morrisjs/morris.js') }}"></script>

    <!-- ChartJs -->
    <script src="{{ asset('public/assets/backend/plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/flot-charts/jquery.flot.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('public/assets/backend/plugins/flot-charts/jquery.flot.time.js') }}"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>
@endpush
