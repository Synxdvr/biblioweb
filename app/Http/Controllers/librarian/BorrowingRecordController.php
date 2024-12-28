<?php

namespace App\Http\Controllers\Librarian;

use App\Http\Controllers\Controller;
use App\Models\BorrowingRecord;
use Illuminate\Http\Request;

class BorrowingRecordController extends Controller {
    public function index() {
        $borrowingRecords = BorrowingRecord::with(['book', 'member'])->paginate(10);
        return view('librarian.borrowingRecordsTable', compact('borrowingRecords'));
    }

    public function update(Request $request, $id) {
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

        return redirect()->route('librarian.borrowingRecordsTable')->with('success', 'Borrowing record updated successfully.');
    }
}
