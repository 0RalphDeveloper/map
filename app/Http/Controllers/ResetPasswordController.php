<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use App\Mail\SendCustomResetLink;
use App\Models\Login;

class ResetPasswordController extends Controller
{
    // Show the form to request a password reset
    public function showRequestForm()
    {
        return view('request_password_reset');
    }

    // Send the reset link to the email
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = Login::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with that email.']);
        }

        // Use the 'logins' password broker
        $token = Password::broker('logins')->createToken($user);

        $link = url('/custom-password-reset') . '?token=' . $token . '&email=' . urlencode($user->email);

        Mail::to($user->email)->send(new SendCustomResetLink($link, $user));

        return back()->with('status', 'Reset link sent to your email.');
    }

    // Show the form for resetting the password
    public function showResetForm(Request $request)
    {
        return view('custom_password_reset', [
            'token' => $request->token,
            'email' => $request->email,
        ]);
    }

    // Perform the password reset
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', 'min:8', 'max:16'],
        ]);
        

        // Use the custom broker for 'logins'
        $status = Password::broker('logins')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                \Log::info("Callback triggered for password reset: " . $user->email);
        
                $user->password = Hash::make($request->password);
                $user->save();
            }
        );

        

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('loginview')->with('status', 'Password has been reset!')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
