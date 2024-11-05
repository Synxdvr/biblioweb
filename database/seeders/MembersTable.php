<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MembersTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('members')->insert([
            [
                'member_name' => 'John Doe',
                'contact_information' => 'john.doe@example.com',
                'address' => 'Manila',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'member_name' => 'Jane Smith',
                'contact_information' => 'jane.smith@example.com',
                'address' => 'Quezon City',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more seed data as needed
        ]);
    }
}