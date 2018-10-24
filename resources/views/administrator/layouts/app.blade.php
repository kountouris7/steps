<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{asset ('css/materialize.min.css')}}" media="screen,projection"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
{{--
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vue@2.5.17/dist/vue.js"></script>
u should change this to the production url--}}
<div id="app">
    @include('administrator.layouts.nav')
    <div style="width:800px; margin:0 auto;">
        @yield('content')
        <flash message="{{session('flash')}}"></flash>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('.dropdown-trigger').dropdown();
        $('.sidenav').sidenav();
        {{--
        $('.collapsible').collapsible();
        $('.parallax').parallax();
        $('.sidenav').sidenav();
         $('.materialboxed').materialbox();
        --}}
        $('.carousel.carousel-slider').carousel({
            fullWidth: true,
            indicators: true
        });
        $('.tabs').tabs();

    });
</script>