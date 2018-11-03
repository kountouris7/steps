@extends('administrator.layouts.app')
@section('content')

    <div class="container">
        <div class="panel-heading">
            <div class="title">
                <h4 class="flex">
                    ////////
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

                        <td><textarea name="name" id="name" class="form-control"
                                      placeholder="{{$subscriber->name}}" style="width: 80px; height: 30px"></textarea>
                        </td>

                        <td><textarea name="surname" id="surname" class="form-control"
                                      placeholder="{{$subscriber->surname}}"
                                      style="width: 80px; height: 30px"></textarea>
                        </td>

                        <td>{{$subscriber->email}}</td>

                        <td><textarea name="surname" id="surname" class="form-control"
                                      placeholder="{{$subscriber->package_week}}"
                                      style="width: 80px; height: 30px"></textarea></td>

                        <td><textarea name="surname" id="surname" class="form-control"
                                      placeholder="{{$subscriber->amount}}"
                                      style="width: 80px; height: 30px"></textarea>
                        </td>

                        <td><textarea name="surname" id="surname" class="form-control"
                                      placeholder="{{$subscriber->discount}}"
                                      style="width: 80px; height: 30px"></textarea>
                        </td>

                        <td><textarea name="surname" id="surname" class="form-control"
                                      placeholder="{{$subscriber->price}}" style="width: 80px; height: 30px"></textarea>
                        </td>

                        <td><textarea name="surname" id="surname" class="form-control"
                                      placeholder="{{Carbon\Carbon::parse($subscriber->month)->format('F Y')}}"
                                      style="width: 100px; height: 40px"></textarea></td>

                    </tr>

                    </tbody>
                </table>

                <div class="form-group">
                    <button type="submit" class="waves-effect pink accent-3 btn-small">Update Client</button>
                </div>

            </form>
        </div>
    </div>
@endsection