<?php

namespace App\Http\Controllers;

use App\GroupUser;
use App\User;

class ProfilesController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @param  User $user
     * @return \Response
     */
    public function show(User $user)
    {
        return view('profiles.show', [
            'profileUser' => $user,
            'groupUsers' => $user->groupUsers()->paginate(10),
        ]);
    }
}
