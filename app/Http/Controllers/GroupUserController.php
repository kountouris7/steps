<?php

namespace App\Http\Controllers;

use App\Group;
use App\Group_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        //
    }


    public function store(Group $group)
    {
        $group->book();

        return back();

    }


    public function show(Group_user $group_user)
    {
        //
    }


    public function edit(Group_user $group_user)
    {
        //
    }


    public function update(Request $request, Group_user $group_user)
    {
        //
    }


    public function destroy(Group_user $group_user)
    {
        //
    }
}
