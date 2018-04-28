@extends('layouts.app')
@section('content')

@foreach($groups as $group)

    <div class="book-lesson">
        <div class="col-sm-8 blog-main">
            <div class="book-lesson-title">
                <h3> {{$group->lesson_id}} starting on </h3>
            </div>

            <form method="POST" action="/booking/{{$group->id}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="hidden" name="group_id" value="{{$group->id}}">
                        <button type="submit" class="btn btn-default"
                                {{ $group->isBooked() ? 'disabled' : '' }}>
                            {{ $group->bookings_count }} {{ str_plural('Booking', $group->bookings_count) }}
                        </button>
                    </div>
            </form>
        </div>
    </div>

@endforeach
@endsection