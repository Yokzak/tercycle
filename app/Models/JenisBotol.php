<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisBotol extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'poin',
        'keterangan',
    ];

    public function transaksiTukarBotols()
    {
        return $this->hasMany(
            TransaksiTukarBotol::class,
            'jenis_botol_id'
        );
    }
}