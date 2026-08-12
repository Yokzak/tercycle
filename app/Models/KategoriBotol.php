<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriBotol extends Model
{
    protected $table = 'kategori_botol';

    protected $fillable = [
        'nama_kategori',
        'poin_satuan',
    ];

    protected $casts = [
        'poin_satuan' => 'integer',
    ];

    // Satu kategori botol dapat digunakan pada banyak detail penukaran
    public function detailPenukaran(): HasMany
    {
        return $this->hasMany(
            DetailPenukaran::class,
            'kategori_botol_id'
        );
    }
}