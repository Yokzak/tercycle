<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Siswa;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $fillable = [
        'kode_jurusan',
        'nama_jurusan',
    ];
    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class, 'jurusan_id');
    }
}