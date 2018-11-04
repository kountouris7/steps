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
                    <label for="day_time">Change Date & Time:</label>
                    <input type="datetime-local" class="form-control" id="day_time"
                           value="{{old('day_time', $group->day_time)}}"
                           name="day_time"
                           style="width: 250px" min="{{Carbon\Carbon::now()->toDateTimeString()}}" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="max_capacity">Change Maximum Capacity:</label>
                    <input type="text" name="max_capacity" id="max_capacity" value="{{old('max_capacity' , $group->max_capacity)}}" class="form-control"
                              placeholder="{{$group->max_capacity}}" style="width: 100px; height: 40px">
                </div>
                <br>
                <div class="form-group">
                    <label for="level">Change Choose Level:</label>
                    <select name="level_id" id="level_id" class="form-group" required>
                        <option value="{{old('level', $group->level)}}" disabled selected>{{$groupLevel}}</option>

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