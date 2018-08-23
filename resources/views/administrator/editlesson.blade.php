@extends('administrator.layouts.app')
@section('content')
    <div class="row">
        <h3>Create Lesson</h3>

        <form method="POST" action="{{route('lesson.update', [$lesson->id])}}">
            {{csrf_field()}}

            <div class="row">
                <div class="input-field col s6">
                    <input id="name" type="text" class="validate" name="name" value="{{$lesson->name}}" required>
                    <label for="name">Change Lesson Name</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <textarea id="body" type="text" class="validate" name="body" placeholder="{{$lesson->body}}" required></textarea>
                    <label for="body">Change Description</label>
                </div>
            </div>

            <button class="btn waves-effect waves-light" type="submit">Save
                <i class="material-icons right">save</i>
            </button>

        </form>
    </div>
@endsection