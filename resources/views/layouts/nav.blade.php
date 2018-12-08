<nav class="nav-extended">

    <div class="nav-wrapper black">
        <a class="brand-logo" href="{{ url('/') }}">
            <img src="https://thumb.ibb.co/hqwUKe/steps_fitness_logo_2.png" style="width: 2cm; height: 1.5cm;"
                 alt="Steps Logo"></a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
            @if(auth()->user())
                <li><a class="btn tooltipped pink accent-3" id="articles" data-position="bottom" data-tooltip="Available Soon">Articles</a>
                </li>
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{route('show.groups')}}">Classes</a></li>
                <!-- Dropdown Trigger -->
                <li><a class='dropdown-trigger' data-target='dropdown1'>{{ Auth::user()->name }}<i
                                class="material-icons right">arrow_drop_down</i></a></li>
                <!-- Dropdown Structure -->
                <ul id='dropdown1' class='dropdown-content'>
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

                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register.user') }}">Register</a></li>

                </ul>
            @endif
        </ul>
    </div>
</nav>


@include('layouts.smallScreenNav')









