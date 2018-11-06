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
        $groups = Group::with(['bookings', 'level', 'lesson'])
                       ->where('day_time', '>=', now()->toDateTimeString())
                       ->orderBy('day_time')
                       ->get()
                       ->transform(function ($group) {
                           return collect(array_merge($group->toArray(), [
                               'bookingsCount' => $group->bookingsCount(),
                               'level'         => $group->level,
                               'isBooked'      => $group->bookings->contains('user_id', auth()->id()),
                               'lesson'        => $group->lesson,
                           ]));
                       });

        return view('show')
            ->with('groups', $groups);
    }

    public function store(Group $group, User $user, BookGroupRequest $request)
    {
        list($groupDateWeekStart, $groupDateWeekEnd) = $this->requestedGroupWeek($group);
        $userSubscriptions = $user->subscription()->get();
        $bookingsTotal     = $user->groups()->get();

        $bookingsWeekly = $this->bookingsWeekly($user, $groupDateWeekStart, $groupDateWeekEnd);
        if ($group->attendance() >= $group->capacity()) {
            return response()->json(['message' => 'Sorry this group is fully booked'], 222);
            //return back()->with('flash', 'Sorry this group is fully booked');
        }
        foreach ($userSubscriptions as $userSubscription) {
            if ($bookingsWeekly == $userSubscription->package_week) {
                return response()->json(['message' => 'Sorry, you have reached your weekly booking limit'], 222);
                //return back()->with('flash', 'Sorry, you have reached your weekly booking limit');
            }
        }
        foreach ($bookingsTotal as $booking) {

            if (Carbon::parse($booking->day_time)
                      ->format('d F Y') == Carbon::parse($group->day_time)
                                                 ->format('d F Y')) {
                return response()->json(['message' => 'Already booked a class on this day'], 222);
                //return back()->with('flash', 'Already booked a class on this day');
            }
        }
        try {
            $group->clients()
                  ->attach($group->id,
                      [
                          'user_id' => $user->id,
                      ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error! Something went wrong',
            ], 400);
        }


        if (request()->expectsJson()) {
            return response()->json(['status' => 'Data is successfully added']);
        }

        return response('Booking Successful');
        //return back()->with('flash', 'Booking Successful');
    }


    public function requestedGroupWeek(Group $group): array
    {
        $groupDate          = $group->day_time;
        $groupDateWeekStart = Carbon::parse($groupDate)->startOfWeek()->toDateString();
        $groupDateWeekEnd   = Carbon::parse($groupDate)->endOfWeek()->toDateString();

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
        $dates = [];
        $today = Carbon::today();

        for ($i = 0; $i < 7; $i++) {
            $dates[$today->dayOfWeek] = $today->addDay($i)->startOfDay()->toDateTimeString();
        }

        ksort($dates);

        $dayToSearch = $dates[$day] ?? null;

        $groups = [];

        if ($dayToSearch) {
            $groups = Group::with('level', 'lesson', 'bookings')
                           ->where('day_time', 'like', "$dayToSearch%")
                           ->orderBy('day_time')
                           ->get()
                           ->transform(function ($group) {
                               return collect(array_merge($group->toArray(), [
                                   'bookingsCount' => $group->bookingsCount(),
                                   'level'         => $group->level,
                                   'isBooked'      => $group->bookings->contains('user_id', auth()->id()),
                                   'lesson'        => $group->lesson,
                               ]));
                           });
        }

        return view('show', compact('groups'));
    }

}
