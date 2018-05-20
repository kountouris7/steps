<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\BookGroupRequest;
use Illuminate\Support\Facades\Validator;

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

    // public function create(Request $request)
    // {
    //$this->validate($request, [
    //    'lesson_id'    => 'required',
    //    'day_time'     => 'required',
    //    'max_capacity' => 'required',
    //]);
    //Group::create([
    //    'lesson_id'    => request('lesson_id'),
    //    'day_time'     => request('day_time'),
    //    'max_capacity' => request('max_capacity'),
    //]);
    // }


    public function store(Group $group, BookGroupRequest $request)
    {

        if($group->attendance() >= $group->capacity()){
            return back()->with('status', 'Sorry this group is fully booked');
        }
        $group->book();

        return back();
    }

    public function destroy()
    {
    }
}
