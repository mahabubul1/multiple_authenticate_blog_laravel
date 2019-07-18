<header>
    <div class="container-fluid position-relative no-side-padding">

        <a href="{{url('/')}}" class="logo"><img src="#" alt="Logo"></a>

        <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

        <ul class="main-menu visible-on-click" id="main-menu">
            <li><a href="{{url('/')}}">Home</a></li>
            <li><a href="{{route('post.index')}}">Post</a></li>
            <li>
                @guest
                 <a href="{{route('login')}}">login</a>
                @else
                    @if(Auth::user()->role_id==1)
                        <a href="{{route('admin.dashboard')}}">Dashboard</a>
                    @elseif(Auth::user()->role_id==2)
                        <a href="{{route('author.dashboard')}}">Dashboard</a>
                    @endif
                @endguest

            </li>
        </ul><!-- main-menu -->

        <div class="src-area">
            <form method="GET" action="{{route('search')}}">
                <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                <input class="src-input" name="query"  value=" {{isset($query)?$query:''}}" type="text" placeholder="Type of search">
            </form>
        </div>

    </div><!-- conatiner -->
</header>