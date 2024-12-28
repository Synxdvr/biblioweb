<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('members')->insert([
            [
                'member_username' => 'johndoe',
                'member_fullname' => 'John Doe',
                'address' => 'Manila',
                'contact_information' => 'john.doe@example.com',
                'password' => bcrypt('password'), // Ensure to hash the password
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'member_username' => 'janesmith',
                'member_fullname' => 'Jane Smith',
                'address' => 'Quezon City',
                'contact_information' => 'jane.smith@example.com',
                'password' => bcrypt('password'), // Ensure to hash the password
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
