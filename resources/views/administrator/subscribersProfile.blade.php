@extends('administrator.layouts.app')
@section('content')
    <h4> Client:<br>
        {{$subscriber->name}}
    {{$subscriber->surname}}</h4>
   <h5>email: {{$subscriber->email}}</h5>

    <hr>

    <form action="{{ route('process') }}" method="POST">
        {{ csrf_field() }}
        <button type="submit" name="email" value="{{$subscriber->email}}">Send invitation</button>
    </form>
<br>
    <form action="" method="POST">
        {{ csrf_field() }}
        <button type="submit" name="email" value="{{$subscriber->email}}">Send email</button>
    </form>

@endsection