@extends('layouts.app')
@section('content')
    @include('profiles.layouts.profilesnav')
    <div class="container">
        <div style="width:800px; margin:0 auto;">

            <div class="row">
                <div class="col s12 m4 l6">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Monthly Bookings</span>
                            <p>
                               You booked: {{$groups->count()}} groups
                            </p>
                        </div>
                        <div class="card-action">
                            <a href="{{route('profile.showBookings', [$user->id])}}">Current bookings</a>
                            <a href="{{route('past.bookings', [$user->id])}}">Past Bookings</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m6">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Package</span>
                            <p>
                                Your Weekly pack is: <strong>{{$user->subscription->package_week}}</strong> <br>
                                sessions / week
                            </p>
                        </div>
                        <div class="card-action">
                            <a href="#"> Monthly subscription: €{{$user->subscription->price}}</a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection