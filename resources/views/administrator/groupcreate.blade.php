@extends('administrator.layouts.app')
@section('content')


        @include('partials.errors')

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="level">
                    <h3 class="flex">
                        {{$lesson->name}}
                    </h3>
                </div>
                <form method="POST" action="{{route('save.group', [$lesson->id])}}">
                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="title">Date:</label>
                        <input type="datetime-local" class="form-control" id="day_time" name="day_time"
                               style="width: 250px"
                               min="{{Carbon\Carbon::now()->toDateString()}}" required>
                    </div>

                    <div class="form-group">
                        <label for="max_capacity">Maximum Capacity:</label>
                        <textarea name="max_capacity" id="max_capacity" class="form-control"
                                  style="width: 100px; height: 40px">  </textarea>
                    </div>

                    <div class="form-group">
                        <label for="level">Choose Level:</label>
                        <select name="level" id="level" class="form-group" required>
                            <option value="">Choose One...</option>

                            @foreach ($levels as $level)
                                <option value="{{$level->id}}" {{ old('level_id') == $level->id ? 'selected' : '' }}>
                                    {{$level->level}}
                                </option>
                            @endforeach
                        </select>

                        <div class="form-group">
                            <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                            <input type="hidden" name="level_id" value="{{$level->id}}">
                            <button type="submit" class="btn btn-primary">Publish Group</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
