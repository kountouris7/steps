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

//$groups is shared from AppServiceProvider

    public function index()
    {
        return view('show');
    }

    public function store(Group $group, User $user, BookGroupRequest $request)
    {
        list($groupDateWeekStart, $groupDateWeekEnd) = $this->requestedGroupWeek($group);
        $userSubscriptions = $user->subscription()->get();
        $bookingsTotal     = $user->groups()->get();

        $bookingsWeekly = $this->bookingsWeekly($user, $groupDateWeekStart, $groupDateWeekEnd);

        if ($group->attendance() >= $group->capacity()) {
            return back()->with('status', 'Sorry this group is fully booked');
        }

        foreach ($userSubscriptions as $userSubscription) {
            if ($bookingsWeekly == $userSubscription->package_week) {
                return back()->with('status', 'Sorry, you are not allowed another booking in this week');
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

        if (request()->expectsJson()) {
            return response()->json(['success' => 'Data is successfully added']);
        }

        return back()->with('status', 'Group booked');

    }

    public function requestedGroupWeek(Group $group): array
    {
        $groupDate          = $group->day_time;
        $groupDateWeekStart = Carbon::parse($groupDate)->copy()->startOfWeek()->toDateString();
        $groupDateWeekEnd   = Carbon::parse($groupDate)->copy()->endOfWeek()->toDateString();

        return [$groupDateWeekStart, $groupDateWeekEnd];
    }

    public function bookingsWeekly(User $user, $groupDateWeekStart, $groupDateWeekEnd): int
    {
        $bookingsWeekly = $user->groups()
                               ->whereBetween('day_time', [$groupDateWeekStart, $groupDateWeekEnd])
                               ->count();

        return $bookingsWeekly;
    }

    public function daysFilter($day)
    {
        $groups = Group::with('level', 'lesson', 'bookings')
                       ->whereRaw("WEEKDAY(groups.day_time) =" . $day)
                       ->where('day_time', '>=', today())
                       ->orderBy('day_time')
                       ->get();

        return view('show', compact('groups'));
    }

}
