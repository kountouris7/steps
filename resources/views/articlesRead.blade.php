@extends('layouts.app')
@section('content')
    @foreach($articles as $article)
        <div class="container">
       {{$article->body}}
        </div>


    @endforeach
@endsection