@extends('administrator.layouts.app')
@section('content')

    Subscriber:
    {{$subscriber->name}}
    {{$subscriber->surname}} <br>
    email: {{$subscriber->email}}

<hr>
    <form action="{{ route('process') }}" method="POST">
        {{ csrf_field() }}
        <button type="submit" name="email" value="{{$subscriber->email}}">Send invite</button>
    </form>

    @endsection