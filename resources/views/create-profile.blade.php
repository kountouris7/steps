@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('accept', [$invite->token]) }}">
    {{csrf_field()}}
    <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
    <input type="text" class="form-control" id="email" name="email" required>
    <input type="password" class="form-control" id="password" name="password" required>
    <input type="submit" class="btn btn-primary" value="Publish Group">
    </div>
    </form>

@endsection