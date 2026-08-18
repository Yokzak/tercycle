<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $fillable = [
        'siswa_id',
    ];
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    public function detailKeranjang(): HasMany
    {
        return $this->hasMany(DetailKeranjang::class, 'keranjang_id');
    }
    public function getJumlahProdukAttribute()
    {
        return $this->detailKeranjang()->sum('jumlah_produk');
    }
}
