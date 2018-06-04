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
        return view('administrator.invite');
    }

    public function process(Request $request)  // process the form submission and send the invite by email
    {
        //maybe refactor? // validate the incoming request data
        do {
            $token = str_random();
        } while (Invite::where('token', $token)->first()); //check if the token already exists and if it does, try again

        $invite = Invite::create([
            'email' => $request->get('email'),
            'token' => $token,
        ]);
        Mail::to($request->get('email'))->send(new InviteCreated($invite)); // send the email

        return redirect()
            ->back();
    }

    public function accept(Request $request, $token)  // look up the user by the token sent provided in the URL
    {
        // Look up the invite
        if ( ! $invite = Invite::where('token', $token)->first()) {
            //if the invite doesn't exist do something more graceful than this
            abort(404);
        }
        return redirect(route('register.form'));
    }
}
