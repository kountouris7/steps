@extends('layouts.app')
@section('content')
    @include('profiles.layouts.profilesnav')
    <div class="container" style="margin-left: 35%">
        <div class="row">
            <div class="col s12 m4 l6">
            <div class="header center-align" style="font-family: 'Raleway', sans-serif;">
                <h5>
                    <strong>{{$currentMonth}} Past Bookings</strong>
                </h5>
            </div>
            @forelse ($groups as $group)

                    <ul class="collection">
                        <li class="collection-item avatar center">
                            <strong>{{ $group->created_at->diffForHumans()}} you booked:</strong><br>
                           <strong> {{$group->lesson->name}}</strong><br>
                            On {{Carbon\Carbon::parse($group->day_time)->format('l F jS \\@   H:i')}}

                           {{--<form action="{{route('book.destroy', [$group->id])}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="waves-effect pink accent-3 btn-small
{{$group->day_time > $groupDateMonthStart ? 'disabled' : '' }}">Clear Booking
                                </button>
                            </form>--}}
                        </li>
                    </ul>

            @empty
                <div>
                    <h3>You have no past bookings...</h3>
                </div>
            @endforelse
            </div>

        </div>
    </div>

@endsection