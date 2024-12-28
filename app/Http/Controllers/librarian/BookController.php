<?php

namespace App\Http\Controllers\Librarian;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller {
    public function index(Request $request) {
        $query = Book::query();
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('ISBN', 'like', "%{$search}%");
        }
        $books = $query->paginate(10);
        return view('librarian.booksTable', compact('books'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'ISBN' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'publication_date' => 'required|date',
            'availability_status' => 'required|in:available,borrowed',
        ]);

        Book::create($validatedData);

        return redirect()->route('librarian.booksTable')->with('success', 'Book created successfully.');
    }

    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'ISBN' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'publication_date' => 'required|date',
            'availability_status' => 'required|in:available,borrowed',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validatedData);

        return redirect()->route('librarian.booksTable')->with('success', 'Book updated successfully.');
    }

    public function destroy($id) {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('librarian.booksTable')->with('success', 'Book deleted successfully.');
    }
}
