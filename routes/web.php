<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminPanel;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\BookController;
use App\Http\Controllers\User\ProfileController;



// Register Routes
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Login Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Admin and Librarian Dashboard Routes
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/librarian/dashboard', function () {
    return view('librarian.dashboard');
})->name('librarian.dashboard');

// Route for the homepage (User dashboard)
Route::get('/homepage', [HomeController::class, 'index'])->name('user.homepage')->middleware('auth');



//User View Books Routes

Route::middleware(['auth'])->group(function () {
    Route::get('/view-books', [BookController::class, 'index'])->name('view.books');
    Route::get('/borrow-book/{id}', [BookController::class, 'borrowBook'])->name('borrow.book');
    Route::get('/borrowed-books', [BookController::class, 'viewBorrowedBooks'])->name('view.borrowed.books');
    Route::get('/unborrow-book/{id}', [BookController::class, 'unborrowBook'])->name('unborrow.book');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Logout Route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
