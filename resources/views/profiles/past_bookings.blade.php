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
                </div>

            @empty
                <div class="center-align">
                    <h3>You have no past bookings...</h3>
                </div>
            @endforelse
        </div>
    </div>

@endsection