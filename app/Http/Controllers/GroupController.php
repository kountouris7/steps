<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\BookGroupRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

//this check if user has booked 2 groups on the same date..need to move this to a form request //

        $bookingSameDays = User::with('groups')->get();

        foreach ($bookingSameDays as $bookingSameDay) {

            foreach ($bookingSameDay->groups as $newBooking) {

                if (Carbon::parse($newBooking->day_time)
                          ->format('D F Y') == Carbon::parse($group->day_time)
                                                     ->format('D F Y')) {
                    return back()->with('status', 'You already booked a class on this day');
                }
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
