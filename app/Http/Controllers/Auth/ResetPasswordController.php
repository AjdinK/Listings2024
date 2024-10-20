<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Inertia\Inertia;

class ResetPasswordController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            "email" => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT ?
            back()->with(['status', __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetForm()
    {
        return Inertia::render('Auth/ResetPassword', [
            'token' => request()->route('token'),
            'email' => request()->email,
        ]);
    }
}
