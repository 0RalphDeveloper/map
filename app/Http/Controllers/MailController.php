<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\MyMail;

class MailController extends Controller
{
    public function sendEmail()
    {
        $details = [
            'name' => 'Plant Manager',
            'message' => 'This is a test email sent from Plant Scheduler.'
        ];

        Mail::to('javenquerubin3@gmail.com')->send(new MyMail($details));

        return "Email Sent Successfully!";
    }
}
