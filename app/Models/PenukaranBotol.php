<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PenukaranBotol extends Model
{
    protected $table = 'penukaran_botol';

    protected $fillable = [
        'siswa_id',
        'admin_id',
        'total_poin',
        'tanggal',
    ];

    protected $casts = [
        'total_poin' => 'integer',
        'tanggal' => 'datetime',
    ];

    // Satu penukaran dimiliki oleh satu siswa
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    // Satu penukaran diproses oleh satu admin
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // Satu penukaran memiliki banyak detail penukaran
    public function detailPenukaran(): HasMany
    {
        return $this->hasMany(
            DetailPenukaran::class,
            'penukaran_id'
        );
    }
}