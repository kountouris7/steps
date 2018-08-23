<ul id="slide-out" class="sidenav sidenav-fixed" style="margin-top:65px">
    <li>
        <div class="user-view">
            <div class="background">
                <img src="images/steps.jpg">
            </div>
            <a href="#user"><img class="circle" src="images/yuna.jpg"></a>
            <a href="#name"><span class="black-text name">{{$user->name}}</span></a>
            <a href="#email"><span class="black-text email">{{$user->email}}</span></a>
        </div>
    </li>
    <li><a href="{{route('show.groups')}}">Back to Classes</a></li>
    <li><a href="{{route('past.bookings', [$user->id])}}">Bookings History</a></li>
    <li>
        <div class="divider"></div>
    </li>

</ul>