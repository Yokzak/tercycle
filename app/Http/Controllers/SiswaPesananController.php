<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\RiwayatPoin;
use App\Models\Produk; 
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaPesananController extends Controller
{
    public function index(Request $request)
    {
        $siswa = $request->user()->siswa;

        /* * Pesanan sebagai PEMBELI */
        $pesanansPembeli = Pesanan::with([ 'detailPesanan.produk', ]) ->where('pembeli_id', $siswa->id) ->latest('tanggal') ->get();

        $pesanansPenjual = Pesanan::with([ 
            'pembeli', 
            'detailPesanan.produk', 
        ]) 
        ->whereHas('detailPesanan', function ($query) use ($siswa) { $query->where('penjual_id', $siswa->id); }) 
        ->latest('tanggal') 
        ->get();

        $pesanans = Pesanan::with([
            'detailPesanan.produk',
            'detailPesanan.penjual',
        ])
        ->where('pembeli_id', $siswa->id)
        ->latest('tanggal')
        ->get();

        return view('siswa.pesanan', compact('pesanansPembeli', 'pesanansPenjual'));
    }

    public function store(Request $request)
    {
        
        $siswa = $request->user()->siswa;

        try {

            DB::transaction(function () use ($siswa) {

                /*
                * Ambil keranjang milik siswa.
                */
                $keranjang = Keranjang::with([
                    'detailKeranjang.produk',
                ])
                    ->where('siswa_id', $siswa->id)
                    ->first();

                if (!$keranjang || $keranjang->detailKeranjang->isEmpty()) {
                    throw new \RuntimeException(
                        'Keranjang masih kosong.'
                    );
                }


                $details = $keranjang->detailKeranjang;


                /*
                * Pastikan semua produk masih ada.
                */
                foreach ($details as $detail) {

                    if (!$detail->produk) {
                        throw new \RuntimeException(
                            'Ada produk dalam keranjang yang sudah tidak tersedia.'
                        );
                    }
                }


                /*
                * CHECKOUT SATU PENJUAL.
                */
                $penjualIds = $details
                    ->pluck('produk.siswa_id')
                    ->unique();


                if ($penjualIds->count() > 1) {
                    throw new \RuntimeException(
                        'Checkout hanya dapat dilakukan untuk produk dari satu penjual.'
                    );
                }


                $penjualId = $penjualIds->first();


                /*
                * Tidak boleh membeli produk sendiri.
                */
                if ($penjualId === $siswa->id) {
                    throw new \RuntimeException(
                        'Kamu tidak dapat membeli produk milik sendiri.'
                    );
                }


                /*
                * Hitung total berdasarkan harga
                * terbaru dari database.
                */
                $totalPoin = 0;

                foreach ($details as $detail) {

                    $produk = Produk::where('id', $detail->produk_id)
                        ->lockForUpdate()
                        ->first();

                    if (!$produk) {
                        throw new \RuntimeException(
                            'Produk tidak ditemukan.'
                        );
                    }

                    if ($produk->status !== 'tersedia') {
                        throw new \RuntimeException(
                            'Produk "' .
                            $produk->nama_produk .
                            '" sudah tidak tersedia.'
                        );
                    }

                    if ($detail->jumlah_produk < 1) {
                        throw new \RuntimeException(
                            'Jumlah produk tidak valid.'
                        );
                    }

                    if ($produk->stok < $detail->jumlah_produk) {
                        throw new \RuntimeException(
                            'Stok "' .
                            $produk->nama_produk .
                            '" tidak mencukupi.'
                        );
                    }

                    $totalPoin +=
                        $produk->harga_poin *
                        $detail->jumlah_produk;
                }
                

                /*
                * CEK SALDO PEMBELI
                *
                * Pesanan tidak dibuat jika saldo tidak mencukupi.
                */
                if ($siswa->saldo_poin < $totalPoin) {
                    throw new \RuntimeException(
                        'Saldo poin tidak mencukupi. Total pesanan: ' .
                        number_format($totalPoin, 0, ',', '.') .
                        ' poin, saldo kamu: ' .
                        number_format($siswa->saldo_poin, 0, ',', '.') .
                        ' poin.'
                    );
                }

                /*
                * Buat pesanan.
                *
                * Poin BELUM dipotong.
                */
                $pesanan = Pesanan::create([
                    'pembeli_id' => $siswa->id,
                    'total_poin' => $totalPoin,
                    'status' => 'menunggu',
                    'tanggal' => now(),
                ]);


                /*
                * Buat detail pesanan sekaligus
                * reservasi stok.
                */
                foreach ($details as $detail) {

                    /*
                    * Lock ulang produk untuk memastikan
                    * stok yang digunakan adalah stok
                    * terbaru.
                    */
                    $produk = Produk::where('id', $detail->produk_id)
                        ->lockForUpdate()
                        ->first();


                    if (!$produk) {
                        throw new \RuntimeException(
                            'Produk tidak ditemukan.'
                        );
                    }


                    if ($produk->status !== 'tersedia') {
                        throw new \RuntimeException(
                            'Produk "' .
                            $produk->nama_produk .
                            '" sudah tidak tersedia.'
                        );
                    }


                    if ($produk->stok < $detail->jumlah_produk) {
                        throw new \RuntimeException(
                            'Stok "' .
                            $produk->nama_produk .
                            '" tidak mencukupi.'
                        );
                    }


                    $jumlah = $detail->jumlah_produk;

                    $subtotal =
                        $produk->harga_poin *
                        $jumlah;

                    
                    /*
                    * Simpan snapshot produk ke
                    * detail pesanan.
                    */
                    DetailPesanan::create([
                        'pesanan_id' => $pesanan->id,
                        'produk_id' => $produk->id,
                        'penjual_id' => $produk->siswa_id,
                        'nama_produk' => $produk->nama_produk,
                        'harga_satuan' => $produk->harga_poin,
                        'jumlah_produk' => $jumlah,
                        'subtotal_poin' => $subtotal,
                    ]);
                    

                    /*
                    * RESERVASI STOK.
                    *
                    * Stok berkurang saat checkout.
                    */
                    $produk->decrement(
                        'stok',
                        $jumlah
                    );

                    /*
                    * Jika stok habis,
                    * produk tidak ditampilkan lagi.
                    */
                    $produk->refresh();

                    if ($produk->stok <= 0) {

                        $produk->update([
                            'status' => 'tidak tersedia',
                        ]);
                        
                    }

                }

                /*
                * Keranjang dikosongkan setelah
                * seluruh proses berhasil.
                */
                $keranjang->detailKeranjang()->delete();
            });


            return redirect()
                ->route('siswa.pesanan')
                ->with(
                    'success',
                    'Pesanan berhasil dibuat. Stok telah dicadangkan dan menunggu diproses penjual.'
                );


        } catch (\RuntimeException $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );


        } catch (\Throwable $e) {

            report($e);

            return back()->with(
                'error',
                'Pesanan gagal dibuat. Silakan coba lagi.'
            );
        }
    }

    public function process(Request $request, Pesanan $pesanan)
    {

        $penjual = $request->user()->siswa;

        try {

            DB::transaction(function () use ($pesanan, $penjual) {

                /*
                * Kunci pesanan agar tidak diproses
                * oleh dua request sekaligus.
                */
                $pesanan = Pesanan::where('id', $pesanan->id)
                    ->lockForUpdate()
                    ->firstOrFail();


                /*
                * Pesanan hanya boleh diproses
                * jika status masih menunggu.
                */
                if ($pesanan->status !== 'menunggu') {

                    throw new \RuntimeException(
                        'Pesanan sudah diproses atau tidak dapat diproses lagi.'
                    );
                }

                /*
                * Ambil detail pesanan.
                */
                $pesanan->load('detailPesanan');

                if ($pesanan->detailPesanan->isEmpty()) {

                    throw new \RuntimeException(
                        'Pesanan tidak memiliki produk.'
                    );
                }


                /*
                * Karena checkout dibatasi satu penjual,
                * semua detail harus milik penjual yang login.
                */
                foreach ($pesanan->detailPesanan as $detail) {

                    if ($detail->penjual_id !== $penjual->id) {
                        abort(403);
                    }
                }

                /*
                * Kunci data pembeli.
                */
                $pembeli = $pesanan->pembeli()
                    ->lockForUpdate()
                    ->first();


                if (!$pembeli) {

                    throw new \RuntimeException(
                        'Data pembeli tidak ditemukan.'
                    );
                }
                
                
                /*
                * Cek saldo pembeli lagi.
                *
                * Pengecekan ini WAJIB karena saldo
                * belum dipotong saat checkout.
                */
                if ($pembeli->saldo_poin < $pesanan->total_poin) {

                    throw new \RuntimeException(
                        'Saldo poin pembeli tidak mencukupi.'
                    );
                };
                
                /*
                * Potong saldo pembeli.
                */
                $pembeli->decrement(
                    'saldo_poin',
                    $pesanan->total_poin
                );
                

                /*
                * Catat riwayat poin pembeli.
                */
                RiwayatPoin::create([
                    'siswa_id' => $pembeli->id,
                    'tipe' => 'keluar',
                    'jumlah_poin' => $pesanan->total_poin,
                    'keterangan' => 'Pembelian pesanan #' . $pesanan->id,
                ]);

                /*
                * Ubah status pesanan.
                */
                $pesanan->update([
                    'status' => 'diproses',
                ]);
            });


            return back()->with(
                'success',
                'Pesanan berhasil diproses. Poin pembeli telah dipotong.'
            );

        } catch (\RuntimeException $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );

        } catch (\Throwable $e) {

            report($e);

            return back()->with(
                'error',
                'Pesanan gagal diproses.'
            );
        }
    }

    public function selesai(Request $request, Pesanan $pesanan)
    {
        $siswa = $request->user()->siswa;

        try {

            DB::transaction(function () use ($pesanan, $siswa) {

                /*
                * Kunci pesanan agar tidak diselesaikan
                * oleh dua request sekaligus.
                */
                $pesanan = Pesanan::where('id', $pesanan->id)
                    ->lockForUpdate()
                    ->firstOrFail();


                /*
                * Pastikan pesanan milik pembeli
                * yang sedang login.
                */
                if ($pesanan->pembeli_id !== $siswa->id) {
                    abort(403);
                }


                /*
                * Pesanan hanya bisa diselesaikan
                * jika sedang diproses.
                */
                if ($pesanan->status !== 'diproses') {

                    throw new \RuntimeException(
                        'Pesanan belum dapat diselesaikan.'
                    );
                }


                // Ambil penjual dari detail pesanan
                $detail = $pesanan->detailPesanan()->first();

                if (!$detail) {
                    throw new \RuntimeException(
                        'Detail pesanan tidak ditemukan.'
                    );
                }

                $penjual = Siswa::where('id', $detail->penjual_id)
                    ->lockForUpdate()
                    ->first();

                if (!$penjual) {
                    throw new \RuntimeException(
                        'Data penjual tidak ditemukan.'
                    );
                }

                // Tambahkan poin ke saldo penjual
                $penjual->increment(
                    'saldo_poin',
                    $pesanan->total_poin
                );

                // Catat riwayat poin penjual
                $penjual->riwayatPoin()->create([
                    'tipe' => 'masuk',
                    'jumlah_poin' => $pesanan->total_poin,
                    'keterangan' => 'Hasil penjualan pesanan #' . $pesanan->id,
                ]);

                // Baru tandai pesanan selesai
                $pesanan->update([
                    'status' => 'selesai',
                ]);
            });


            return back()->with(
                'success',
                'Pesanan berhasil diselesaikan.'
            );

        } catch (\RuntimeException $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );

        } catch (\Throwable $e) {

            report($e);

            return back()->with(
                'error',
                'Pesanan gagal diselesaikan.'
            );
        }
    }

}