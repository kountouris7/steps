@extends('administrator.layouts.app')
@section('content')
    @include('partials.errors')

        @foreach($lessons as $lesson)
            <div class="collection">
                <a href="{{ route('create.group', [$lesson->id]) }}" class="collection-item">{{$lesson->name}}</a>

            </div>
        @endforeach


@endsection
