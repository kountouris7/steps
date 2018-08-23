<ul id="slide-out" class="sidenav sidenav-fixed">
    <li><div class="user-view">
            <div class="background">
                <img src="images/office.jpg">
            </div>
            <a href="#user"><img class="circle" src="images/yuna.jpg"></a>
            <a href="#name"><span class="white-text name">John Doe</span></a>
            <a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>
        </div></li>
    <li><a href="{{route('admin')}}">Dashboard</a></li>
    <li><a href="{{route('see.attendances')}}">Check attendances </a></li>
    <li><div class="divider"></div></li>
    <li><a href="{{route('create.lesson')}}">Create New Lesson</a></li>
    <li><a href="{{route('show.lesson')}}">Create New Group</a></li>
    <li><a href="{{route('administrator.showgroups')}}">Edit Group</a></li>
    <li><div class="divider"></div></li>
    <li><a href="{{route('upload.excel')}}">Upload File</a></li>
    <li><a href="{{route('showSubscribersCurrentMonth')}}">Clients</a></li>
    <li><a href="{{route('create.email')}}">Send Email</a></li>
    <li><div class="divider"></div></li>
    <li><a href="{{route('show.groups')}}">View as Client</a></li>

</ul>
<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
