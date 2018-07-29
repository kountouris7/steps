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

        $groups = Group::with('level')->where('day_time', '>=', today()->nowWithSameTz())
                       ->orderBy('day_time')
                       ->get();
        return view('show', compact('groups'));
    }

    public function store(Group $group, BookGroupRequest $request)
    {
        if ($group->attendance() >= $group->capacity()) {
            return back()->with('status', 'Sorry this group is fully booked');
        }

        $userGroupsOnTheSameDate = auth()->user()->groups()
                                         ->where('day_time', $group->day_time)
                                         ->exists();
        if ($userGroupsOnTheSameDate == 1) {
            return back()->with('status', 'You already booked a class on this day');
        }

        $group->clients()
              ->attach($group->id,
                  $user = [
                      'user_id' => request('user_id'),
                  ]);

        return back()->with('status', 'Group booked');
    }

    public function daysFilter($day)
    {
        $groups = Group::DayFilter($day)->get();

        return view('show', compact('groups'));
    }


}
