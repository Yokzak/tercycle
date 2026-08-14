<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $budi = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => bcrypt('password'),
            'no_telepon' => '08123456789',
            'jurusan_id' => 'RPL',
        ]);

        Siswa::create([
            'user_id' => $budi->id,
            'nama_lengkap' => 'Budi Santoso',
            'nis' => '12345',
            'no_telepon' => '08123456789',
            'kode_siswa' => 'SW-001',
            'kelas' => 'XI',
            'jurusan_id' => 'RPL',
            'saldo_poin' => 0,
        ]);

        $andi = User::create([
            'name' => 'Andi Pratama',
            'email' => 'andi@gmail.com',
            'password' => bcrypt('password'),
            'no_telepon' => '081234567890',
            'jurusan_id' => 'TKR',
        ]);

        Siswa::create([
            'user_id' => $andi->id,
            'nama_lengkap' => 'Andi Pratama',
            'nis' => '12346',
            'no_telepon' => '081234567890',
            'kode_siswa' => 'SW-002',
            'kelas' => 'XI',
            'jurusan_id' => 'TKR',
            'saldo_poin' => 0,
        ]);
    }
}