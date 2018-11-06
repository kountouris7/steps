@extends('administrator.layouts.app')
@section('content')
    @include('administrator.layouts.navAttendances')
    @include('partials.errors')

    @forelse($attendances as $attendance)
        @foreach($attendance->get('clients') as $attendant)
            <ol class="collection">
                <li class="collection-item avatar">
                    <img src="images/yuna.jpg" alt="" class="circle">
                    <span class="title"><strong>{{$attendant->name}}</strong></span>
                    <p>
                        {{($attendance->get('lesson'))->name}}<br>
                        {{Carbon\Carbon::parse($attendance->get('day_time'))->format('l jS \\of  F H:i')}}
                    </p>
                    <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                </li>
            </ol>
        @endforeach
    @empty
        <div class="center-align">
            <h4>There are no bookings on this day yet...</h4>
        </div>

    @endforelse

@endsection