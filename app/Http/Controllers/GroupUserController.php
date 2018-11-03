<?php

namespace App\Http\Controllers;

use App\Group;
use App\GroupUser;


class GroupUserController extends Controller
{
    /**
     * @param $group
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($group)
    {
        //this is for softDeletes i dont think is what i need here??

        //$group = Group::findOrFail($group);
        //GroupUser::where('group_id' , $group->id)->delete();

        $group = Group::findOrFail($group);
        $this->authorize('update', $group);
        auth()->user()->groups()->detach($group->id);

        if (request()->wantsJson()) {
            return response()->json(['message' => 'success'], 200);
        }

        return back();
    }
}
