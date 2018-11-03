<?php

namespace App\Http\Controllers;

use App\GroupUser;
use App\User;
use Carbon\Carbon;

class ProfilesController extends Controller
{
    public function dashboard(User $user)
    {
        $groupDateMonthStart = Carbon::now()->firstOfMonth()->toDateString();
        $groupDateMonthEndPlusTwoWeeks   = Carbon::now()->endOfMonth()->addWeeks('2')->toDateString();

        $groups = $user->groups()
                       ->whereBetween('day_time', [$groupDateMonthStart, $groupDateMonthEndPlusTwoWeeks])
                       ->get();

        return view('profiles.dashboard', compact('user', 'groups'));
    }

    public function showBookings(User $user)
    {
        $groups = $user->groups()->with('lesson')
                       ->where('day_time', '>', today())
                       ->get(); //doesn't show past bookings

        return view('profiles.showBookings', compact('user', 'groups'));

    }

    public function showPastBookings(User $user)
    {
        $groups = $user->groups()->with('lesson')
                       ->where('day_time', '<', today())
                       ->get();

        return view('profiles.past_bookings', compact('user', 'groups'));
    }
}
