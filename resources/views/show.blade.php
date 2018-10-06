@extends('layouts.app')
@section('content')
    @include('filterdays')
    <div class="container">
        <div class="row">
            @forelse($groups as $group)
               {{-- <form method="POST" action="{{route('book.group',[$group->id, auth()->id()])}}">
                    {{csrf_field()}} --}}

                <div class="form-group">
                   {{-- <input type="hidden" name="group_id" value="{{$group->id}}">
                     <input type="hidden" name="user_id"  value="{{auth()->id()}}"> --}}
                    <div class="col s12 m4 l6 ">

                        <div class="card">
                            <div class="card-content">
                                <p class="title col s12 center-align">
                                    <strong>{{optional($group->lesson)->name ?? $group->id}}</strong> <br>
                                    {{Carbon\Carbon::parse($group->day_time)->format('D d, H:m')}}<br>
                                </p>
                            </div>

                            <div class="card-tabs">
                                <ul class="tabs tabs-fixed-width">
                                    <li class="tab"><a class="active"
                                                       href="#test-level-{{$group->id}}">Level</a>
                                    </li>
                                    <li class="tab"><a class="active"
                                                       href="#test-desc-{{$group->id}}">Description</a></li>
                                    <li class="tab">

                                        <groups :group="{{$group}}"></groups>

                                        {{-- <button type="submit"
                                                   class="waves-effect pink accent-3 btn-small"{{ $group->isBooked() ? 'disabled' : '' }}
                                                   {{$group->clients->count() >= $group->max_capacity ? 'disabled' : '' }}> {{ $group->max_capacity - $group->clients->count()}}
                                               of: {{$group->max_capacity}}   {{'available'}}
                                           </button> --}}


                                    </li>
                                </ul>
                            </div>


                            <div class="card-content grey lighten-4 center-align">
                                <div id="test-desc-{{$group->id}}">{{optional($group->lesson)->body ?? $group->id}}</div>
                                <div id="test-level-{{$group->id}}">{{$group->level->level}}</div>
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
