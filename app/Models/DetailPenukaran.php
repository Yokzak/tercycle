<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPenukaran extends Model
{
    protected $table = 'detail_penukaran';
    protected $fillable = [
        'penukaran_id',
        'kategori_botol_id',
        'jumlah_botol',
        'poin_satuan',
        'subtotal_poin'
    ];
    protected $casts = [
        'jumlah_botol' => 'integer',
        'poin_satuan' => 'integer',
        'subtotal_poin' => 'integer'
    ];
    public function penukaran(): belongsTo {
        return $this->belongsTo(PenukaranBotol::class, 'penukaran_id');
    }
    public function kategoriBotol(): belongsTo {
        return $this->belongsTo(KategoriBotol::class, 'kategori_botol_id');
    }
}
