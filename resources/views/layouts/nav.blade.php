<nav class="nav-extended">

    <div class="nav-wrapper grey darken-2">
        <a class="brand-logo" href="{{ url('/') }}">

            <img src="https://scontent.fnic2-1.fna.fbcdn.net/v/t1.0-9/10670272_354243854736362_4108068647102529342_n.png?_nc_cat=0&oh=09d8ce2c12bb2db9d4ac3ca1327a6c1c&oe=5BEE6127" style="width: 2cm; height: 2cm;" alt="Steps Logo"></a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('show.groups')}}">Classes</a></li>

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


