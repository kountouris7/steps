@extends('layouts.app')
@section('content')
    @include('filterdays')
    <div class="container">
        <div class="row">
            @forelse($groups as $group)
                <div class="form-group">
                    <div class="col s12 m4 l6">

                        <div class="card">
                            <div class="card-content">
                                <p class="title col s12 center-align">
                                    <strong>{{optional($group->get('lesson'))->name ?? $group->get('id')}}</strong> <br>
                                    {{Carbon\Carbon::parse($group->get('day_time'))->format('l F jS \\@   H:i')}}<br>
                                </p>
                            </div>

                            <div class="card-tabs">
                                <ul class="tabs tabs-fixed-width">
                                    <li class="tab"><a class="active"
                                                       href="#test-level-{{$group->get('id')}}">Level</a>
                                    </li>
                                    <li class="tab"><a class="active"
                                                       href="#test-desc-{{$group->get('id')}}">Description</a></li>
                                    <li class="tab">

                                        <groups :group="{{$group}}" :auth="{{auth()->id()}}"></groups>
                                    </li>
                                </ul>
                            </div>


                            <div class="card-content grey lighten-4 center-align">
                                <div id="test-desc-{{$group->get('id')}}">{{optional($group->get('lesson'))->body ?? $group->get('id')}}</div>
                                <div id="test-level-{{$group->get('id')}}">{{$group->get('level')->level}}</div>
                            </div>
                        </div>

                    </div>
                </div>


            @empty
                <div class="center-align">
                    <h4>There are no groups on this day yet...</h4>
                </div>

            @endforelse
        </div>
    </div>
@endsection
