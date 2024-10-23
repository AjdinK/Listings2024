<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return Inertia::render("Profile/Edit", [
            "user" => $request->user(),
            'status' => session('status'),
        ]);
    }

    public function updatePassword(Request $request)
    {
        $fields = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'max:3'],
        ]);

        $request->user()->update([
            'password' => Hash::make($fields['password']),
        ]);

        return redirect()->route('profile.edit');
    }

    public function update(Request $request)
    {
        $updated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email'), 'lowercase', 'max:255'],
        ]);

        $request->user()->fill($updated);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        return redirect()->route('profile.edit');
    }
}
