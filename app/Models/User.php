<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\PenukaranBotol;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 1 User memiliki 1 data siswa
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id');
    }
    public function penukaranBotoSebagaiAdmin(): HasMany
    {
        return $this->hasMany(
            PenukaranBotol::class,
            'admin_id'
        );
    }
}