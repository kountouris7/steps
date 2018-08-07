<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>

</head>
<body>

<div id="app">
    @include('layouts.nav')
    @yield('content')
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
<!-- this is for dropdown btn -->
<script>$(".dropdown-trigger").dropdown();</script>

<script>  $(document).ready(function(){
        $('.collapsible').collapsible();
    });</script>

<script> $(document).ready(function(){
        $('.parallax').parallax();
    });</script>

<script> $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true
    });</script>

<script>  $(document).ready(function(){
        $('.sidenav').sidenav();
    });</script>
<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="js/materialize.min.js"></script>

</body>
</html>