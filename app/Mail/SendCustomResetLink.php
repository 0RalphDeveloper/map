<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCustomResetLink extends Mailable
{
    use Queueable, SerializesModels;

    public $link;
    public $user;

    public function __construct($link, $user)
    {
        $this->link = $link;
        $this->user = $user;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->subject('Your Password Reset Link')
                    ->view('custom_reset_email'); // Blade view for the reset link email
    }
}

