<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jurusan::create([
            'kode_jurusan' => 'RPL',
            'nama_jurusan' => 'Rekayasa Perangkat Lunak',
        ]);
        Jurusan::create([
            'kode_jurusan' => 'DKV',
            'nama_jurusan' => 'Desain Komunikasi Visual',
        ]);
        Jurusan::create([
            'kode_jurusan' => 'TBSM',
            'nama_jurusan' => 'Teknik Bisnis Sepeda Motor',
        ]);
        Jurusan::create([
            'kode_jurusan' => 'TKR',
            'nama_jurusan' => 'Teknik Kendaraan Ringan',
        ]);

    }

}
