<header>
        <div class="container-fluid position-relative no-side-padding">

            <a href="#" class="logo"><h3>Blog</h3></a>

            <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

            <ul class="main-menu visible-on-click" id="main-menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('posts.index') }}">Posts</a></li>
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    @if (Auth::user()->roll_id == 1)
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    @endif
                    @if (Auth::user()->roll_id == 2)
                        <li><a href="{{ route('author.dashboard') }}">Dashboard</a></li>
                    @endif 
                @endguest
                
                
            </ul><!-- main-menu -->

            <div class="src-area">
                <form method="get" action="{{ route('search') }}">
                    <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                    <input name="query" class="src-input" type="text" placeholder="Type of search" value="{{ isset($query) ? $query : ''}}">
                </form>
            </div>

        </div><!-- conatiner -->
    </header>