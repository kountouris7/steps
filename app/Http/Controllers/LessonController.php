<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\ServiceProvider;

class LessonController extends Controller
{
    public function __construct()
{
    $this->middleware('auth');
}


    public function index()
    {

    }


    public function create()
    {

    }


    public function store()
    {

    }


    public function show(Lesson $lesson)
    {
        $lessons=Lesson::latest()->get();

        return view('administrator.group',compact('lessons'));
    }


    public function edit(Lesson $lesson)
    {
        //
    }


    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    public function destroy(Lesson $lesson)
    {
        //
    }
}
