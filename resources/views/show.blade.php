@extends('layouts.app')
@section('content')

    @include('partials.errors')

@foreach($groups as $group)

    <div class="book-lesson">
        <div class="col-sm-8 blog-main">
            <div class="book-lesson-title">
                <h3>

                    {{optional($group->lesson)->name ?? $group->id}} <br>
                    Starting on: {{date('D M Y H:i', strtotime($group->day_time))}}

                </h3>
            </div>

            <form method="POST" action="/booking/{{$group->id}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="hidden" name="group_id" value="{{$group->id}}">
                        <input type="hidden" name="day_time" value="{{$group->day_time}}">
                        <input type="hidden" name="user_id" value="{{auth()->id()}}">

                        <button type="submit" class="btn btn-default"{{ $group->isBooked() ? 'disabled' : '' }}
                                {{ $group->isBooked()}}>
                            {{ $group->bookings_count }} {{ str_plural('Booking', $group->bookings_count) }}
                        </button>
                    </div>

            </form>
        </div>
    </div>

@endforeach
@endsection