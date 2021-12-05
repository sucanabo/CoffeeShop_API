<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use App\Notifications\ResetPasswordRequest;

class PasswordResetController extends Controller
{
    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'We can\'t find a user with that e-mail address.'
            ], 404);
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(60)
            ]
        );
        if ($user && $passwordReset)
            $user->notify(
                new ResetPasswordRequest($passwordReset->token)
            );
        return response()->json([
            'message' => 'We have e-mailed your password reset link!',
        ]);
    }
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        $message = '';
        if (!$passwordReset) {
            $message = 'This password reset token is invalid.';
            return view('reset_password')->with('message', $message);
        }

        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            $message = 'This password reset token is invalid.';
            return view('reset_password')->with('message', $message);
        }
        $message = 'Success';
        return view('reset_password')->with('message', $message)->with('token', $token);
    }
    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);
        $passwordReset = PasswordReset::where([
            ['token', $request->token],
        ])->first();
        if (!$passwordReset)
            return view('reset_password_success')->with('message', 'This password reset token is invalid.');

        $user = User::where('email', $passwordReset->email)->first();
        if (!$user)
            return view('reset_password_success')->with('message', 'We can\'t find a user with that e-mail address.');
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));
        return view('reset_password_success')->with('message', 'Success');
    }
}
