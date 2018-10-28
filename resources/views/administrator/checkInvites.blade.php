@extends('administrator.layouts.app')
@section('content')
    @forelse($invites as $invite)
        <ul class="collection">
            <li class="collection-item avatar">
                <span class="title"><strong>Invitation to:</strong></span>
                <p>Email: {{$invite->email}} <br>
                    Token: {{$invite->token}}<br>
                    Date Send: {{$invite->created_at->format('M Y')}}
                </p>
                <a href="#!" class="secondary-content"><i class="material-icons">timelapse</i></a>
            </li>
        </ul>

    @empty
        <div class="center-align">
            <h4>There are no active invitations...</h4>
        </div>

    @endforelse
@endsection