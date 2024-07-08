<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function requestPasswordResetLink()
    {
        return view('reset-password.request-reset-password-link');
    }

    public function requestPasswordResetLinkProcess(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Link untuk me reset password telah dikirimkan ke email anda.')
            : back()->with('error', 'Alamat email tidak valid.');
    }

    public function resetPassword($token)
    {
        return view('reset-password.reset-password-form')
            ->with(['token' => $token]);
    }

    public function submitNewPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, $password) {
                $user->forceFill([
                    'password' => $password
                ]);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password anda telah diperbarui.')
            : back()->with('error', 'Token tidak valid.');
    }
}
