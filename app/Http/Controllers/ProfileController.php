<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ProfileController extends Controller
{
    public function edit()
    {
        return Inertia::render("Profile/Edit");
    }
}
