@extends('administrator.layouts.app')
@section('content')

    <div style="width:800px; margin:0 auto;">
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
    </div>

    @endforeach
@endsection
