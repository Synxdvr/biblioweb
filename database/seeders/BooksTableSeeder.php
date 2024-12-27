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
        $books = [
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
                'publication_date' => '2000-01-01',  // Placeholder date
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
            ],
            [
                'title' => 'The Lord of the Rings',
                'author' => 'J.R.R. Tolkien',
                'ISBN' => '9780261102385',
                'genre' => 'Fantasy',
                'publication_date' => '1954-07-29',
                'availability_status' => 'available',
            ],
            [
                'title' => 'Harry Potter and the Sorcerer\'s Stone',
                'author' => 'J.K. Rowling',
                'ISBN' => '9780439708180',
                'genre' => 'Fantasy',
                'publication_date' => '1997-06-26',
                'availability_status' => 'available',
            ],
            [
                'title' => 'The Chronicles of Narnia',
                'author' => 'C.S. Lewis',
                'ISBN' => '9780066238500',
                'genre' => 'Fantasy',
                'publication_date' => '1950-10-16',
                'availability_status' => 'borrowed',
            ],
            [
                'title' => 'The Hunger Games',
                'author' => 'Suzanne Collins',
                'ISBN' => '9780439023481',
                'genre' => 'Dystopian',
                'publication_date' => '2008-09-14',
                'availability_status' => 'available',
            ],
            [
                'title' => 'The Fault in Our Stars',
                'author' => 'John Green',
                'ISBN' => '9780525478812',
                'genre' => 'Romance',
                'publication_date' => '2012-01-10',
                'availability_status' => 'borrowed',
            ],
            [
                'title' => 'The Book Thief',
                'author' => 'Markus Zusak',
                'ISBN' => '9780375842207',
                'genre' => 'Historical Fiction',
                'publication_date' => '2005-03-14',
                'availability_status' => 'available',
            ],
            [
                'title' => 'The Maze Runner',
                'author' => 'James Dashner',
                'ISBN' => '9780385737951',
                'genre' => 'Science Fiction',
                'publication_date' => '2009-10-06',
                'availability_status' => 'borrowed',
            ],
            [
                'title' => 'Divergent',
                'author' => 'Veronica Roth',
                'ISBN' => '9780062024039',
                'genre' => 'Dystopian',
                'publication_date' => '2011-04-25',
                'availability_status' => 'available',
            ],
            [
                'title' => 'The Giver',
                'author' => 'Lois Lowry',
                'ISBN' => '9780544336261',
                'genre' => 'Dystopian',
                'publication_date' => '1993-04-26',
                'availability_status' => 'borrowed',
            ],
            [
                'title' => 'Ender\'s Game',
                'author' => 'Orson Scott Card',
                'ISBN' => '9780812550702',
                'genre' => 'Science Fiction',
                'publication_date' => '1985-01-15',
                'availability_status' => 'available',
            ]
        ];

        DB::table('books')->insert($books);
    }
}