<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'siswa_id',
        'kategori_produk_id',
        'nama_produk',
        'deskripsi',
        'harga_poin',
        'stok',
        'gambar',
        'status',
    ];

    protected $casts = [
        'harga_poin' => 'integer',
        'stok' => 'integer',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(
            Siswa::class,
            'siswa_id'
        );
    }

    public function kategoriProduk(): BelongsTo
    {
        return $this->belongsTo(
            KategoriProduk::class,
            'kategori_produk_id'
        );
    }
    public function detailKeranjang(): HasMany
    {
        return $this->hasMany(
            DetailKeranjang::class,
            'produk_id'
        );
    }
}