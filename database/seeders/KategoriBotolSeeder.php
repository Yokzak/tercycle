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
            'ukuran' => '250-380ml',
            'poin_satuan' => 10,
        ]);

        KategoriBotol::create([
            'nama_kategori' => 'Sedang',
            'ukuran' => '600-750ml',
            'poin_satuan' => 20,
        ]);

        KategoriBotol::create([
            'nama_kategori' => 'Besar',
            'ukuran' => '1500ml',
            'poin_satuan' => 30,
        ]);
    }
}