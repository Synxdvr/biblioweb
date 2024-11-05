<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if ($credentials['username'] === 'admin' && $credentials['password'] === 'admin123') {
            // Redirect to admin dashboard
            return redirect()->route('admin.dashboard');
        }

        if ($credentials['username'] === 'librarian' && $credentials['password'] === 'password123') {
            // Redirect to librarian dashboard
            return redirect()->route('librarian.dashboard');
        }

        if (Auth::attempt($credentials)) {
            // Authentication passed, redirect to intended route
            return redirect()->intended('home');
        }

        // Authentication failed, redirect back with input
        return redirect()->back()->withInput()->withErrors(['username' => 'Invalid credentials']);
    }
}

?>