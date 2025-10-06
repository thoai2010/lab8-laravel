<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $users = User::with('profile')->get();
        return view('profiles.index', compact('users'));
    }
}
