<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BorrowingRecord;
use App\Models\Book;
use App\Models\Members;

class BorrowingRecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();
        $members = Members::all();

        foreach ($books as $book) {
            BorrowingRecord::create([
                'book_id' => $book->id,
                'member_id' => $members->random()->member_id,
                'borrow_date' => now()->subDays(rand(1, 30)),
                'return_date' => now()->addDays(rand(1, 30)),
                'status' => 'borrowed',
            ]);
        }
    }
}
