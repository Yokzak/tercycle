<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\JenisBotol;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TercycleSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin TERCYCLE',
            'email' => 'admin@tercycle.test',
            'password' => Hash::make('password'),
            'kode_murid' => 'ADM001',
            'kelas' => null,
            'poin' => 0,
            'role' => 'admin',
        ]);

        // Siswa 1
        User::create([
            'name' => 'Andi',
            'email' => 'andi@tercycle.test',
            'password' => Hash::make('password'),
            'kode_murid' => 'STD001',
            'kelas' => 'XI RPL',
            'poin' => 0,
            'role' => 'murid',
        ]);

        // Siswa 2
        User::create([
            'name' => 'Ega',
            'email' => 'ega@tercycle.test',
            'password' => Hash::make('password'),
            'kode_murid' => 'STD002',
            'kelas' => 'XI RPL',
            'poin' => 0,
            'role' => 'murid',
        ]);

        // Jenis botol
        JenisBotol::create([
            'nama' => 'Botol Plastik Kecil',
            'poin' => 5,
            'keterangan' => 'Botol plastik dengan ukuran kurang dari 600ml',
        ]);

        JenisBotol::create([
            'nama' => 'Botol Plastik Sedang',
            'poin' => 10,
            'keterangan' => 'Botol plastik ukuran 600ml sampai 1.5L',
        ]);

        JenisBotol::create([
            'nama' => 'Botol Plastik Besar',
            'poin' => 15,
            'keterangan' => 'Botol plastik dengan ukuran lebih dari 1.5L',
        ]);
    }
}