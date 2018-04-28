<?php

namespace App\Http\Controllers;


use App\Group;
use Illuminate\Http\Request;


class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
   {
       $groups = Group::get();
       return view('show', compact('groups'));
   }

   public function store(Request $request)
   {

   }

}
