<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userListing = $request->user()->role !== 'suspended' ?
        $request->user()->listings()->latest()->paginate(5) : null;
        return Inertia::render('Dashboard', [
        'listings' => $userListing,
        'status' => session('status')
        ]);
    }
}
