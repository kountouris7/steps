<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;

class ProfilesController extends Controller
{
    public function dashboard(User $user)
    {
        $groupDateMonthStart           = Carbon::now()->firstOfMonth()->toDateString();
        $groupDateMonthEndPlusTwoWeeks = Carbon::now()->endOfMonth()->addWeeks('2')->toDateString();

        $groups = $user->groups()
                       ->whereBetween('day_time', [$groupDateMonthStart, $groupDateMonthEndPlusTwoWeeks])
                       ->get();

        return view('profiles.dashboard', compact('user', 'groups'));
    }

    public function showBookings(User $user)
    {
        $currentMonth = Carbon::now()->format('F');
        //doesn't show past bookings...
        $groups       = $user->groups()->with('lesson')
                             ->where('day_time', '>', today())
                             ->get();

        return view('profiles.showBookings', compact('user', 'groups', 'currentMonth'));

    }

    public function showPastBookingsCurrentMonth(User $user)
    {
        $currentMonth = Carbon::now()->format('F');
        $groupDateMonthStart = Carbon::now()->firstOfMonth()->toDateTimeString();
        //shows past bookings of this Month only...
        $groups = $user->groups()->with('lesson')
                       ->whereBetween('day_time', [$groupDateMonthStart, today()])
                       ->get();

        return view('profiles.past_bookings', compact('user', 'groups', 'currentMonth'));
    }
}
