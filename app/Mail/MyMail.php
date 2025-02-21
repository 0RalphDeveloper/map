<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $data;

    public function __construct($subject,$data)
    {
        $this->data = $data;
        $this->subject =$subject;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->subject($this->subject)
                    ->view('my_mail') // Blade view for email content
                    ->with(['data' => $this->data]);
    }
}
