@extends('layouts.app')
@section('content')

    @if (session('status'))
        <div class="alert alert-warning">
            {{ session('status') }}
        </div>
    @endif
    @foreach($groups as $group)
        <div class="col-md-4">
            <br>
            <h3>{{optional($group->lesson)->name ?? $group->id}}</h3>
            <h4>Starting on:<br>
                {{date('D M Y H:i', strtotime($group->day_time))}} </h4>
            <p><strong>Description: </strong>{{$group->lesson->body}} </p>
            <p><strong>Level:</strong> {{$group->level->level}}</p>

            <form method="POST" action="{{route('book.group',[$group->id])}}">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="hidden" name="group_id" value="{{$group->id}}">
                    <input type="hidden" name="day_time" value="{{$group->day_time}}">
                    <input type="hidden" name="user_id" value="{{auth()->id()}}">

                    <button type="submit" class="btn btn-primary"{{ $group->isBooked() ? 'disabled' : '' }}
                            {{$group->attendance() >= $group->capacity() ? 'disabled' : '' }}>
                        {{ $group->capacity() - $group->attendance() }} of: {{$group->max_capacity}} {{'available'}}
                    </button>

                </div>
            </form>
        </div>

        @can ('before', $group)
            <form action="{{route('group.destroy', [$group->id])}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-link">Delete Group</button>
            </form>
        @endcan

    @endforeach
@endsection