@extends('layouts.app')
@section('content')
    @include('profiles.layouts.profilesnav')
    <div class="container">
        <div style="width:800px; margin:0 auto;">

            Here show total month bookings, subscription package, paid status etc..<br>

            Bookings Count: {{$groups}}


        </div>
    </div>
@endsection