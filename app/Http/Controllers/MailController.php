<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestMail;
use Mail;

class MailController extends Controller
{
    public function sendMail()
    {
        $details = [
            'title' => 'Mail from selfside media',
            'body' => 'This is for testing mail using gmail'
        ];

        Mail::to('yash.codetrinity@gmail.com')->send(new TestMail($details));
        return "Email Sent Successfully";
    }
}
