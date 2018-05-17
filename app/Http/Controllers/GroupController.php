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
            'lesson', 'level'
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
        $group->book();

        return back();
    }

    public function destroy()
    {
    }
}
