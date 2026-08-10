<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisBotolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    use App\Models\JenisBotol;

public function run(): void
{
    JenisBotol::create([
        'nama' => 'Botol Plastik Kecil',
        'poin' => 5,
        'keterangan' => 'Botol plastik ukuran kurang dari 600ml',
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
