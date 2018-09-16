<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;

class ProfilesController extends Controller
{

    public function show(User $user)
    {
        $groups = $user->groups()->with('lesson')
                       ->where('day_time', '>', today())
                       ->get(); //doesn't show past bookings


        return view('profiles.show', compact('user', 'groups'));

    }

    public function showPastBookings(User $user)
    {
        $groups = $user->groups()->with('lesson')
                       ->where('day_time', '<', today())
                       ->get();

        return view('profiles.past_bookings', compact('user', 'groups'));
    }
}
