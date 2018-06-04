<?php

namespace App\Http\Controllers;

use App\Invite;
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

    protected function create(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'token'    => 'required|string|exists:invites,token',
        ]);

        User::create([
            'name'     => request('name'),
            'email'    => request('email'),
            'password' => Hash::make(request('password')),
            'type'     => User::DEFAULT_TYPE,
        ]);

        Invite::where('token', '=', request('token'))->delete(); //deletes invitation(with token) after registration

        return redirect(route('home'));
    }
}
