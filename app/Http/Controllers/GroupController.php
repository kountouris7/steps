<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\BookGroupRequest;
use Carbon\Carbon;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $today = Carbon::today()->now()->toDateTimeString();

        $groups = Group::with([
            'lesson',
            'level',
        ])->where('day_time', '>=', $today)->orderBy('day_time')->get();

        return view('show', compact('groups'));

    }

    public function store(Group $group, BookGroupRequest $request)
    {

        if ($group->attendance() >= $group->capacity()) {
            return back()->with('status', 'Sorry this group is fully booked');
        }
        $group->book();

        return back();
    }

    public function monday()
    {
        $today = Carbon::today()->now()->toDateTimeString();

        $groups = Group::with([
            'lesson',
            'level',
        ])->whereRaw('WEEKDAY(groups.day_time) = 0')
                       ->where('day_time', '>=', $today)
                       ->orderBy('day_time')->get();

        return view('filterday', compact('groups'));
    }

    public function tuesday()
    {
        $today = Carbon::today()->now()->toDateTimeString();

        $groups = Group::with([
            'lesson',
            'level',
        ])->whereRaw('WEEKDAY(groups.day_time) = 1')
                       ->where('day_time', '>=', $today)
                       ->orderBy('day_time')->get();

        return view('filterday', compact('groups'));
    }

    public function wednesday()
    {
        $today = Carbon::today()->now()->toDateTimeString();

        $groups = Group::with([
            'lesson',
            'level',
        ])->whereRaw('WEEKDAY(groups.day_time) = 2')
                       ->where('day_time', '>=', $today)
                       ->orderBy('day_time')->get();

        return view('filterday', compact('groups'));
    }

    public function thursday()
    {
        $today = Carbon::today()->now()->toDateTimeString();

        $groups = Group::with([
            'lesson',
            'level',
        ])->whereRaw('WEEKDAY(groups.day_time) = 3')
                       ->where('day_time', '>=', $today)
                       ->orderBy('day_time')->get();

        return view('filterday', compact('groups'));
    }

    public function friday()
    {
        $today = Carbon::today()->now()->toDateTimeString();

        $groups = Group::with([
            'lesson',
            'level',
        ])->whereRaw('WEEKDAY(groups.day_time) = 4')
                       ->where('day_time', '>=', $today)
                       ->orderBy('day_time')->get();

        return view('filterday', compact('groups'));
    }
}
