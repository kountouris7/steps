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
<div id="app">
    @include('administrator.layouts.nav')
    <div style="width:800px; margin:0 auto;">
        @yield('content')
        <flash message="{{session('flash')}}"></flash>
        @include('partials.errors')
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>


<script> $(document).ready(function () {
        $(".dropdown-trigger").dropdown();
        $('.collapsible').collapsible();
        $('.carousel.carousel-slider').carousel({
            fullWidth: true,
            indicators: true
        });
        $('select').formSelect();
        $('.sidenav').sidenav();
        $('.tabs').tabs();
        $('.materialboxed').materialbox();
        $(".delete").on("submit", function(){
            return confirm("Are you sure?");
        });
    });
</script>


<!--JavaScript at end of body for optimized loading-->
<script src="{{mix('js/app.js')}}"></script>
<script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>

</body>
</html>