@extends('administrator.layouts.app')
@section('content')
    @include('administrator.layouts.tableView')
    <table>
        <thead>
        <tr>
            <th>n.</th>
            <th>NAME</th>
            <th>SURNAME</th>
            <th>PACK</th>
            <th>AMOUNT</th>
            <th>DISCOUNT</th>
            <th>PRICE</th>
        </tr>
        </thead>
        <tbody>
        @foreach($subscribers as $sub)
            <tr>
                <td>{{$sub->id}}</td>
                <td>{{$sub->name}} </td>
                <td>{{$sub->surname}}</td>
                <td>{{$sub->package_week}}</td>
                <td>{{$sub->amount}}</td>
                <td>{{$sub->discount}}</td>
                <td>{{$sub->price}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
@endsection