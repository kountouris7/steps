<!DOCTYPE html>
<html>
<head>

    <!--Let browser know website is optimized for mobile-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{asset ('css/materialize.min.css')}}" media="screen,projection"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    @include('layouts.coverStyle')

</head>
<body>
<div class="flex-center position-ref full-height">

    <div class="top-center links">
        <a href="{{ url('/home') }}">
            <div class="title m-b-md">
                STEPS FITNESS STUDIO
            </div>
        </a>

    </div>


</div>
</body>
</html>