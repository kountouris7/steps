@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>{{ $user->name }} </h1>

        @foreach ($user->groups as $group)

            <div class="col-md-5">
                <ul class="collection">
                    <li class="collection-item avatar">
                        <i class="material-icons circle">folder</i>
                        {{ $group->created_at->diffForHumans() }}:<br>
                        You have booked: {{$group->lesson->name}}<br>
                        On {{date('D M Y H:i', strtotime($group->day_time))}}
                        <hr>


                        <form action="{{route('book.destroy', [$group->id])}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="waves-effect waves-light btn-small">Delete Booking</button>

                        </form>

                    </li>

                </ul>
            </div>
        @endforeach
        <div class="col-md-5">
        <button class="waves-effect waves-light btn-small white"><a href="{{route('show.groups')}}">Back to Classes</a></button>
        </div>
    </div>

@endsection