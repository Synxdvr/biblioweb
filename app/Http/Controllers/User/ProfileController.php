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
            'member_username' => 'required|string|max:255',
            'member_fullname' => 'required|string|max:255',
            'contact_information' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'old_password' => 'nullable|string|min:8',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update the user's details
        $user->member_username = $request->input('member_username');
        $user->member_fullname = $request->input('member_fullname');
        $user->contact_information = $request->input('contact_information');
        $user->address = $request->input('address');

        // Validate and update the user's password if provided
        if ($request->filled('old_password') && Hash::check($request->input('old_password'), $user->password)) {
            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }
        } elseif ($request->filled('old_password')) {
            return redirect()->route('profile.edit')->with('error', 'Old password is incorrect.');
        }

        // Save the changes
        $user->save();

        // Redirect back with a success message
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}