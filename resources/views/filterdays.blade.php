<nav class="nav-extended">
    <div class="nav-wrapper black">
        <a href="#" data-target="filter-days" class="sidenav-trigger"><i class="material-icons">today</i></a>
        <ul class="left-align hide-on-med-and-down">
            <li><a href="{{route('groups.by.day', [1])}}">Monday</a></li>
            <li><a><a href="{{route('groups.by.day', [2])}}">Tuesday</a></a></li>
            <li><a href="{{route('groups.by.day', [3])}}">Wednesday</a></li>
            <li><a href="{{route('groups.by.day', [4])}}">Thursday</a></li>
            <li><a href="{{route('groups.by.day', [5])}}">Friday</a></li>
        </ul>
    </div>
</nav>

<ul class="sidenav" id="filter-days">
    <li><a href="{{route('groups.by.day', [1])}}">Monday</a></li>
    <li><a><a href="{{route('groups.by.day', [2])}}">Tuesday</a></a></li>
    <li><a href="{{route('groups.by.day', [3])}}">Wednesday</a></li>
    <li><a href="{{route('groups.by.day', [4])}}">Thursday</a></li>
    <li><a href="{{route('groups.by.day', [5])}}">Friday</a></li>
</ul>