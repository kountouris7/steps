<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\BookGroupRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class GroupController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

//$groups is shared from AppServiceProvider

    public function index()
    {
        $groups = Group::with('level', 'lesson', 'bookings', 'clients')
                       ->where('day_time', '>=', today()->nowWithSameTz()->toDateTimeString())
                       ->orderBy('day_time')
                       ->get();

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
                     return response()->json(['message' => 'Already booked a class on this day' ], 222);
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

    public function reminders()
    {
        $groups = Group::with('clients')
                       ->where('day_time', '>=', today())
                       ->get();

        foreach ($groups as $group) {
            dd($group->clients);
        }
    }

}
