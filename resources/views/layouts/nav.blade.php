<nav>
    <div class="nav-wrapper grey darken-2">
        <a class="brand-logo" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}</a>

        <ul id="nav-mobile" class="right">
            <li><a href="{{route('home')}}">Home</a></li>
            <!-- Dropdown Trigger -->
            <li><a class='dropdown-trigger' data-target='dropdown2'>Classes<i class="material-icons right">arrow_drop_down</i></a>
            </li>
            <!-- Dropdown Structure -->
            <ul id='dropdown2' class='dropdown-content text-center'>
                <li><a href="{{route('show.groups')}}">All Classes</a></li>
                <li><a href="{{route('groups.by.day', [0])}}">Monday</a></li>
                <li><a href="{{route('groups.by.day', [1])}}">Tuesday</a></li>
                <li><a href="{{route('groups.by.day', [2])}}">Wednesday</a></li>
                <li><a href="{{route('groups.by.day', [3])}}">Thursday</a></li>
                <li><a href="{{route('groups.by.day', [4])}}">Friday</a></li>
            </ul>


            @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register.user') }}">Register</a></li>
            @else
            <!-- Dropdown Trigger -->
                <li><a class='dropdown-trigger' data-target='dropdown1'>{{ Auth::user()->name }}<i
                                class="material-icons right">arrow_drop_down</i></a></li>
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
