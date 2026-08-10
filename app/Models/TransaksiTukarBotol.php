<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiTukarBotol extends Model
{
    use HasFactory;

    protected $fillable = [
        'tukar_botol_id',
        'jenis_botol_id',
        'jumlah',
        'poin_per_item',
        'subtotal',
    ];

    public function tukarBotol()
    {
        return $this->belongsTo(
            TukarBotol::class,
            'tukar_botol_id'
        );
    }

    public function jenisBotol()
    {
        return $this->belongsTo(
            JenisBotol::class,
            'jenis_botol_id'
        );
    }
}
