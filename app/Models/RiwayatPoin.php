<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPoin extends Model
{
    protected $table = 'riwayat_poins';
    protected $fillable = [
        'siswa_id',
        'tipe',
        'jumlah_poin',
        'keterangan'
    ];
    protected $casts = [
        'jumlah_poin' => 'integer'
    ];
    //Riwayat poin dimiliki satu siswa
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

}
