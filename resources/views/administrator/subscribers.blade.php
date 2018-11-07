@extends('administrator.layouts.app')
@section('content')
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

       @include('administrator.layouts.navSubscribersByMonth')

        @foreach($subscribers as $subscriber)
            <tr>
                <td>{{$subscriber->get('id')}}</td>
                <td><a href="{{ route('subscriber.profile', [$subscriber->get('id')]) }}">{{$subscriber->get('name')}}</a></td>
                <td>{{$subscriber->get('surname')}}</td>
                <td>{{$subscriber->get('email')}}</td>
                <td>{{$subscriber->get('package_week')}}</td>
                <td>{{$subscriber->get('amount')}}</td>
                <td>{{$subscriber->get('discount')}}</td>
                <td>{{$subscriber->get('price')}}</td>
                <td>{{Carbon\Carbon::parse($subscriber->get('month'))->format('F Y')}}</td>
                <td><a href="{{route('subscriber.edit', [$subscriber->get('id')])}}">Edit</a> </td>

            </tr>
        @endforeach
        </tbody>
    </table>
        @include('administrator.invite')


@endsection