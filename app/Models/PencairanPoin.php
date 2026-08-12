<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PencairanPoin extends Model
{
    protected $table = 'pencairan_poin';
    protected $fillable = [
        'siswa_id',
        'jumlah_poin',
        'jumlah_uang',
        'metode',
        'provider',
        'nama_penerima',
        'nomor_tujuan',
        'status',
        'catatan',
        'tanggal_pengajuan',
        'tanggal_pencairan'
    ];

    protected $casts = [
        'jumlah_poin' => 'integer',
        'jumlah_uang' => 'integer',
        'tanggal_pengajuan' => 'datetime',
        'tanggal_pencairan' => 'datetime'
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class,'siswa_id');
    }
}
