@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h1>
                        {{ $profileUser->name }}
                    </h1>
                </div>

                @foreach ($groupUsers as $groupUser)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="level">
                               <span class="flex">
                                   <hr>
                                    <span>{{ $groupUser->created_at->diffForHumans() }}</span><br>
                                    <a href="{{ route('profile', $groupUser->creator) }}">{{ $groupUser->creator->name }}</a>
                                   booked:
                               </span>
                            </div>
                        </div>
                        <div class="panel-body">
                            {{ $groupUser->group_id}}
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
@endsection