<?php

namespace App\Http\Controllers;

use App\Invite;
use App\Mail\InviteCreated;
use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class InviteController extends Controller
{
   // public function invite()
   // {
   //     return view('administrator.invite');
   // }

    public function process(Request $request)  // process the form submission and send the invite by email
    {
        $token  = $this->tokenCreate();
        $invite = Invite::create([
            'email' => $request->get('email'),
            'token' => $token,
        ]);
        Mail::to($request->get('email'))->send(new InviteCreated($invite));

        return redirect()
            ->back();
    }

    /**
     * @return string
     */
    protected function tokenCreate(): string
    {
        do {
            $token = str_random();
        } while (Invite::where('token', $token)->first());

        return $token;
    }

    public function accept(Request $request, $token)
    {
        if ( ! $invite = Invite::where('token', $token)->first()) {
            abort(404);
        }

        return redirect(route('register.form'));
    }

    public function sendMultiple(Request $request)
    {
        $invitations = Subscriber::get();

        foreach ($invitations as $invitation) {

            $token = $this->tokenCreate();

            $invite = Invite::create([
                'email' => $invitation->email,
                'token' => $token,
            ]);

            Mail::to($invitation->email)->send(new InviteCreated($invite));
        }

        return redirect()
            ->back();
    }
}
