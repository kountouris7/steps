<?php

namespace App\Http\Controllers;

use App\Invite;
use App\Mail\InviteCreated;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class InviteController extends Controller
{

    public function invite()
    {
        // show the user a form with an email field to invite a new user
        return view('administrator.invite');
    }



    public function process(Request $request)
    {
        // process the form submission and send the invite by email
        // validate the incoming request data

        do {
            //generate a random string using Laravel's str_random helper
            $token = str_random();
        } //check if the token already exists and if it does, try again
        while (Invite::where('token', $token)->first());

        //create a new invite record
        $invite = Invite::create([
            'email' => $request->get('email'),
            'token' => $token,
        ]);

        // send the email
        Mail::to($request->get('email'))->send(new InviteCreated($invite));

        // redirect back where we came from
        return redirect()
            ->back();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function accept(Request $request, $token)
    {


        // here we'll look up the user by the token sent provided in the URL
        // Look up the invite
        if ( ! $invite = Invite::where('token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }

        // create the user with the details from the invite
        $user = User::create(
            [
                'email' => $invite->email,
                'name'  => request('name'),
                'password' => request('password'),
                'type' => User::DEFAULT_TYPE,
            ]);

        // delete the invite so it can't be used again
        $invite->delete();


        // here you would probably log the user in and show them the dashboard, but we'll just prove it worked

        return 'Good job! Invite accepted!';
    }
}
