@extends('administrator.layouts.app')

@section('content')
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif


    <div class="row">
        <form method="POST" action="{{route('articles.post')}}" class="col s12">
            {{csrf_field()}}
            <div class="row">
                <div class="input-field col s12">
                    <textarea placeholder="Title" id="title" name="title" type="text" required></textarea>
                    <label for="title">Title (to display in card)</label>
                </div>
                <div class="input-field col s12">
                    <textarea placeholder="Description for article" id="description" name="description" type="text"
                              required></textarea>
                    <label for="description">Description (to display in card)</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="textarea1" name="body" required></textarea>
                    <label for="textarea1" class="pink-text">Text area</label>
                </div>
                <div>
                    <button type="submit" class="waves-effect pink accent-3 btn-small">Post</button>
                </div>
            </div>

        </form>
    </div>

@endsection