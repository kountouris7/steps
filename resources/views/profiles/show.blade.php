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

                @foreach ($groupUsers as $groupuser)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="level">
                               <span class="flex">
                                   <hr>
                                    <span>{{ $groupuser->created_at->diffForHumans() }}</span><br>
                                    <a href="{{ route('profiles', $groupuser->creator) }}">{{ $groupuser->creator->name }}</a>
                                   booked:
                               </span>

                            </div>
                        </div>
                        <div class="panel-body">

                            {{$groupuser->lessons->name}} On {{date('D M Y H:i', strtotime($groupuser->group->day_time))}}

                        </div>
                        @can ('update', $groupuser)
                            <form action="{{route('groupuser.destroy', [$groupuser->group_id])}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-link">Delete Booking</button>
                            </form>
                        @endcan
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection