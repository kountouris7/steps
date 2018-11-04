@extends('administrator.layouts.app')
@section('content')


    @foreach($users as $user)

        <ul class="collection">

            <li class="collection-item avatar">
                <span class="title"><strong>User:</strong></span>
                {{$user->name}}<br>
                {{$user->email}}
                <form action="{{route('delete.user', [$user->id])}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <br>
                    <button type="submit" class="waves-effect pink accent-3 btn-small">Withdraw User</button>
                </form>
            </li>
        </ul>
    @endforeach
    <hr>

    <a href="{{route('withdrawn.users')}}">Show Withdrawn Users</a>

@endsection