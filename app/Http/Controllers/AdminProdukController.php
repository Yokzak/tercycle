<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class AdminProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $produkQuery = Produk::with([
            'siswa',
            'kategoriProduk',
        ]);

        /*
         * SEARCH
         */
        if ($search) {
            $produkQuery->where(function ($query) use ($search) {

                $query->where('nama_produk', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhereHas('kategori', function ($query) use ($search) {
                        $query->where(
                            'nama_kategori',
                            'like',
                            "%{$search}%"
                        );
                    });
            });
        }

        /*
         * PAGINATION
         */
        $produks = $produkQuery
            ->latest()
            ->paginate(6)
            ->withQueryString();

        /*
         * SUMMARY
         */

        // Semua produk
        $totalProduk = Produk::count();

        // Produk yang sudah disetujui admin
        $produkAktif = Produk::where('status_approval', 'disetujui')
            ->where('status', 'tersedia')
            ->count();

        // Total stok semua produk yang sudah disetujui
        $totalStok = Produk::where('status_approval', 'disetujui')
            ->sum('stok');

        /*
         * Total produk terjual bulan ini.
         */
        $terjualBulanIni = \App\Models\DetailPesanan::whereHas(
            'pesanan',
            function ($query) {
                $query
                    ->where('status', 'selesai')
                    ->whereMonth('tanggal', now()->month)
                    ->whereYear('tanggal', now()->year);
            }
        )->sum('jumlah_produk');

        return view('admin.produk', compact(
            'produks',
            'totalProduk',
            'produkAktif',
            'totalStok',
            'terjualBulanIni',
            'search'
        ));
    }


    /*
     * TERIMA PRODUK
     */
    public function approve(Produk $produk)
    {
        if ($produk->status_approval !== 'menunggu') {
            return back()->with(
                'error',
                'Produk ini sudah diproses.'
            );
        }

        $produk->update([
            'status_approval' => 'disetujui',
            'status' => 'tersedia',
        ]);

        return back()->with(
            'success',
            'Produk berhasil disetujui dan sekarang tersedia di marketplace.'
        );
    }


    /*
     * TOLAK PRODUK
     */
    public function reject(Produk $produk)
    {
        if ($produk->status_approval !== 'menunggu') {
            return back()->with(
                'error',
                'Produk ini sudah diproses.'
            );
        }

        $produk->update([
            'status_approval' => 'ditolak',
            'status' => 'tidak tersedia',
        ]);

        return back()->with(
            'success',
            'Produk berhasil ditolak.'
        );
    }
}