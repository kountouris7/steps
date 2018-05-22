<?php

namespace App\Policies;

use App\Group;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupUserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can update the groupuser.
     *
     * @param  \App\User $user
     * @param Group $group
     *
     * @return mixed
     */
    public function update(User $user, Group $group)
    {
        return $user->groups()->where('groups.id', '=', $group->id)->exists();
    }

    public function before(User $user)//this shouldnt be here??
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
}
