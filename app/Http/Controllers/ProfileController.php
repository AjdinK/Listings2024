<?php

namespace App\Http\Controllers;

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
