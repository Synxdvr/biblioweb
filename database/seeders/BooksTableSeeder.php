<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'ISBN' => '9780743273565',
                'genre' => 'Fiction',
                'publication_date' => '1925-04-10',
                'availability_status' => 'available',
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'ISBN' => '9780451524935',
                'genre' => 'Dystopian',
                'publication_date' => '1949-06-08',
                'availability_status' => 'borrowed',
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'ISBN' => '9780061120084',
                'genre' => 'Fiction',
                'publication_date' => '1960-07-11',
                'availability_status' => 'available',
            ],
            [
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'ISBN' => '9780316769488',
                'genre' => 'Fiction',
                'publication_date' => '1951-07-16',
                'availability_status' => 'borrowed',
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'ISBN' => '9780141439518',
                'genre' => 'Romance',
                'publication_date' => '1813-01-28',
                'availability_status' => 'available',
            ],
            [
                'title' => 'Moby-Dick',
                'author' => 'Herman Melville',
                'ISBN' => '9781503280786',
                'genre' => 'Adventure',
                'publication_date' => '1851-10-18',
                'availability_status' => 'available',
            ],
            [
                'title' => 'War and Peace',
                'author' => 'Leo Tolstoy',
                'ISBN' => '9781400079988',
                'genre' => 'Historical Fiction',
                'publication_date' => '1869-01-01',
                'availability_status' => 'borrowed',
            ],
            [
                'title' => 'The Odyssey',
                'author' => 'Homer',
                'ISBN' => '9780140268867',
                'genre' => 'Epic',
                'publication_date' => '-0800-01-01',  // Changed to valid date format
                'availability_status' => 'available',
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'ISBN' => '9780261102217',
                'genre' => 'Fantasy',
                'publication_date' => '1937-09-21',
                'availability_status' => 'available',
            ],
            [
                'title' => 'Brave New World',
                'author' => 'Aldous Huxley',
                'ISBN' => '9780060850524',
                'genre' => 'Dystopian',
                'publication_date' => '1932-08-31',
                'availability_status' => 'borrowed',
            ]
        ]);
    }
}
