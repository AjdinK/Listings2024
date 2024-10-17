<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class EmailVerificationController extends Controller
{
    public function notice()
    {
        return Inertia::Render('Auth/VerifyEmail');
    }
}
