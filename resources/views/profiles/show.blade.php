@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h1>
                        {{ $user->name }}
                    </h1>
                </div>

                @foreach ($user->groups as $group)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="level">
                               <span class="flex">
                                   <hr>
                                    <span>{{ $group->created_at->diffForHumans() }}</span><br>
                                  <h4>{{ $user->name }}</h4>
                                  <h5>booked:</h5>
                               </span>

                            </div>
                        </div>
                        <div class="panel-body">

                            {{$group->lesson->name}} On {{date('D M Y H:i', strtotime($group->day_time))}}

                        </div>

                            <form action="{{route('book.destroy', [$group->id])}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-link">Delete Booking</button>
                            </form>

                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection