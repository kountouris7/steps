@extends('layouts.app')
@section('content')
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
    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    <div class="container">
        <div style="width:800px; margin:0 auto;">
            @forelse ($groups as $group)
                <div class="container">
                    <ul class="collection">
                        <li class="collection-item avatar center-align">
                            <strong>{{ $group->created_at->diffForHumans()}} you booked:</strong><br>
                            {{$group->lesson->name}}<br>
                            On {{Carbon\Carbon::parse($group->day_time)->toDayDateTimeString()}}
                            <hr>
                            <form action="{{route('book.destroy', [$group->id])}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="waves-effect pink accent-3 btn-small">Delete Booking</button>

                            </form>
                        </li>
                    </ul>
                </div>

            @empty
                <div class="center-align">
                    <h3>You have no bookings...</h3>
                </div>

            @endforelse

        </div>
    </div>
@endsection