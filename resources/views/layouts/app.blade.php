<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{asset ('css/materialize.min.css')}}" media="screen,projection"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vue@2.5.17/dist/vue.js"></script>{{--u should change this to the production url--}}

<div id="app">
    @include('layouts.nav')
    @yield('content')
    <flash message="{{session('flash')}}"></flash>

</div>

<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
<!-- this is for dropdown btn -->
<script>$(".dropdown-trigger").dropdown();</script>

<script>  $(document).ready(function () {
        $('.collapsible').collapsible();
    });</script>

<script> $(document).ready(function () {
        $('.parallax').parallax();
    });</script>

<script> $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true
    });</script>

<script>  $(document).ready(function () {
        $('.sidenav').sidenav();
    });</script>

<script>$(document).ready(function () {
        $('.tabs').tabs();
    });</script>

<script>$(document).ready(function () {
        $('.materialboxed').materialbox();
    });</script>

<!--JavaScript at end of body for optimized loading-->
<script src="{{asset('js/app.js')}}"></script>
<script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>


</body>
</html>