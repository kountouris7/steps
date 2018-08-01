@extends('administrator.layouts.app')
@section('content')
    @include('administrator.invite')
    @include('administrator.layouts.tableView')
    <table>
        <thead>
        <tr>
            <th>n.</th>
            <th>NAME</th>
            <th>SURNAME</th>
            <th>E-MAIL</th>
            <th>PACK</th>
            <th>AMOUNT</th>
            <th>DISCOUNT</th>
            <th>PRICE</th>
            <th>MONTH</th>
        </tr>
        </thead>
        <tbody>
        @foreach($subscribers as $subscriber)

            <tr>
                <td>{{$subscriber->id}}</td>
                <td><a href="{{ route('subscriber.profile', [$subscriber->id]) }}">{{$subscriber->name}}</a> </td>
                <td>{{$subscriber->surname}}</td>
                <td>{{$subscriber->email}}</td>
                <td>{{$subscriber->package_week}}</td>
                <td>{{$subscriber->amount}}</td>
                <td>{{$subscriber->discount}}</td>
                <td>{{$subscriber->price}}</td>
                <td>{{Carbon\Carbon::parse($subscriber->month)->format('F Y')}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
@endsection