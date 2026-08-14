<?php

namespace App\Services;
use App\Models\Siswa;
use App\Models\RiwayatPoin;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PoinService {
    public function tambah(Siswa $siswa, int $jumlah, string $keterangan): void{
        DB::transaction(function () use ($siswa, $jumlah, $keterangan) {
            $siswa->increment('saldo_poin', $jumlah);
            RiwayatPoin::create([
                'siswa_id' => $siswa->id,
                'tipe' => 'masuk',
                'jumlah_poin' => $jumlah,
                'keterangan' => $keterangan,
            ]);
        });
    }
    public function kurangin(
        Siswa $siswa,
        int $jumlah,
        string $keterangan
    ): void {
        DB::transaction(function () use ($siswa, $jumlah, $keterangan) {
            if($siswa->saldo_poin < $jumlah) {
                ValidationException::withMessages([
                    'poin' => 'Saldo tidak mencukupi.',
                ]);
            }
            $siswa->decrement('saldo_poin', $jumlah);
            RiwayatPoin::create([
                'siswa_id' => $siswa->id,
                'tipe'=> 'keluar',
                'jumlah_poin' => $jumlah,
                'keterangan' => $keterangan,
            ]);

        });
    }
}


?>