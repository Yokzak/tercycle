<?php

namespace Database\Seeders;

use App\Models\KategoriBotol;
use Illuminate\Database\Seeder;

class KategoriBotolSeeder extends Seeder
{
    public function run(): void
    {
        KategoriBotol::create([
            'nama_kategori' => 'Kecil',
            'poin_satuan' => 10,
        ]);

        KategoriBotol::create([
            'nama_kategori' => 'Sedang',
            'poin_satuan' => 20,
        ]);

        KategoriBotol::create([
            'nama_kategori' => 'Besar',
            'poin_satuan' => 30,
        ]);
    }
}