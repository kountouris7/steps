@extends('administrator.layouts.app')
@section('content')
    <div class="row">
        <h3>Create Lesson</h3>

        <form method="POST" action="{{route('save.lesson')}}">
            {{csrf_field()}}

            <div class="row">
                <div class="input-field col s6">
                    <input id="name" type="text" class="validate" name="name" required>
                    <label for="name">Lesson Name</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <textarea id="body" type="text" class="validate" name="body" required></textarea>
                    <label for="body">Description</label>
                </div>
            </div>

            <button class="btn waves-effect waves-light" type="submit">Save
                <i class="material-icons right">save</i>
            </button>

        </form>
    </div>
@endsection