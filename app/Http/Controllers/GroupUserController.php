<?php

namespace App\Http\Controllers;

use App\Group;
use Carbon\Carbon;
use Illuminate\Http\Request;


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
        $group = Group::findOrFail($group);

            $this->authorize('update', $group);
            auth()->user()->groups()->detach($group->id);

        if (request()->wantsJson()) {
            return response()->json(['message' => 'success'], 200);
        }

        return back();
    }
}
