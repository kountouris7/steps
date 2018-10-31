@extends('administrator.layouts.app')
@section('content')
    @forelse($invites as $invite)
        <ul class="collection">
            <li class="collection-item avatar">
                <span class="title"><strong>Invitation to:</strong></span>
                <p>Email: {{$invite->email}} <br>
                    Token: {{$invite->token}}<br>
                    Date Send: {{$invite->created_at->format('l F jS \\@   H:i')}}
                </p>
                <hr>
                <form method="POST" action="{{route('delete.invites', [$invite->id])}}">
                    {{csrf_field()}}
                <button type="submit" class="waves-effect pink accent-3 btn-small">Delete</button>
                </form>
            </li>
        </ul>

    @empty
        <div class="center-align">
            <h4>There are no active invitations...</h4>
        </div>

    @endforelse
@endsection