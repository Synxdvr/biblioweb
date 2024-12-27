<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Show the profile edit form
    public function edit()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    // Update the profile
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update the user's name
        $user->name = $request->input('name');

        // Update the user's password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Save the changes
        $user->save();

        // Redirect back with a success message
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}