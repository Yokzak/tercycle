<?php

namespace Database\Seeders;
use App\Models\KategoriProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriProduk::create([
            'nama_kategori' => 'makanan',
            'deskripsi' => 'kategori untuk produk makanan',
        ]);
        KategoriProduk::create([
            'nama_kategori' => 'minuman',
            'deskripsi' => 'kategori untuk produk minuman',
        ]);
        KategoriProduk::create([
            'nama_kategori' => 'aksesoris',
            'deskripsi' => 'kategori untuk produk aksesoris',
        ]);
        KategoriProduk::create([
            'nama_kategori' => 'kerajinan',
            'deskripsi' => 'kategori untuk produk kerajinan',
        ]);
        KategoriProduk::create([
            'nama_kategori' => 'alat tulis',
            'deskripsi' => 'kategori untuk produk alat tulis',
        ]);
    }
}
