<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // Show list of available books and handle search
    public function index(Request $request)
    {
        // Define the search variable
        $search = $request->input('search', '');

        // If there's a search term, filter the books based on title, author, or genre
        $query = Book::query();

        if (!empty($search)) {
            $query->where(function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('author', 'like', "%{$search}%")
                      ->orWhere('genre', 'like', "%{$search}%");
            });
        }

        // Get the books from the database with pagination
        $books = $query->paginate(10);
        
        // Get the authenticated user
        $user = Auth::user();
        
        // Pass books data and search term to the view
        return view('user.view_books', compact('books', 'search', 'user'));
    }

    // Borrow a book (update status to 'borrowed')
    public function borrowBook($id)
    {
        $book = Book::findOrFail($id);

        // If already borrowed, show error
        if ($book->availability_status === 'borrowed') {
            return redirect()->back()->with('error', 'This book is already borrowed.');
        }

        // Mark as borrowed
        $book->update(['availability_status' => 'borrowed']);

        // Success message and redirect to borrowed books
        return redirect()->route('view.borrowed.books')->with('success', 'Book borrowed successfully.');
    }

    // View borrowed books
    public function viewBorrowedBooks()
    {
        // Get the borrowed books
        $books = Book::where('availability_status', 'borrowed')->paginate(10);
        
        // Get the authenticated user
        $user = Auth::user();
        
        // Pass books data to the view
        return view('user.borrowed_books', compact('books', 'user'));
    }

    // Unborrow a book (update status to 'available')
    public function unborrowBook($id)
    {
        $book = Book::findOrFail($id);

        // If already available, show error
        if ($book->availability_status === 'available') {
            return redirect()->back()->with('error', 'This book is already available.');
        }

        // Mark as available
        $book->update(['availability_status' => 'available']);

        // Success message and redirect to view books
        return redirect()->route('view.books')->with('success', 'Book returned successfully.');
    }
}