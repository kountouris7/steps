<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{asset ('css/materialize.min.css')}}" media="screen,projection"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>--}}
</head>
<body>



<div id="app">
    @include('layouts.nav')
    @yield('content')
    <flash message="{{session('flash')}}"></flash>

</div>



<script src="https://js.pusher.com/4.3/pusher.min.js"></script>

<!--JavaScript at end of body for optimized loading-->
<script src="{{asset('js/app.js')}}"></script>

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
</body>
</html>