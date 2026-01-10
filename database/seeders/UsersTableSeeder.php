<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'user', 'manager'];
        $statuses = ['active', 'inactive'];

        for ($i = 1; $i <= 1000; $i++) {
            DB::table('users')->insert([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('password123'),
                'role' => $roles[array_rand($roles)],
                'status' => $statuses[array_rand($statuses)],
                'created_at' => now()->subDays(rand(1, 365)),
                'updated_at' => now(),
            ]);
        }
    }
}
