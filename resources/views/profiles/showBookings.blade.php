@extends('layouts.app')
@section('content')
    @include('profiles.layouts.profilesnav')

    <div class="container" style="margin-left: 35%">
        <div class="row">
            <div class="col s8 m6 l6">
                @forelse ($groups as $group)
                    <delete-group :group="{{$group}}"></delete-group>


                    {{--
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
                        </ul> --}}


                @empty
                    <div class="center-align">
                        <h3>You have no bookings...</h3>
                    </div>
                @endforelse
            </div>
        </div>
    </div>




@endsection