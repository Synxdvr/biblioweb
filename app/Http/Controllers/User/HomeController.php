<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Return the view and pass the user object to it
        return view('user.homepage', compact('user'));
    }
}
