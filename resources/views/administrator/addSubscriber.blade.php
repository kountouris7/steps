@extends('administrator.layouts.app')
@section('content')
    @include('administrator.layouts.tableView')

    <form method="POST" action="{{route('add.subscriber')}}">
    {{csrf_field()}}

        <div class="container" style="margin-left: 6%">
            <div class="panel-heading">
                <div class="title">
                    <h4 class="flex">

                    </h4>
                </div>

                    <table>
                        <thead>
                        <tr>
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
                            <td><input type="text" name="name" id="name" class="form-control"
                                       placeholder="name"  style="width: 80px; height: 30px">
                            </td>

                            <td><input type="text" name="surname" id="surname" class="form-control"
                                       placeholder="surname"
                                       style="width: 80px; height: 30px">
                            </td>

                            <td><input type="text" name="email" id="email"  class="form-control"
                                       placeholder="email"
                                       style="width: 180px; height: 30px">
                            </td>

                            <td><input type="text" name="package_week" id="package_week" class="form-control"
                                       placeholder="package_week"
                                       style="width: 80px; height: 30px">
                            </td>

                            <td><input type="text" name="amount" id="amount"  class="form-control"
                                       placeholder="amount"
                                       style="width: 80px; height: 30px">
                            </td>

                            <td><input type="text" name="discount" id="discount"  class="form-control"
                                       placeholder="discount"
                                       style="width: 80px; height: 30px">
                            </td>

                            <td><input type="text" name="price" id="price" class="form-control"
                                       placeholder="price" style="width: 80px; height: 30px">
                            </td>

                            <td><input type="text" name="month" id="month"  class="form-control"
                                       placeholder="month"
                                       style="width: 140px; height: 30px">
                            </td>

                        </tr>

                        </tbody>
                    </table>

                <div class="form-group">
                    <button type="submit" class="waves-effect pink accent-3 btn-small">Add Subscriber</button>
                </div>
            </div>
        </div>
    </form>
@endsection