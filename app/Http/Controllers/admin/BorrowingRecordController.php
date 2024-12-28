<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BorrowingRecord;
use App\Models\Book;
use Illuminate\Http\Request;

class BorrowingRecordController extends Controller
{
    public function index()
    {
        // Fetch borrowing records with books and members
        try {
            $borrowingRecords = BorrowingRecord::with(['book', 'member'])->paginate(10);
            return view('admin.borrowingRecordsTable', compact('borrowingRecords'));
        } catch (\Exception $e) {
            // Log error for debugging
            \Log::error('Error fetching borrowing records: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to fetch borrowing records.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'return_date' => 'required|date',
            'status' => 'required|string',
        ]);

        $borrowingRecord = BorrowingRecord::findOrFail($id);
        $borrowingRecord->update([
            'return_date' => $request->input('return_date'),
            'status' => $request->input('status'),
        ]);

        if ($request->input('status') == 'returned') {
            $borrowingRecord->book->update(['availability_status' => 'available']);
        }

        return redirect()->route('admin.borrowingRecordsTable')->with('success', 'Borrowing record updated successfully.');
    }
}
