@extends('administrator.layouts.app')
@section('content')
    @include('partials.errors')
    <div style="width:800px; margin:0 auto;">
        <div class="panel panel-default">
            <div class="panel-heading">

                <form method="POST" action="{{route('store.payment')}}">
                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="title">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" style="width: 250px" required>
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount Paid:</label>
                        <input type="text" class="form-control" id="amount" name="amount" style="width: 250px" required>
                    </div>

                    <div class="form-group">
                        <label for="title">Date:</label>
                        <input type="date" class="form-control" id="date" name="date"
                               style="width: 250px"
                               min="{{Carbon\Carbon::now()->toDateString()}}" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save Payment</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection