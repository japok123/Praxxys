<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'email' => 'john.doe@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
            ],
            [
                'firstname' => 'Jane',
                'lastname' => 'Smith',
                'email' => 'jane.smith@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
            ],
            [
                'firstname' => 'Alice',
                'lastname' => 'Johnson',
                'email' => 'alice.johnson@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
            ],
            [
                'firstname' => 'Bob',
                'lastname' => 'Brown',
                'email' => 'bob.brown@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
            ],
            [
                'firstname' => 'Charlie',
                'lastname' => 'Davis',
                'email' => 'charlie.davis@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
            ],
            [
                'firstname' => 'David',
                'lastname' => 'Martinez',
                'email' => 'david.martinez@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
            ],
            [
                'firstname' => 'Eve',
                'lastname' => 'Miller',
                'email' => 'eve.miller@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
            ],
            [
                'firstname' => 'Frank',
                'lastname' => 'Wilson',
                'email' => 'frank.wilson@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
            ],
            [
                'firstname' => 'Grace',
                'lastname' => 'Moore',
                'email' => 'grace.moore@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
            ],
            [
                'firstname' => 'Hank',
                'lastname' => 'Taylor',
                'email' => 'hank.taylor@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
            ]
        ];

        // Insert users into the database
        DB::table('users')->insert($users);
    }
}
