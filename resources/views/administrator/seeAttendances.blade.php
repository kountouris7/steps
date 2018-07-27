@extends('administrator.layouts.app')
@section('content')
    @include('administrator.layouts.navAttendances')
    @include('partials.errors')

    @forelse($attendances as $attendance)

        @foreach($attendance->clients as $attendant) {{--That's because $attendance->clients is a collection--}}

            <ul class="collection">
                <li class="collection-item avatar">
                    <img src="images/yuna.jpg" alt="" class="circle">
                    <span class="title"><strong>{{$attendant->name}}</strong></span>
                    <p>
                        {{$attendance->lesson->name}}<br>
                        {{$attendance->day}}
                        {{$attendance->time}}
                    </p>
                    <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                </li>
            </ul>

        @endforeach

    @empty
        <div class="center-align">
            <h4>There are no bookings on this day yet...</h4>
        </div>

    @endforelse

@endsection