<?php

namespace App\Http\Controllers;

use App\Group;
use App\Policies\GroupUserPolicy;
use Carbon\Carbon;
use Illuminate\Http\Request;


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


    public function destroy(Request $request, $group)
    {
        $group = Group::findOrFail($group);

        $today = Carbon::today()->now()->toDateTimeString();

        if ($today < $group->day_time) {

            $this->authorize('update', $group);

            auth()->user()->groups()->detach($group->id);
        }

        if (request()->wantsJson()) {
            return response()->json(['message' => 'success'], 200);
        }

        return redirect(route('profiles', auth()->id()));
    }
}
