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

        $userSubscriptions = auth()->user()->subscription()->get();
        $bookingSameDays   = auth()->user()->groups()->get();

        dd($userSubscriptions);

        if ($bookingSameDays->count() >= 5) {
            return back()->with('status', 'Sorry, you have reached your limit for this week');
        }


        foreach ($bookingSameDays as $bookingSameDay) {
            if (Carbon::parse($bookingSameDay->day_time)
                      ->format('d F Y') == Carbon::parse($group->day_time)
                                                 ->format('d F Y')) {
                return back()->with('status', 'You already booked a class on this day');
            }
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
