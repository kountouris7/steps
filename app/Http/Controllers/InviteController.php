<?php

namespace App\Http\Controllers;

use App\Invite;
use App\Mail\InviteCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class InviteController extends Controller
{

    public function invite()
    {
        //$invite = Invite::first();
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


    public function accept(Request $request, $token)
    {


        // here we'll look up the user by the token sent provided in the URL
        // Look up the invite

        if ( ! $invite = Invite::where('token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }


        // User::create(
        //     [
        //         'email'    => $invite->email,
        //         //'name'     => request('name'),
        //         //'password' => request('password'),
        //         'type'     => User::DEFAULT_TYPE,
        //     ]);


        //$invite->delete();
        // delete the invite so it can't be used again


        // here you would probably log the user in and show them the dashboard, but we'll just prove it worked

        return redirect(route('register.form'));
    }

    public function inviteDelete()
    {
        $invite = Invite::where('token', $token)->first();
        $invite->delete();
    }

}
