<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Budi',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);

        User::create([
            'name' => 'Andi',
            'email' => 'andi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);
    }
}