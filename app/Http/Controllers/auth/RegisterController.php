<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Members;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'member_username' => 'required|string|max:25|unique:members',
            'member_fullname' => 'required|string|max:50',
            'contact_information' => 'required|string|email|max:50|unique:members',
            'address' => 'required|string|max:100',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $member = new Members();
        $member->member_username = $request->member_username;
        $member->member_fullname = $request->member_fullname;
        $member->contact_information = $request->contact_information;
        $member->address = $request->address;
        $member->password = Hash::make($request->password);
        $member->save();

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }
}