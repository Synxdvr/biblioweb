<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book; // Add this line to import the Book model
use Illuminate\Http\Request; // Add this line to import the Request class

class BookController extends Controller {
    // ...existing code...

    public function index(Request $request) {
        $query = Book::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('author', 'LIKE', "%{$search}%")
                  ->orWhere('ISBN', 'LIKE', "%{$search}%")
                  ->orWhere('genre', 'LIKE', "%{$search}%");
        }

        $books = $query->paginate(10);
        return view('admin.booksTable', compact('books'));
    }

    public function store(Request $request) {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'ISBN' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'publication_date' => 'required|date',
            'availability_status' => 'required|in:available,borrowed',
        ]);

        // Create a new book record
        Book::create($validatedData);

        // Redirect back with a success message
        return redirect()->route('admin.booksTable')->with('success', 'Book created successfully.');
    }

    public function update(Request $request, $id) {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'ISBN' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'publication_date' => 'required|date',
            'availability_status' => 'required|in:available,borrowed',
        ]);

        // Find the book by ID and update it
        $book = Book::findOrFail($id);
        $book->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('admin.booksTable')->with('success', 'Book updated successfully.');
    }

    public function destroy($id) {
        // Find the book by ID and delete it
        $book = Book::findOrFail($id);
        $book->delete();

        // Redirect back with a success message
        return redirect()->route('admin.booksTable')->with('success', 'Book deleted successfully.');
    }
}
