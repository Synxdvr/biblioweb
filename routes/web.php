<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\admin\AdminPanel;

// Define a named route for the register view
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Define a named route for the login view
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Update the default route to point to the register view
Route::get('/', function () {
    return redirect()->route('register');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/librarian/dashboard', function () {
    return view('librarian.dashboard');
})->name('librarian.dashboard');

Route::get('/members', [AdminPanel::class, 'membersTable'])->name('admin.membersTable');