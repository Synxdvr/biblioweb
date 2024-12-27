<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BorrowingRecord;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class BorrowingRecordController extends Controller
{
    public function index()
    {
        // Display list of all borrowing records
        $borrowingRecords = BorrowingRecord::all();
        return view('user.borrowing_records.index', compact('borrowingRecords'));
    }

    public function create()
    {
        // Display form to borrow a book
        $books = Book::where('availability_status', 'available')->get();
        return view('user.borrowing_records.create', compact('books'));
    }

    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'borrow_date' => 'required|date',
            'status' => 'required|in:borrowed,returned',
        ]);

        // Create a new borrowing record
        BorrowingRecord::create([
            'book_id' => $request->book_id,
            'member_id' => $request->member_id,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
            'status' => $request->status,
        ]);

        return redirect()->route('user.borrowing_records.index')->with('success', 'Book borrowed successfully.');
    }

    public function show($id)
    {
        // Show a specific borrowing record
        $borrowingRecord = BorrowingRecord::findOrFail($id);
        return view('user.borrowing_records.show', compact('borrowingRecord'));
    }
}
