@extends('administrator.layouts.app')
@section('content')
    <div class="container">
        <div class="panel-heading">
            <form method="POST" action="{{route('group.update', [$group->id])}}">
                {{csrf_field()}}
                <div class="title">

                    <div class="form-group">
                        <label for="lesson_id">Change Lesson Name:</label>
                        <select name="lesson_id" id="lesson_id" class="form-group" required>
                            <option value="{{old('lesson_id', $group->lesson_id)}}" disabled selected>{{$group->lesson->name}}</option>
                            @foreach ($lessons as $l => $lesson)
                                <option value="{{$lesson->id}}" {{old('lesson_id') == $lesson->id ? 'selected' : '' }}>
                                    {{$lesson->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="day_time">Change Date & Time:</label>
                        <input type="datetime-local" class="form-control" id="day_time"
                               value="{{old('day_time', $group->day_time)}}"
                               name="day_time"
                               style="width: 250px" min="{{Carbon\Carbon::now()->toDateTimeString()}}" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="max_capacity">Change Maximum Capacity:</label>
                        <input type="text" name="max_capacity" id="max_capacity"
                               value="{{old('max_capacity' , $group->max_capacity)}}" class="form-control"
                               placeholder="{{$group->max_capacity}}" style="width: 100px; height: 40px">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="level_id">Change Choose Level:</label>
                        <select name="level_id" id="level_id" class="form-group" required>
                            <option value="{{old('level', $group->level)}}" disabled selected>{{$group->level->level}}</option>

                            @foreach ($levels as $lvl => $level)
                                <option value="{{$level->id}}" {{old('level_id') == $level->id ? 'selected' : '' }}>
                                    {{$level->level}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <br>

                    <div class="form-group">
                        <button type="submit" class="waves-effect pink accent-3 btn-small">Update Group</button>
                    </div>

            </form>
        </div>
    </div>
@endsection