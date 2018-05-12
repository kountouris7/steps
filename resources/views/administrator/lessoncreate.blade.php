@extends('layouts.app')
@section('content')

    @include('partials.errors')

    <div class="book-lesson">
            <div class="col-sm-8 blog-main">
                <div class="create-lesson-title">
                   <h1>Create Lesson</h1>
                </div>

                <form method="POST" action="{{route('save.lesson')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old ('name')}}" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>


@endsection