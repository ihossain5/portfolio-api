<?php

namespace App\Actions;

use App\Mail\MessageMail;
use Illuminate\Support\Facades\Mail;

class SendMail {

    public function handle($data)
    {
        Mail::to(env('DEFAULT_MAIL'))->send(new MessageMail($data));
    }
}