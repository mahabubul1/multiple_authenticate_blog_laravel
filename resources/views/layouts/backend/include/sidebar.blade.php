<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{asset('assets/backend/images/user.png')}}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{auth::user()->name}}</div>
            <div class="email">{{auth::user()->email}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href=" {{route('admin.profile.setting')}} "><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                            <i class="material-icons">input</i>  Log Out </a>


                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>

            @if(Request::is('admin*'))
                <li class="{{Request::is('admin/dashboard')? 'active':'' }}">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="material-icons">home</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/tag*')? 'active':'' }}">
                    <a href="{{route('admin.tag.index')}}">
                        <i class="material-icons">label</i>
                        <span>Tag</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/category*')? 'active':'' }}">
                    <a href="{{route('admin.category.index')}}">
                        <i class="material-icons">apps</i>
                        <span>Category</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/post*')? 'active':'' }}">
                    <a href="{{route('admin.post.index')}}">
                        <i class="material-icons">library_books</i>
                        <span>Post</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/pending*')? 'active':'' }}">
                    <a href="{{route('admin.pending')}}">
                        <i class="material-icons">library_books</i>
                        <span>Pending</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/subscriber*')? 'active':'' }}">
                    <a href="{{route('admin.subscriber.index')}}">
                        <i class="material-icons">subscriptions</i>
                        <span>All Subscriber</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/favorite*')? 'active':'' }}">
                    <a href="{{route('admin.favorite.post')}}">
                        <i class="material-icons">favorite</i>
                        <span>All Favorite</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/comment*')? 'active':'' }}">
                    <a href="{{route('admin.commnet.index')}}">
                        <i class="material-icons">comment</i>
                        <span>All Comment</span>
                    </a>
                </li>
                <li class="{{Request::is('admin/author*')? 'active':'' }}">
                    <a href="{{route('admin.author.index')}}">
                        <i class="material-icons">perm_identity</i>
                        <span>All  Authors</span>
                    </a>
                </li>

            @endif

            @if(Request::is('author*'))
                <li class="{{Request::is('author/dashboard')?'active':''}}">
                    <a href="{{route('author.dashboard')}}">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="{{Request::is('author/post*')?'active':''}}">
                    <a href="{{route('author.post.index')}}">
                        <i class="material-icons">library_books</i>
                        <span>Post</span>
                    </a>
                </li>
                <li class="{{Request::is('author/favorite*')?'active':''}}">
                    <a href="{{route('author.favorite.post')}}">
                        <i class="material-icons">favorite</i>
                        <span>All Favorite</span>
                    </a>
                </li>
                <li class="{{Request::is('author/comment*')? 'active':'' }}">
                    <a href="{{route('author.commnet.index')}}">
                        <i class="material-icons">comment</i>
                        <span>All Comment</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
    <!-- #Menu -->
</aside>
<!-- #END# Left Sidebar -->