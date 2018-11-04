@extends('administrator.layouts.app')
@section('content')

    <div class="container" style="margin-left: 9%">
        <div class="panel-heading">
            <div class="title">
                <h4 class="flex">
                    Edit <strong>{{$subscriber->name}}</strong>
                </h4>
            </div>
            <form method="POST" action="{{route('subscriber.update', [$subscriber->id])}}">
                {{csrf_field()}}
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


                    <tr>
                        <td>{{$subscriber->id}}</td>

                        <td><input type="text" name="name" id="name" value="{{ old('name', $subscriber->name) }}" class="form-control"
                                      placeholder="{{$subscriber->name}}"  style="width: 80px; height: 30px">
                        </td>

                        <td><input type="text" name="surname" id="surname" value="{{ old('surname', $subscriber->surname) }}" class="form-control"
                                          placeholder="{{$subscriber->surname}}"
                                          style="width: 80px; height: 30px">
                        </td>

                        <td><input type="text" name="email" id="email" value="{{ old('email', $subscriber->email) }}" class="form-control"
                                      placeholder="{{$subscriber->email}}"
                                      style="width: 180px; height: 30px">
                        </td>

                        <td><input type="text" name="package_week" id="package_week" value="{{ old('package_week', $subscriber->package_week) }}" class="form-control"
                                      placeholder="{{$subscriber->package_week}}"
                                      style="width: 80px; height: 30px">
                        </td>

                        <td><input type="text" name="amount" id="amount" value="{{ old('amount', $subscriber->amount) }}" class="form-control"
                                      placeholder="{{$subscriber->amount}}"
                                      style="width: 80px; height: 30px">
                        </td>

                        <td><input type="text" name="discount" id="discount" value="{{ old('discount', $subscriber->discount) }}" class="form-control"
                                      placeholder="{{$subscriber->discount}}"
                                      style="width: 80px; height: 30px">
                        </td>

                        <td><input type="text" name="price" id="price" value="{{ old('price', $subscriber->price) }}" class="form-control"
                                      placeholder="{{$subscriber->price}}" style="width: 80px; height: 30px">
                        </td>

                        <td><input type="text" name="month" id="month" value="{{ old('month', $subscriber->month)->format('F Y') }}" class="form-control"
                                      placeholder="{{Carbon\Carbon::parse($subscriber->month)->format('F Y')}}"
                                      style="width: 140px; height: 30px">
                        </td>

                    </tr>

                    </tbody>
                </table>
<br>
                <div class="form-group">
                    <button type="submit" class="waves-effect pink accent-3 btn-small">Update Client</button>
                </div>

            </form>

        </div>
    </div>
@endsection