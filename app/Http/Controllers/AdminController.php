<?php

namespace App\Http\Controllers;

use App\Group;
use App\Lesson;
use App\Level;
use App\Payment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function admin()
    {
        return view('administrator.layouts.app');
    }

    public function lessoncreate()
    {
        return view('administrator.lessoncreate');
    }

    public function lessonstore(Request $request, Lesson $lessons)
    {
        $this->validate($request, [
            'name' => 'required:unique',
            'body' => 'required',
            'max:30',
        ]);

        Lesson::create([
            'name' => request('name'),
            'body' => request('body'),
        ]);

        return redirect(route('show.lesson'));
    }

    public function lessonshow()
    {
        $lessons = Lesson::latest()->get();

        return view('administrator.lessonshow', compact('lessons'));
    }

    public function groupcreate($id)
    {
        $lesson = Lesson::findOrFail($id);
        $levels = Level::get();

        return view('administrator.groupcreate', compact('lesson', 'levels'));
    }

    public function groupstore(Request $request, Group $group)
    {
        $validator = Validator::make($request->all(), [
            'max_capacity' => 'required|integer|between:1,8',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $group = Group::create([
            'day_time'     => request('day_time'),
            'max_capacity' => request('max_capacity'),
            'level_id'     => request('level_id'),
            'lesson_id'    => request('lesson_id'),
        ]);

        return redirect(route('show.groups'));
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroygroup($id)
    {
        $group = Group::findOrFail($id);
        $this->authorize('before', $group);
        $group->delete();

        return back()->with('status', 'Group has been deleted');
    }


}
