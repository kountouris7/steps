<?php

namespace App\Http\Controllers;

use App\Email;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function createEmail()
    {
        return view('emails.createEmail');
    }

    public function sendEmail(Request $request)
    {
        $email = Email::create([
            'email_to' => $request->get('email'),
            'subject'  => request('subject'),
            'body'     => request('body'),

        ]);

        Mail::to($request->get('email'))->send(new SendEmail($email));
        return redirect()
            ->back();
    }


    public function showEmail($id)
    {
        $emails = Email::findOrFail($id);

        return view('emails.showEmail', compact('emails'));
    }
}
