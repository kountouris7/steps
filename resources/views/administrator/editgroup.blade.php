@extends('administrator.layouts.app')
@section('content')

    <div class="container">
        <div class="panel-heading">
            <div class="title">
                <h4 class="flex">
                    Edit: {{$group->lesson->name}}
                </h4>
            </div>
            <form method="POST" action="{{route('group.update', [$group->id])}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="day_time">Date & Time:</label>
                    <input type="datetime-local" class="form-control" id="day_time" name="day_time"
                           style="width: 250px" min="{{Carbon\Carbon::now()->toDateTimeString()}}" required>
                </div>
                <br>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="name" type="text" class="form-control" name="name" value="{{$group->lesson->name}}">
                        <label for="name">Lesson Name</label>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="input-field col s6">
                    <textarea id="body" class="form-control" type="text" name="body"
                              placeholder="{{$group->lesson->body}}" style="width: 559px; height: 100px"></textarea>
                        <label for="body">Description</label>
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label for="max_capacity">Maximum Capacity:</label>
                    <textarea name="max_capacity" id="max_capacity" class="form-control"
                              placeholder="{{$group->max_capacity}}" style="width: 100px; height: 40px"></textarea>
                </div>
<br>
                <div class="form-group">
                    <label for="level">Choose Level:</label>
                    <select name="level_id" id="level_id" class="form-group" required>
                        <option value="" disabled selected>{{$groupLevel}}</option>

                        @foreach ($levels as $lvl => $level)
                            <option value="{{$level->id}}" {{old('level_id') == $level->id ? 'selected' : '' }}>
                                {{$level->level}}
                            </option>
                        @endforeach
                    </select>
                </div>
<br>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Group</button>
                </div>

            </form>
        </div>
    </div>
@endsection