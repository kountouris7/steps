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
                            <ul class="collapsible popover-body">
                                <li>
                                    <div class="collapsible-header">
                                        <span class="title col s12 center-align">
                                            {{optional($group->lesson)->name ?? $group->id}}<br>
                                            {{Carbon\Carbon::parse($group->day_time)->toDayDateTimeString()}}<br>
                                            Level: {{$group->level->level}}
                                        </span>
                                    </div>

                                    <div class="center-align">
                                        <button type="submit"
                                                class="waves-effect waves-ripple pink accent-3 btn-small"{{ $group->isBooked() ? 'disabled' : '' }}
                                                {{$group->attendance() >= $group->capacity() ? 'disabled' : '' }}>
                                            {{ $group->capacity() - $group->attendance() }}
                                            of: {{$group->max_capacity}} {{'available'}}
                                        </button>
                                    </div>

                                    <div class="collapsible-body center-align">
                                        <span>{{optional($group->lesson)->body ?? $group->id}}</span>
                                    </div>
                                </li>
                            </ul>
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