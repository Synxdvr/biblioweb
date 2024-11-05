<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Members;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if ($credentials['username'] === 'admin' && $credentials['password'] === 'admin123') {
            // Redirect to admin dashboard
            return redirect()->route('admin.dashboard');
        }

        if ($credentials['username'] === 'librarian' && $credentials['password'] === 'password123') {
            // Redirect to librarian dashboard
            return redirect()->route('librarian.dashboard');
        }

        // Check if the user is in the members table
        $member = Members::where('member_username', $credentials['username'])->first();
        if ($member && Hash::check($credentials['password'], $member->password)) {
            // Log the user in manually
            Auth::login($member);
            // Authentication passed, redirect to home
            return redirect()->intended('home');
        }

        // Authentication failed, redirect back with input
        return redirect()->back()->withInput()->withErrors(['username' => 'Invalid credentials']);
    }
}