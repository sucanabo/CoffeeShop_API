<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail()
    {
        $user = User::find(1);
        $mailable = new VerifyEmail($user);
        Mail::to("sucanabo@gmail.com")->send(new VerifyEmail($user));

        return true;
    }
}
