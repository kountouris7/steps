<?php

namespace App\Http\Controllers;

use App\Group;
use App\GroupUser;
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


    public function show()
    {

    }


    public function edit()
    {
        //
    }


    public function update()
    {
        //
    }


    public function destroy()
    {
        //
    }
}
