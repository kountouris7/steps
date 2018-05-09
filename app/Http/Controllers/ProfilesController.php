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

        $groupusers = GroupUser::with('lessons')->orderBy('group_id')->get();

        //dd($groupusers);
        return view('profiles.show', [
            'profileUser' => $user,
            'groupUsers' => $user->groupUsers()->paginate(10)
        ] ,compact('groupusers'));

    }
}
