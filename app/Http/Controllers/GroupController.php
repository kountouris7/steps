<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\BookGroupRequest;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $groups = Group::with([
            'lesson',
            'level',
        ])->latest()->get();
        return view('show', compact('groups'));

    }

    public function store(Group $group, BookGroupRequest $request)
    {

        if ($group->attendance() >= $group->capacity()) {
            return back()->with('status', 'Sorry this group is fully booked');
        }
        $group->book();

        return back();
    }

    public function destroy()
    {
    }
}
