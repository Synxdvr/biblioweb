<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('book_categories')->insert([
            [
                'category_name' => 'Fiction',
                'description' => 'Fictional books',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Non-Fiction',
                'description' => 'Non-Fictional books',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Science Fiction',
                'description' => 'Sci-Fi books',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Fantasy',
                'description' => 'Fantasy books',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
