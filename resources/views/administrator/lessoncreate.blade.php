@extends('administrator.layouts.app')
@section('content')
    <div style="width:800px; margin:0 auto;">

        <div class="form-group">
            <h3>Create Lesson</h3>
        </div>

        <form method="POST" action="{{route('save.lesson')}}">
            {{csrf_field()}}
            <div class="form-group">
                <label for="name">Lesson Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old ('name')}}" required>
            </div>

            <div class="form-group">
                <label for="body">Description:</label>
                <textarea name="body" id="body" class="form-control" rows="8" required> {{old ('body')}} </textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save Lesson</button>
            </div>
        </form>
    </div>
@endsection