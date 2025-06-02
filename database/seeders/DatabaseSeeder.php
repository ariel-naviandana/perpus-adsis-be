<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            [
                'name' => 'Admin Sistem',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Petugas 1',
                'email' => 'petugas1@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Petugas 2',
                'email' => 'petugas2@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'User Biasa 1',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Biasa 2',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Biasa 3',
                'email' => 'user3@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
