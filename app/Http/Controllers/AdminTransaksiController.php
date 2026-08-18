<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\PenukaranBotol;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminTransaksiController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | FILTER
        |--------------------------------------------------------------------------
        */

        $minPoin = (int) $request->input('min_poin', 0);

        $maxPoin = (int) $request->input(
            'max_poin',
            999999
        );

        $jenis = $request->input('jenis', []);

        $statusPenukaran = $request->input(
            'status_penukaran',
            []
        );

        $statusPenjualan = $request->input(
            'status_penjualan',
            []
        );

        $statusPembelian = $request->input(
            'status_pembelian',
            []
        );


        /*
        |--------------------------------------------------------------------------
        | PENUKARAN
        |--------------------------------------------------------------------------
        |
        | 1 pengajuan penukaran = 1 transaksi
        |
        */

        $penukaran = PenukaranBotol::with([
            'siswa',
            'detailPenukaran.kategoriBotol'
        ])
            ->when(
                in_array('penukaran', $jenis),
                function ($query) use ($statusPenukaran) {

                    if (!empty($statusPenukaran)) {
                        $query->whereIn(
                            'status',
                            $statusPenukaran
                        );
                    }
                }
            )
            ->get()
            ->map(function ($item) {

                $jumlahBotol = $item->detailPenukaran->sum(
                    'jumlah_botol'
                );

                $namaKategori = $item->detailPenukaran
                    ->map(
                        fn ($detail) =>
                            $detail->kategoriBotol->nama_kategori
                            ?? 'Kategori'
                    )
                    ->unique()
                    ->implode(', ');

                return [
                    'id' => 'TKR-' . str_pad(
                        $item->id,
                        6,
                        '0',
                        STR_PAD_LEFT
                    ),

                    'siswa' => $item->siswa,

                    'jenis' => 'penukaran',

                    'detail' => $item->detailPenukaran,

                    'ringkasan' => $namaKategori,

                    'jumlah' => $jumlahBotol,

                    'poin' => $item->total_poin,

                    'status' => $item->status,

                    'tanggal' => $item->tanggal
                        ?? $item->created_at,
                ];
            });


        /*
        |--------------------------------------------------------------------------
        | PEMBELIAN
        |--------------------------------------------------------------------------
        |
        | 1 pesanan = 1 transaksi
        |
        */

        $pembelian = Pesanan::with([
            'pembeli',
            'detailPesanan'
        ])
            ->when(
                in_array('pembelian', $jenis),
                function ($query) use ($statusPembelian) {

                    if (!empty($statusPembelian)) {
                        $query->whereIn(
                            'status',
                            $statusPembelian
                        );
                    }
                }
            )
            ->get()
            ->map(function ($item) {

                $jumlahProduk = $item->detailPesanan->sum(
                    'jumlah_produk'
                );

                return [
                    'id' => 'BELI-' . str_pad(
                        $item->id,
                        6,
                        '0',
                        STR_PAD_LEFT
                    ),

                    'siswa' => $item->pembeli,

                    'jenis' => 'pembelian',

                    'detail' => $item->detailPesanan,

                    'ringkasan' => $jumlahProduk . ' produk',

                    'jumlah' => $jumlahProduk,

                    'poin' => $item->total_poin,

                    'status' => $item->status,

                    'tanggal' => $item->tanggal
                        ?? $item->created_at,
                ];
            });


        /*
        |--------------------------------------------------------------------------
        | PENJUALAN
        |--------------------------------------------------------------------------
        |
        | 1 pesanan + 1 penjual = 1 transaksi
        |
        */

        $penjualan = DetailPesanan::with([
            'penjual',
            'pesanan',
        ])
            ->when(
                in_array('penjualan', $jenis),
                function ($query) use ($statusPenjualan) {

                    if (!empty($statusPenjualan)) {
                        $query->whereHas(
                            'pesanan',
                            function ($query) use ($statusPenjualan) {
                                $query->whereIn(
                                    'status',
                                    $statusPenjualan
                                );
                            }
                        );
                    }
                }
            )
            ->get()
            ->groupBy(function ($item) {

                return $item->pesanan_id . '-' . $item->penjual_id;
            })
            ->map(function ($details) {

                $first = $details->first();

                $jumlahProduk = $details->sum(
                    'jumlah_produk'
                );

                $totalPoin = $details->sum(
                    'subtotal_poin'
                );

                return [
                    'id' => 'JUAL-' . str_pad(
                        $first->pesanan_id . $first->penjual_id,
                        8,
                        '0',
                        STR_PAD_LEFT
                    ),

                    'siswa' => $first->penjual,

                    'jenis' => 'penjualan',

                    'detail' => $details->values(),

                    'ringkasan' => $jumlahProduk . ' produk',

                    'jumlah' => $jumlahProduk,

                    'poin' => $totalPoin,

                    'status' => $first->pesanan->status,

                    'tanggal' => $first->created_at,
                ];
            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | GABUNGKAN
        |--------------------------------------------------------------------------
        */

        $transaksi = collect()
            ->merge($penukaran)
            ->merge($pembelian)
            ->merge($penjualan);


        /*
        |--------------------------------------------------------------------------
        | FILTER JENIS
        |--------------------------------------------------------------------------
        */

        if (!empty($jenis)) {
            $transaksi = $transaksi->filter(
                fn ($item) =>
                    in_array($item['jenis'], $jenis)
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER POIN
        |--------------------------------------------------------------------------
        */

        $transaksi = $transaksi->filter(
            fn ($item) =>
                $item['poin'] >= $minPoin &&
                $item['poin'] <= $maxPoin
        );


        /*
        |--------------------------------------------------------------------------
        | SORTING
        |--------------------------------------------------------------------------
        */

        $transaksi = $transaksi
            ->sortByDesc('tanggal')
            ->values();


        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $perPage = 10;

        $currentPage = $request->integer(
            'page',
            1
        );

        $currentItems = $transaksi->forPage(
            $currentPage,
            $perPage
        );

        $transaksi = new LengthAwarePaginator(
            $currentItems,
            $transaksi->count(),
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.transaksi',
            compact(
                'transaksi',
                'minPoin',
                'maxPoin',
                'jenis',
                'statusPenukaran',
                'statusPenjualan',
                'statusPembelian'
            )
        );
    }
}