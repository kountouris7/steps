@extends('layouts.app')
@section('content')
    @include('profiles.layouts.profilesnav')
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