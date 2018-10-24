@extends('layouts.app')
@section('content')
    @include('profiles.layouts.profilesnav')
    <div class="container">
        <div style="width:800px; margin:0 auto;">
            @forelse ($groups as $group)

                <div class="container">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <i class="material-icons circle">folder</i>
                            {{ $group->created_at->diffForHumans() }}:<br>
                            You have booked: {{$group->lesson->name}}<br>
                            On {{date('D M Y', strtotime($group->day_time))}}<br>
                            @ {{$group->time}}
                            <hr>


                            <form action="{{route('book.destroy', [$group->id])}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="waves-effect waves-light btn-small">Delete</button>

                            </form>

                        </li>

                    </ul>
                </div>

            @empty
                <div class="center-align">
                    <h3>You have no past bookings...</h3>
                </div>
            @endforelse
        </div>
    </div>

@endsection