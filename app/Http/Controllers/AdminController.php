<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
{
        $user = User::with('listings')->paginate(10)
        return Inertia::render('Admin/AdminDashboard',[
        'user' => $user,
        ]);
    }
}