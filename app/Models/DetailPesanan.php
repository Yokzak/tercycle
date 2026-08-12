<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPesanan extends Model
{
    protected $table = 'detail_pesanan';
    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'penjual_id',
        'nama_produk',
        'harga_satuan',
        'jumlah_produk',
        'subtotal_poin'
    ];
    protected $casts = [
        'harga_satuan' => 'integer',
        'jumlah_produk' => 'integer',
        'subtotal_poin' => 'integer'
    ];
    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
    public function penjual(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'penjual_id');
    }
}
