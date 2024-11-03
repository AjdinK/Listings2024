<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userListing = $request->user()->listings();
        return Inertia::render('Dashboard', [
            'listings' => $userListing
        ]);
    }
}
