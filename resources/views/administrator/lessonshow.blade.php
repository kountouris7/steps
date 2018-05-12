@extends('layouts.app')
@section('content')

    @include('partials.errors')
    @foreach($lessons as $lesson)

        <div class="book-lesson">
            <div class="col-sm-8 blog-main">
                <div class="book-lesson-title">
                    <h3>
                        <a href="{{ route('create.group', [$lesson->id]) }}">{{$lesson->name}}</a>
                    </h3>
                </div>
            </div>
        </div>

    @endforeach

@endsection