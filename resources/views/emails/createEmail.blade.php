@extends('administrator.layouts.app')
@section('content')


    <div class="form-group">
        <h3>Email</h3>
    </div>

    <form method="POST" action="{{route('send.email')}}">

        {{csrf_field()}}

        <div class="form-group">
            <input type="email" name="email" placeholder="email@example.com">
            <button type="submit" class="btn btn-primary">Send Email</button>
        </div>

        <div class="form-group">
            <label for="name">Subject:</label>
            <input type="text" class="form-control" id="subject" name="subject" value="{{old ('subject')}}"
                   required>
        </div>

        <div class="form-group">
            <label for="body">Description:</label>
            <textarea name="body" id="body" class="form-control" rows="8" required> {{old ('body')}} </textarea>
        </div>

    </form>

@endsection