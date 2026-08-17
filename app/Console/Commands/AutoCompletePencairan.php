<?php

namespace App\Console\Commands;

use App\Models\PencairanPoin;
use Illuminate\Console\Command;

class AutoCompletePencairan extends Command
{
    protected $signature = 'pencairan:auto-complete';

    protected $description = 'Otomatis menyelesaikan pencairan yang sudah disetujui selama 24 jam';

    public function handle()
    {
        $jumlah = PencairanPoin::where('status', 'disetujui')
            ->whereNotNull('tanggal_pencairan')
            ->where(
                'tanggal_pencairan',
                '<=',
                now()->subHours(24)
            )
            ->update([
                'status' => 'selesai',
            ]);

        $this->info(
            "{$jumlah} pencairan otomatis diselesaikan."
        );

        return self::SUCCESS;
    }
}