<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\PenukaranBotol;
use App\Models\RiwayatPoin;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'nis',
        'kode_siswa',
        'kelas',
        'jurusan',
        'saldo_poin',
    ];

    protected $casts = [
        'saldo_poin' => 'integer',
    ];

    // Siswa dimiliki oleh satu User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Satu siswa dapat melakukan banyak penukaran
    public function penukaranBotol(): HasMany
    {
        return $this->hasMany(PenukaranBotol::class);
    }
    public function riwayatPoin(): HasMany
    {
        return $this->hasMany(RiwayatPoin::class);
    }
    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class, 'siswa_id');
    }
    public function keranjang(): HasOne
    {
        return $this->hasOne(Keranjang::class);
    }
    public function pesananSebagaiPembeli(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'pembeli_id');
    }
    public function detailPenjualan(): HasMany
    {
        return $this->hasMany(DetailPesanan::class, 'penjual_id');
    }
    public function pencairanPoin(): HasMany
    {
        return $this->hasMany(PencairanPoin::class,'siswa_id');
    }
}