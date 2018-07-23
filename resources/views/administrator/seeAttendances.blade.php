@extends('administrator.layouts.app')
@section('content')
    @include('administrator.layouts.navAttendances')
    @include('partials.errors')

@foreach($attendances as $attendance)
    <ul class="collection">
        <li class="collection-item avatar">
            <img src="images/yuna.jpg" alt="" class="circle">
            <span class="title">{{$attendance->group->lesson->name}}</span>
            <p>{{$attendance->creator->name}} <br>
                {{$attendance->group->day}} @
                {{$attendance->group->time}}
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
        </li>
    </ul>





    @endforeach

    @endsection