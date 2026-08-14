<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Jurusan;
use App\Models\Siswa;
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

        $budi = User::create([
            'name' => 'Budi',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);

        Siswa::create([
            'user_id' => $budi->id,
            'nama_lengkap' => 'Budi',
            'nis' => '20260001',
            'no_telepon' => '08123456789',
            'kode_siswa' => 'SIS-20260001',
            'kelas' => 'XII',
            'jurusan_id' => 'RPL',
            'saldo_poin' => 0,
        ]);

        $andi = User::create([
            'name' => 'Andi',
            'email' => 'andi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);

        Siswa::create([
            'user_id' => $andi->id,
            'nama_lengkap' => 'Andi',
            'nis' => '20260002',
            'no_telepon' => '081234567890',
            'kode_siswa' => 'SIS-20260002',
            'kelas' => 'XII',
            'jurusan_id' => 'TKR',
            'saldo_poin' => 0,
        ]);
    }
}