<?php

namespace App\Http\Controllers;

use App\Group;
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

    /**
     * @param Request $request
     * @param $group
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request,  $group)
    {
        $group = Group::findOrFail($group);

            $this->authorize('update', $group);
            auth()->user()->groups()->detach($group->id);

        if (request()->wantsJson()) {
            return response()->json(['message' => 'success'], 200);
        }

        return redirect(route('profiles', auth()->id()));
    }
}
