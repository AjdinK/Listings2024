<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'lowercase', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::create($credentials);
        // todo : send verification email

        Auth::login($user);

        // todo : redirect user to the dashboard
        return redirect()->route('home');
    }

    public function create()
    {
        return Inertia::render('Auth/Register');
    }
}
