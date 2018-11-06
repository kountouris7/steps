<?php

namespace App\Http\Controllers;

use App\Article;
use App\Events\GroupUpdated;
use App\Group;
use App\Invite;
use App\Lesson;
use App\Level;
use App\Subscriber;
use App\User;
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

        return redirect(route('show.lesson'))
            ->with('flash', 'Group has been published');
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
        $group = Group::with('level')
                      ->findOrFail($id);

        $levels = Level::get();

        $groupLevel = $group->level->level;

        return view('administrator.editgroup', compact('group', 'levels', 'groupLevel'));
    }

    public function updategroup(Request $request, $id)
    {
        $group = Group::with('lesson')->findOrFail($id);

        $this->validate($request, [
            'level_id' => 'required',
        ]);

        $group->update([
            'day_time'     => request('day_time'),
            'max_capacity' => request('max_capacity'),
            'level_id'     => request('level_id'),
        ]);

        $data = $group->lesson->name . 'has been updated';

        GroupUpdated::dispatch($data);

        return redirect(route('administrator.showgroups'))->with('flash', $data);
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

        if (request()->expectsJson()) {
            return response()->json(['status' => 'Data is deleted']);
        }

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
        $attendances = Group::with('clients', 'lesson')
                            ->where('day_time', '>=', today()->nowWithSameTz())
                            ->orderBy('day_time')
                            ->get()->transform(function ($group) {
                return collect(array_merge($group->toArray(), [
                    'clients' => $group->clients,
                    'lesson'  => $group->lesson,
                ]));
            });

        return view('administrator.seeAttendances', compact('attendances'));
    }

    public function attendanceByDay($day)
    {
        $dates = [];
        $today = Carbon::today();

        for ($i = 0; $i < 7; $i++) {
            $groupDateTime                    = $today->copy()->addDay($i);
            $dates[$groupDateTime->dayOfWeek] = $groupDateTime;
        }

        ksort($dates);

        $dayToSearch = $dates[$day] ?? null;

        $attendances = [];

        if ($dayToSearch) {
            $attendances = Group::with('lesson', 'clients')
                                ->whereBetween('day_time', [
                                    $dayToSearch->startOfDay()->toDateTimeString(),
                                    $dayToSearch->endOfDay()->toDateTimeString(),
                                ])
                                ->orderBy('day_time')
                                ->get()
                                ->transform(function ($group) {
                                    return collect(array_merge($group->toArray(), [
                                        'lesson'  => $group->lesson,
                                        'clients' => $group->clients,
                                    ]));
                                });
        }

        return view('administrator.seeAttendances', compact('attendances'));
        // $thisWeeksEnd = $this->thisWeeksEnd();
        // $attendances  = Group::with('clients', 'lesson')
        //                      ->whereRaw("WEEKDAY(groups.day_time) =" . $day)
        //                      ->where('day_time', '<=', $thisWeeksEnd)
        //                      ->get();


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

    public function checkPendingInvitations()
    {
        $invites = Invite::get();

        return view('administrator.checkInvites', compact('invites'));
    }

    public function deleteInvites($id)
    {
        $invite = Invite::findOrFail($id);
        $invite->delete();

        return back()->with('flash', 'Invitation has been deleted');
    }

    public function articlesWrite()
    {
        return view('administrator.writeArticles');
    }

    public function articlesPost(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|max:60',
            'body'        => 'required',
            'description' => 'required|max:171',
        ]);

        Article::create([
            'title'       => request('title'),
            'body'        => request('body'),
            'description' => request('description'),
        ]);

        return redirect(route('articles.show'));
    }

    public function articlesShow()
    {
        $articles = Article::get();

        return view('articlesShow', compact('articles'));
    }

    public function articlesRead()
    {
        $articles = Article::get();

        return view('articlesRead', compact('articles'));

    }

    public function viewUsers()
    {
        $users = User::with('subscription')->get();

        return view('administrator.viewUsers', compact('users'));
    }

    public function subscriberEdit($id)
    {
        $subscriber = Subscriber::findOrFail($id);

        return view('administrator.subscribersEdit', compact('subscriber'));
    }

    public function subscriberUpdate($id)
    {
        Subscriber::updateOrCreate(
            [
                'id' => $id,
            ],
            [
                'name'         => request('name'),
                'surname'      => request('surname'),
                'email'        => request('email'),
                'package_week' => request('package_week'),
                'amount'       => request('amount'),
                'discount'     => request('discount'),
                'price'        => request('price'),
            ]);

        return back()->with('flash', 'Subscriber has been updated');

    }


    public function deleteUser($id)
    {
        User::where('id', $id)->delete();

        return back()->with('flash', 'User Withdrawn');
    }

    public function withdrawnUsers()
    {
        $withdrawnUsers = User::onlyTrashed()->get();

        return view('administrator.withdrawnUsers', compact('withdrawnUsers'));
    }

    public function restoreUser($id)
    {
        User::where('id', $id)->restore();

        return back()->with('flash', 'User Restored');
    }

    public function forceDeleteUser($id)
    {
        User::where('id', $id)->forceDelete();

        return back()->with('flash', 'User Deleted');
    }


}
