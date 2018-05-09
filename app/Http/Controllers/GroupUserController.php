<?php

namespace App\Http\Controllers;

use App\Group;
use App\GroupUser;
use App\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;


class GroupUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }


    public function create()
    {

    }


    public function store()
    {

    }


    public function show()
    {

    }


    public function edit()
    {
        //
    }


    public function update()
    {

    }


    public function destroy(Request $request,$groupuser, User $user)
    {
        $groupuser = GroupUser::whereGroupId($groupuser)
                          ->whereUserId(auth()->id())
                          ->first();

        $today = Carbon::today()->now()->toDateTimeString();

      if( $groupuser->group->day_time > $today) {

            $this->authorize('update', $groupuser);

            $groupuser->delete();
      }

        if (request()->wantsJson()) {
            return response()->json(['message' => 'success'], 200);
        }

        return redirect(route('profiles', $groupuser->creator));
    }
}
