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
        $this->inviteUser($request->get('email'));

        return redirect(route('showSubscribersCurrentMonth'));
    }

    private function inviteUser($email)
    {
        $token  = $this->tokenCreate();
        $invite = Invite::create([
            'email' => $email,
            'token' => $token,
        ]);
        Mail::to($email)->send(new InviteCreated($invite));
        return $invite;
    }

    /**
     * @return string
     */
    protected function tokenCreate(): string
    {
        do {
            $token = str_random();
        } while (Invite::where('token', $token)->exists());

        return $token;
    }

    public function accept(Request $request, $token)
    {
        if ( ! $invite = Invite::where('token', $token)->first()) {
            //abort(404);
            return view('redirectToLoginError');
            //return response('Please signIn: https://stepsfitness.herokuapp.com', 404);
        }
        return redirect(route('register.form'));
    }

    public function sendMultiple(Request $request)
    {
        $subscribers = Subscriber::get()
                                 ->each(function ($subscriber) {
                                     $this->inviteUser($subscriber->email);
                                 });

//        foreach ($subscribers as $subscriber) {
//            $invite = $this->inviteUser($subscriber->email);
////            $subscriber->token = $invite->token;
////            $subscriber->save();
//        }

        return redirect()
            ->back();
    }
}
