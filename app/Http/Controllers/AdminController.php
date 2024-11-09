<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('listings')
            ->filter(request(['search', 'user_role']))
            ->paginate(10)
            ->WithQueryString();

        return Inertia::render('Admin/AdminDashboard', [
            'users' => $users,
            'status' => session('status'),
        ]);
    }

    public function role(Request $request, User $user)
    {
        $request->validate([
            'role' => ['string', 'required'],
        ]);
        $user->update(['role' => $request->role]);

        return redirect()
            ->route('admin.index')
            ->with('status', 'User role Change to '.$request->role.' successfully');
    }

    public function show(User $user)
    {
        $userlistings = $user->listings()
            ->filter(request(['search', 'disapproved']))
            ->latest()
            ->paginate(10)
            ->WithQueryString();

        return Inertia::render('Admin/UserPage', [
            'user' => $user,
            'listings' => $userlistings,
            'status' => session('status'),
        ]);
    }

    public function approve(Listing $listing)
    {
        $listing->update([
            'approved' => ! $listing->approved,
        ]);

        $msg = $listing->approved ? 'approved' : 'disapproved';

        return back()->with('status', "Listing {$msg} successfully");
    }
}
