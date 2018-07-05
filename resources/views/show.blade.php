@extends('layouts.app')
@section('content')
    @if (session('status'))
        <div class="alert alert-warning">
            {{ session('status') }}
        </div>
    @endif
    @include('filterdays')

    @forelse($groups as $group)
        <div class="container">
            <div class="row">
                <div class="col s6">
                <ul class="collection">
                    <li class="collection-item avatar">
                        <i class="material-icons circle">folder</i>
                        <span class="title">{{optional($group->lesson)->name ?? $group->id}}</span>
                        <p> {{date('D M Y', strtotime($group->day))}} <br>
                           at {{$group->time}}<br>
                            Level: {{$group->level->level}}
                        </p>

                        <form method="POST" action="{{route('book.group',[$group->id])}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="hidden" name="group_id" value="{{$group->id}}">
                                <input type="hidden" name="day_time" value="{{$group->day_time}}">
                                <input type="hidden" name="user_id" value="{{auth()->id()}}">
                                <hr>

                                <button type="submit"
                                        class="waves-effect waves-light btn-small"{{ $group->isBooked() ? 'disabled' : '' }}
                                        {{$group->attendance() >= $group->capacity() ? 'disabled' : '' }}>
                                    {{ $group->capacity() - $group->attendance() }}
                                    of: {{$group->max_capacity}} {{'available'}}
                                </button>

                            </div>
                        </form>
                    </li>
                </ul>
                </div>

            </div>
                @can ('before', $group)
                    <form action="{{route('group.destroy', [$group->id])}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="waves-effect waves-light btn-outline-secondary">Delete Group
                        </button>
                    </form>
                @endcan
        </div>

    @empty
        <div class="center-align">
            <h3>There are no group results at this time.</h3>
        </div>

    @endforelse

@endsection