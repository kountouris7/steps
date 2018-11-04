@extends('administrator.layouts.app')
@section('content')
    @forelse($withdrawnUsers as $withdrawnUser)

        <ul class="collection">

            <li class="collection-item avatar">
                <span class="title"><strong>User:</strong></span>

                {{$withdrawnUser->name}}<br>
                {{$withdrawnUser->email}}

                <form action="{{route('restore.user', [$withdrawnUser->id])}}" method="GET">
                    {{ csrf_field() }}
                    <br>
                    <button type="submit" class="waves-effect pink accent-3 btn-small">Restore User</button>
                </form>

                <form action="{{route('forceDelete.user', [$withdrawnUser->id])}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <br>
                    <button type="submit" class="waves-effect pink accent-3 btn-small">Delete Permanently</button>
                </form>
            </li>
        </ul>

    @empty
        <div class="center-align">
            <h4>There are no withdrawn users...</h4>
        </div>

    @endforelse
@endsection