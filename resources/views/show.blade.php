@extends('layouts.app')
@section('content')
    @include('filterdays')
    @if (session('status'))
        <div class="alert alert-warning">
            {{ session('status') }}
        </div>
    @endif

    <div class="container">
        <div class="row">

            @forelse($groups as $group)

                <form method="POST" action="{{route('book.group',[$group->id])}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="hidden" name="group_id" value="{{$group->id}}">
                        <input type="hidden" name="user_id" value="{{auth()->id()}}">

                        <div class="col s12 m4 l6 ">

                            <div class="card">
                                <div class="card-content">
                                    <p class="title col s12 center-align">
                                        {{optional($group->lesson)->name ?? $group->id}}<br>
                                        {{Carbon\Carbon::parse($group->day_time)->toDayDateTimeString()}}<br>
                                    </p>
                                </div>

                                <div class="card-tabs">
                                    <ul class="tabs tabs-fixed-width">
                                        <li class="tab"><a class="active" href="#test-level-{{$group->id}}">Level</a></li>
                                        <li class="tab"><a class="active" href="#test-desc-{{$group->id}}">Description</a></li>
                                        <li class="tab"><button type="submit"
                                                                class="waves-effect pink accent-3 btn-small"{{ $group->isBooked() ? 'disabled' : '' }}
                                                    {{$group->attendance() >= $group->capacity() ? 'disabled' : '' }}> {{ $group->capacity() - $group->attendance() }}
                                                of: {{$group->max_capacity}} {{'available'}}
                                            </button></li>
                                    </ul>
                                </div>
                                <div class="card-content grey lighten-4 center-align">
                                    <div id="test-desc-{{$group->id}}">{{optional($group->lesson)->body ?? $group->id}}</div>
                                    <div id="test-level-{{$group->id}}">{{$group->level->level}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                @can ('before', $group)
                    <form action="{{route('group.destroy', [$group->id])}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="waves-effect waves-light btn-outline-secondary">Delete Group
                        </button>
                    </form>
                @endcan

            @empty
                <div class="center-align">
                    <h4>There are no groups on this day yet...</h4>
                </div>

            @endforelse
        </div>
    </div>

@endsection