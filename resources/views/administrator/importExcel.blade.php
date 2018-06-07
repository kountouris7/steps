@extends('administrator.layouts.app')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="level">
                @if ( Session::has('success') )
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ Session::get('success') }}</strong>
                    </div>
                @endif

                @if ( Session::has('error') )
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ Session::get('error') }}</strong>
                    </div>
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <div>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="level">Choose Month:</label>
                        <select name="month" id="month" class="form-group" required>
                            <option value="">Choose One...</option>

                            @foreach ($months as $month)
                                <option value="{{$month->id}}" {{ old('month_id') == $month->id ? 'selected' : '' }}>
                                    {{$month->month}}
                                </option>
                            @endforeach
                        </select>


                        <div class="form-group">
                            Choose your xls/csv File :
                            <input type="file" name="file" class="form-control">
                            <input type="hidden" name="month_id" value="{{$month->id}}">
                            <input type="submit" class="btn btn-primary" style="margin-top: 3%">
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>
    </div>

@endsection