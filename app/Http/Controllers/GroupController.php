<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\BookGroupRequest;
use App\User;
use Carbon\Carbon;

class GroupController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $groups = Group::with('level')->where('day_time', '>=', today())
                       ->orderBy('day_time')
                       ->get();

        return view('show', compact('groups'));
    }

    public function store(Group $group, User $user, BookGroupRequest $request)
    {
        $groupDate          = $group->day_time;
        $groupDateWeekStart = Carbon::parse($groupDate)->copy()->startOfWeek()->toDateString();
        $groupDateWeekEnd   = Carbon::parse($groupDate)->copy()->endOfWeek()->toDateString();
        $userSubscriptions = $user->subscription()->get();
        $bookingsTotal = $user->groups()->get();

        $bookingsWeekly = $user->groups()
                               ->whereBetween('day_time', [$groupDateWeekStart, $groupDateWeekEnd])
                               ->count();

        if ($group->attendance() >= $group->capacity()) {
            return back()->with('status', 'Sorry this group is fully booked');
        }

        foreach ($userSubscriptions as $userSubscription) {
            if ($bookingsWeekly == $userSubscription->package_week) {
                return back()->with('status', 'Sorry, you have spent your subscription limit for this week');
            }
        }
        foreach ($bookingsTotal as $booking) {
            if (Carbon::parse($booking->day_time)
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
