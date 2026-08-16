<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\PenukaranBotol;
use App\Models\RiwayatPoin;
use App\Models\Pesanan;
use App\Models\DetailPenukaran;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Total siswa
        $totalSiswa = Siswa::count();

        // Total botol terkumpul
        $totalBotol = DetailPenukaran::sum('jumlah_botol');

        // Total poin yang saat ini beredar
        $poinBeredar = Siswa::sum('saldo_poin');

        // Total transaksi
        $totalTransaksi = Pesanan::count();


        /*TRANSAKSI TERBARU*/

        $pesananTerbaru = Pesanan::with('pembeli')
            ->orderByDesc('tanggal')
            ->take(5)
            ->get()
            ->map(function ($pesanan) {
                return [
                    'id' => $pesanan->id,
                    'siswa' => $pesanan->pembeli?->nama_lengkap ?? 'Siswa',
                    'aktivitas' => 'Pembelian produk',
                    'poin' => -$pesanan->total_poin,
                    'status' => $pesanan->status,
                    'tanggal' => $pesanan->tanggal,
                    'tipe' => 'pesanan',
                ];
            });

        $penukaranTerbaru = PenukaranBotol::with('siswa')
            ->orderByDesc('tanggal')
            ->take(5)
            ->get()
            ->map(function ($penukaran) {
                return [
                    'id' => $penukaran->id,
                    'siswa' => $penukaran->siswa?->nama_lengkap ?? 'Siswa',
                    'aktivitas' => 'Penukaran botol',
                    'poin' => $penukaran->total_poin,
                    'status' => $penukaran->status,
                    'tanggal' => $penukaran->tanggal,
                    'tipe' => 'penukaran',
                ];
            });

        $transaksiTerbaru = $pesananTerbaru
            ->concat($penukaranTerbaru)
            ->sortByDesc('tanggal')
            ->take(5)
            ->values();

        /*RINGKASAN HARI INI*/

        $penukaranBotolHariIni = PenukaranBotol::whereDate('tanggal', $today)
            ->count();

        $poinDiberikanHariIni = PenukaranBotol::whereDate('tanggal', $today)
            ->where('status', 'selesai')
            ->sum('total_poin');

        $produkTerjualHariIni = Pesanan::whereDate('tanggal', $today)
            ->where('status', 'selesai')
            ->with('detailPesanan')
            ->get()
            ->sum(function ($pesanan) {
                return $pesanan->detailPesanan->sum('jumlah_produk');
            });

        $siswaAktifHariIni = RiwayatPoin::whereDate(
            'created_at',
            $today
        )
            ->distinct('siswa_id')
            ->count('siswa_id');


        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalBotol',
            'poinBeredar',
            'totalTransaksi',
            'transaksiTerbaru',
            'penukaranBotolHariIni',
            'poinDiberikanHariIni',
            'produkTerjualHariIni',
            'siswaAktifHariIni',
            'transaksiTerbaru'
        ));
    }
}