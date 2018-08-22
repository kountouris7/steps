@extends('administrator.layouts.app')
@section('content')
    <form method="POST" action="{{route('group.update', [$group->id])}}">
        {{csrf_field()}}
        <div class="form-group">
            <label for="day_time">Date & Time:</label>
            <input type="datetime-local" class="form-control" id="day_time" name="day_time"
                   style="width: 250px"
                   min="{{Carbon\Carbon::now()->toDateTimeString()}}" required>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <input id="name" type="text" class="form-control" name="name" value="{{$group->lesson->name}}">
                <label for="name">Lesson Name</label>
            </div>
        </div>

            <div class="form-group">
                <div class="input-field col s6">
                    <textarea id="body" class="form-control" type="text" name="body" placeholder="{{$group->lesson->body}}"></textarea>
                    <label for="body">Description</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update Group</button>
            </div>
        </form>

        @endsection