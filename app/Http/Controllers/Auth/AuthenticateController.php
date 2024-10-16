<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthenticateController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Login');
    }

    public function store(Request $request)
    {
        // todo : add authentication

        $cardinals = $request->validate([
            "email" => 'required|email',
            "password" => 'required',
        ]);

        if (Auth::attempt($cardinals, $request->boolean('remember'))) {
            $request->session()->regenerate();
            //TODO: redirect user to the dashboard, now it redirects to the home page by default
            return redirect()->intended();
        }

        return back()->withErrors([
            "email" => "The provided credentials do not match our records.",
        ])->onlyInput('email');
    }
}
