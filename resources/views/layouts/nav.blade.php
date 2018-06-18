<nav>
    <div class="nav-wrapper black">
        <a class="brand-logo" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}</a>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('show.groups')}}">Classes</a></li>

            @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register.user') }}">Register</a></li>
            @else


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">

                        <li><a href="{{ route('profiles', Auth::user()) }}">My Profile</a></li>
                        @if(Auth::user()->isAdmin())
                            <li><a href="{{ route('admin') }}">Admin Panel</a></li>
                        @endif


                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>
