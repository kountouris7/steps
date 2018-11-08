<?php

namespace App\Http\Controllers;

use App\Invite;
use App\Subscriber;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('register');
    }

    protected function checkEmail()
    {

    }

    protected function create(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'token'    => 'required|string|exists:invites,token',
        ]);

        if ( ! $invitation = Invite::where('email', $request->email)->first()) {
            return back()->with('flash', 'Please use the email you received the invitation to sign in');
        }
        // $subscription = Subscriber::where('email', $request->email)->first();

        $user = User::create([
            'name'     => request('name'),
            'email'    => request('email'),
            // 'subscription_id' => $subscription->id,
            'password' => Hash::make(request('password')),
            'type'     => User::DEFAULT_TYPE,
        ]);

//deletes invitation(with token) after registration
        Invite::where('token', '=', request('token'))->delete();


//Registers users in subscribers table also...later will be exported to xls

//you should change this to update or Create
        $sub = Subscriber::updateOrCreate(
            [
                'email' => request('email'),
            ],
            [
                'name' => request('name'),
                'month' => today(),
            ]);

        return redirect(route('login'));
    }
}
