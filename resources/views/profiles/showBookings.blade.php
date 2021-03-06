@extends('layouts.app')
@section('content')
    @include('profiles.layouts.profilesnav')
    <div class="container" style="margin-left: 35%">
        <div class="row">
            <div class="col s12 m4 l6">
                <div class="header center-align" style="font-family: 'Raleway', sans-serif;">
              <h4>
                  <strong>{{$currentMonth}} Bookings</strong>
              </h4>
                </div>
                @forelse ($groups as $group)
                   {{-- <delete-group :group="{{$group}}"></delete-group>--}}


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


                @empty
                    <div class="center-align">
                        <h3>You don't have any future bookings...</h3>
                    </div>
                @endforelse
                <div class="center-align">
                    <ul class="collection">
                        <li class="collection-item avatar center-align">
                            <strong><a href="{{route('past.bookings', [$user->id])}}">Past Bookings</a></strong>
                            <hr>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>




@endsection