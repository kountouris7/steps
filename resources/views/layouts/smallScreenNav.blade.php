<ul class="sidenav" id="mobile-demo">

    <li><a href="{{route('home')}}">Home</a></li>
    <li><a href="{{route('show.groups')}}">Classes</a></li>

    @if (Auth::guest())
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register.user') }}">Register</a></li>
    @else

        <ul>
            <li><a href="{{ route('profile.dashboard', Auth::user()) }}">My Profile</a></li>
            <li class="divider" tabindex="-1"></li>

            @if(Auth::user()->isAdmin())
                <li><a href="{{ route('admin') }}">Admin Panel</a></li>

                <li class="divider" tabindex="-1"></li>
            @endif


            <li><a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Logout</a></li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">
                {{ csrf_field() }}
            </form>
            @endif
        </ul>
</ul>