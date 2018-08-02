@extends('layouts.app')
@section('content')
    @include('filterdays')

    @if (session('status'))
        <div class="alert alert-warning">
            {{ session('status') }}
        </div>
    @endif

    @forelse($groups as $group)
        <div class="container">
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header"><i class="material-icons"></i>
                        <span class="title">{{optional($group->lesson)->name ?? $group->id}}</span><br>
                        {{Carbon\Carbon::parse($group->day_time)->toDayDateTimeString()}} <br>
                            Level: {{$group->level->level}}
                    </div>
                    <div class="collapsible-body"><span>{{optional($group->lesson)->body ?? $group->id}}</span></div>
                </li>
            </ul>

            <form method="POST" action="{{route('book.group',[$group->id])}}">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="hidden" name="group_id" value="{{$group->id}}">
                    <input type="hidden" name="user_id" value="{{auth()->id()}}">

                    <button type="submit"
                            class="waves-effect waves-light btn-small"{{ $group->isBooked() ? 'disabled' : '' }}
                            {{$group->attendance() >= $group->capacity() ? 'disabled' : '' }}>
                        {{ $group->capacity() - $group->attendance() }}
                        of: {{$group->max_capacity}} {{'available'}}
                    </button>

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

        </div>
    @empty
        <div class="center-align">
            <h4>There are no groups on this day yet...</h4>
        </div>

    @endforelse

@endsection