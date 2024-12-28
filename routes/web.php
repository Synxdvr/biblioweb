<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminPanel;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\BookCategoryController;
use App\Http\Controllers\Admin\BorrowingRecordController;
use App\Http\Controllers\Librarian\BookController as LibrarianBookController;
use App\Http\Controllers\Librarian\BookCategoryController as LibrarianBookCategoryController;
use App\Http\Controllers\Librarian\BorrowingRecordController as LibrarianBorrowingRecordController;

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

Route::get('/admin/members', [AdminPanel::class, 'membersTable'])->name('admin.membersTable');
Route::post('/admin/members', [MemberController::class, 'store'])->name('admin.members.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('membersTable', [MemberController::class, 'index'])->name('membersTable');
    Route::post('members', [MemberController::class, 'store'])->name('members.store');
    Route::put('members/{id}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('members/{id}', [MemberController::class, 'destroy'])->name('members.destroy');
    
    Route::get('booksTable', [AdminBookController::class, 'index'])->name('booksTable');
    Route::post('books', [AdminBookController::class, 'store'])->name('books.store');
    Route::put('books/{id}', [AdminBookController::class, 'update'])->name('books.update');
    Route::delete('books/{id}', [AdminBookController::class, 'destroy'])->name('books.destroy');

    Route::get('bookCategoriesTable', [BookCategoryController::class, 'index'])->name('bookCategoriesTable');
    Route::post('bookCategories', [BookCategoryController::class, 'store'])->name('bookCategories.store');
    Route::put('bookCategories/{id}', [BookCategoryController::class, 'update'])->name('bookCategories.update');
    Route::delete('bookCategories/{id}', [BookCategoryController::class, 'destroy'])->name('bookCategories.destroy');

    Route::get('/borrowing-records', [BorrowingRecordController::class, 'index'])->name('borrowingRecordsTable');
    Route::put('borrowing-records/{id}', [BorrowingRecordController::class, 'update'])->name('borrowingRecords.update');
});

Route::get('/librarian/dashboard', function () {
    return view('librarian.dashboard');
})->name('librarian.dashboard');

Route::prefix('librarian')->name('librarian.')->group(function () {
    Route::get('booksTable', [LibrarianBookController::class, 'index'])->name('booksTable');
    Route::post('books', [LibrarianBookController::class, 'store'])->name('books.store');
    Route::put('books/{id}', [LibrarianBookController::class, 'update'])->name('books.update');
    Route::delete('books/{id}', [LibrarianBookController::class, 'destroy'])->name('books.destroy');

    Route::get('bookCategoriesTable', [LibrarianBookCategoryController::class, 'index'])->name('bookCategoriesTable');
    Route::post('bookCategories', [LibrarianBookCategoryController::class, 'store'])->name('bookCategories.store');
    Route::put('bookCategories/{id}', [LibrarianBookCategoryController::class, 'update'])->name('bookCategories.update');
    Route::delete('bookCategories/{id}', [LibrarianBookCategoryController::class, 'destroy'])->name('bookCategories.destroy');

    Route::get('borrowingRecordsTable', [LibrarianBorrowingRecordController::class, 'index'])->name('borrowingRecordsTable');
    Route::put('borrowingRecords/{id}', [LibrarianBorrowingRecordController::class, 'update'])->name('borrowingRecords.update');
});

// Route for the homepage (User dashboard)
Route::get('/homepage', [HomeController::class, 'index'])->name('user.homepage')->middleware('auth');

// User View Books Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/view-books', [UserBookController::class, 'index'])->name('view.books');
    Route::get('/borrow-book/{id}', [UserBookController::class, 'borrowBook'])->name('borrow.book');
    Route::get('/borrowed-books', [UserBookController::class, 'viewBorrowedBooks'])->name('view.borrowed.books');
    Route::get('/unborrow-book/{id}', [UserBookController::class, 'unborrowBook'])->name('unborrow.book');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Logout Route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
