<?php

namespace App\Http\Controllers;

use App\Group;
use App\GroupUser;
use App\Http\Requests\BookGroupRequest;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
   {
       $groups = Group::with('lesson')->orderBy('lesson_id')->get();

       return view('show', compact('groups'));
   }


   public function store(Group $group, BookGroupRequest $request)
   {
       $group->book();

       return back();
   }

    public function destroy()
    {
    }
}
