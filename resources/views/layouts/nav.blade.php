<nav>
    <div class="nav-wrapper black">
        <a class="brand-logo" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}</a>

        <ul id="nav-mobile" class="right">
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('show.groups')}}">Classes</a></li>

            @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register.user') }}">Register</a></li>
            @else
            <!-- Dropdown Trigger -->
                <a class='dropdown-trigger btn' href='#!' data-target='dropdown1'>{{ Auth::user()->name }}</a>
            <!-- Dropdown Structure -->
                <ul id='dropdown1' class='dropdown-content'>
                    <li><a href="{{ route('profiles', Auth::user()) }}">My Profile</a></li>
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout</a></li>

                    <li class="divider" tabindex="-1"></li>

                    @if(Auth::user()->isAdmin())
                        <li><a href="{{ route('admin') }}">Admin Panel</a></li>
                    @endif


                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>



                </ul>
            @endif
        </ul>
    </div>
</nav>
