@extends('administrator.layouts.app')
@section('content')


    @foreach($users as $user)

        <ul class="collection">

            <li class="collection-item avatar">
                <span class="title"><strong>User:</strong></span>
                {{$user->name}}<br>
                {{$user->email}}
            </li>
        </ul>

    @endforeach
@endsection