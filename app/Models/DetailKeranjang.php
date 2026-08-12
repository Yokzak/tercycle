<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailKeranjang extends Model
{
    protected $table = 'detail_keranjang';
    protected $fillable = [
        'keranjang_id',
        'produk_id',
        'jumlah_produk'
    ];
    protected $casts = [
        'jumlah_produk' => 'integer'
    ];
    public function keranjang(): BelongsTo
    {
        return $this->belongsTo(Keranjang::class, 'keranjang_id');
    }
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
