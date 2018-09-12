<?php

namespace App\Http\Controllers;

use App\Events\GroupUpdated;
use App\Group;
use App\Lesson;
use App\Level;
use Carbon\Carbon;
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

    public function groupcreate($id) //view
    {
        $lesson = Lesson::findOrFail($id);
        $levels = Level::get();

        foreach ($levels as $level) {

            if ($level->count() < 1) {

                return 'Please create Levels in your database'; //have to fix this and put in middleware??
            }
        }

        return view('administrator.groupcreate', compact('lesson', 'levels'));


    }

    public function groupstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'max_capacity' => 'required|integer|between:1,8',
            'level_id'     => 'required|exists:levels,id',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $group = Group::create([
            'lesson_id'    => request('lesson_id'),
            'day_time'     => request('day_time'),
            'max_capacity' => request('max_capacity'),
            'level_id'     => request('level_id'),

        ]);

        return redirect(route('show.lesson'));
    }

    public function showtoedit()
    {
        $groups = Group::with('level')
                       ->where('day_time', '>=', today()->nowWithSameTz()->toDateTimeString())
                       ->orderBy('day_time')
                       ->get();

        return view('administrator.showgroups', compact('groups'));
    }

    public function editgroup($id)
    {
        $group      = Group::with('level')->find($id);
        $levels     = Level::get();
        $groupLevel = $group->level->level;

        return view('administrator.editgroup', compact('group', 'levels', 'groupLevel'));
    }

    public function updategroup(Request $request, $id)
    {
        $group = Group::with('lesson')->findOrFail($id);

        $group->update([
            'day_time'     => request('day_time'),
            'max_capacity' => request('max_capacity'),
            'level_id'     => request('level_id'),
        ]);

        $data = $group->lesson->name . 'has been updated';

        GroupUpdated::dispatch($data);

        return redirect(route('administrator.showgroups'))->with('status', $data);
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

    public function levelcreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'level' => 'required|unique:levels,level',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $level = Level::create([
            'level' => request('level'),
        ]);

        return back()->with('status', 'Level has been saved');
    }

    public function seeAttendances()
    {
        $attendances = Group::with('clients', 'lesson')// Querying Relationship Existence
                            ->where('day_time', '>=', today()->nowWithSameTz())
                            ->get();

        return view('administrator.seeAttendances', compact('attendances'));
    }

    public function attendanceByDay($day)
    {
        $to          = $this->thisWeeksEnd();
        $attendances = Group::with('clients', 'lesson')
                            ->whereRaw("WEEKDAY(groups.day_time) =" . $day)
                            ->where('day_time', '<=', $to)
                            ->get();

        return view('administrator.seeAttendances', compact('attendances'));
    }

    /**
     * @return string
     */
    public function thisWeeksEnd(): string
    {
        $date = today();
        $to   = Carbon::parse($date)->copy()->endOfWeek()->toDateString();

        return $to;
    }

    public function test()
    {

    }


}
