<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesanan extends Model
{
    protected $fillable = [
        'pembeli_id',
        'total_poin',
        'status',
        'tanggal'
    ];
    protected $casts = [
        'total_poin' => 'integer',
        'tanggal' => 'datetime'
    ];

    public function pembeli(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'pembeli_id');
    }

    public function detailPesanan(): HasMany
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id');
    }
}
