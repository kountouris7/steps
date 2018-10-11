@extends('layouts.app')
@section('content')
    @include('profiles.layouts.profilesnav')
    <div class="container">
        <div style="width:800px; margin:0 auto;">

            <div class="row">
                <div class="col s12 m6">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Monthly Bookings</span>
                            <p>
                               You booked: {{$groups->count()}} groups
                            </p>
                        </div>
                        <div class="card-action">
                            <a href="{{route('profile.showBookings', [$user->id])}}">Go to your bookings</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col s12 m6">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Weekly Package</span>
                            <p>
                                Your Weekly pack is: {{$user->subscription->package_week}} <br>
                                sessions / week
                            </p>
                        </div>
                        <div class="card-action">
                            Here show paid status
                        </div>
                    </div>
                </div>
            </div>

            Your Subscription is: {{$user->subscription->amount}} Euro / month

        </div>
    </div>
@endsection