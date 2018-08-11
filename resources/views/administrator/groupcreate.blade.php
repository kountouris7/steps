@extends('administrator.layouts.app')
@section('content')


    @include('partials.errors')

    <div class="panel panel-default" xmlns="http://www.w3.org/1999/html">
        <div class="panel-heading">
            <div class="level">
                <h3 class="flex">
                    {{$lesson->name}}
                </h3>
            </div>
            <form method="POST" action="{{route('save.group', [$lesson->id])}}">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="day_time">Date & Time:</label>
                    <input type="datetime-local" class="form-control" id="day_time" name="day_time"
                                   style="width: 250px"
                                   min="{{Carbon\Carbon::now()->toDateTimeString()}}" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="max_capacity">Maximum Capacity:</label>
                    <textarea name="max_capacity" id="max_capacity" class="form-control"
                              style="width: 100px; height: 40px">  </textarea>
                </div>
                <br>
                <div class="form-group">
                    <label for="level">Choose Level:</label>
                    <select name="level_id" id="level_id" class="form-group" required>
                        <option value=""></option>

                        @foreach ($levels as $lvl => $level)
                            <option value="{{$level->id}}" {{old('level_id') == $level->id ? 'selected' : '' }}>
                                {{$level->level}}
                            </option>
                        @endforeach
                    </select>


                    <div class="form-group">
                        <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                        <input type="hidden" name="level" value="{{$level->id}}">
                        <button type="submit" class="btn btn-primary">Publish Group</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <form method="POST" action="{{route('create.level')}}">
        {{csrf_field()}}
        <br>
        <div class="form-group">
            <label for="level">Create New Level:</label>
            <textarea name="level" id="level" class="form-control"
                      style="width: 100px; height: 40px">  </textarea>
            <hr>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save New Level</button>
            </div>

        </div>
    </form>

@endsection

