@extends('administrator.layouts.app')
@section('content')
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
                    <input placeholder="Title" id="title" name="title" type="text" required>
                    <label for="title">Title</label>
                </div>

                <div class="input-field col s12">
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="textarea1" name="body" class="materialize-textarea" required></textarea>
                    <label for="textarea1" class="pink-text">Text area</label>
                </div>
            </div>

            <button type="submit" class="waves-effect pink accent-3 btn-small">Post</button>

        </form>
    </div>
    @endsection