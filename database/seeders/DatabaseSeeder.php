<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            KategoriBotolSeeder::class,
            SiswaSeeder::class,
            JurusanSeeder::class,
            KategoriProdukSeeder::class,
        ]);
    }
}