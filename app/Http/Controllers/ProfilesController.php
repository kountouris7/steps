<?php

namespace App\Http\Controllers;

use App\User;

class ProfilesController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @param  User $user
     *
     * @return \Response
     */
    public function show(User $user)
    {
        $user->load('groups.lesson');

//        $groupusers = GroupUser::with('lesson')
//                               ->where('user_id', '=', $user->id)
//                               ->orderBy('group_id')
//                               ->get();


        return view('profiles.show', [
            'user' => $user,
        ]);

    }
}
