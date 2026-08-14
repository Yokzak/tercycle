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
        'status',
        'tanggal',
    ];

    protected $casts = [
        'total_poin' => 'integer',
        'tanggal' => 'datetime',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function detailPenukaran(): HasMany
    {
        return $this->hasMany(
            DetailPenukaran::class,
            'penukaran_id'
        );
    }
}