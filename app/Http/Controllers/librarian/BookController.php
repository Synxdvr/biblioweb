<?php

namespace App\Http\Controllers\Librarian;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller {
    public function index() {
        return view('librarian.booksTable', [
            'books' => Book::paginate(10)
        ]);
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
