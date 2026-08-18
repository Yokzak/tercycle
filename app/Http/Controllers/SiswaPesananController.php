<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\RiwayatPoin;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaPesananController extends Controller
{
    /**
     * Menampilkan pesanan sebagai pembeli dan penjual.
     */
    public function index(Request $request)
    {
        $siswa = $request->user()->siswa;

        // Pesanan sebagai pembeli
        $pesanansPembeli = Pesanan::with([
            'detailPesanan.produk',
            'detailPesanan.penjual',
        ])
            ->where('pembeli_id', $siswa->id)
            ->latest('tanggal')
            ->get();

        // Pesanan sebagai penjual
        $pesanansPenjual = Pesanan::with([
            'pembeli',
            'detailPesanan.produk',
            'detailPesanan.penjual',
        ])
            ->whereHas('detailPesanan', function ($query) use ($siswa) {
                $query->where('penjual_id', $siswa->id);
            })
            ->latest('tanggal')
            ->get();

        return view('siswa.pesanan', compact(
            'pesanansPembeli',
            'pesanansPenjual'
        ));
    }


    /**
     * Membuat pesanan dari keranjang.
     *
     * Saldo pembeli langsung dipotong saat pesanan dibuat.
     * Tidak ada refund.
     */
    public function store(Request $request)
    {
        $siswa = $request->user()->siswa;

        try {
            DB::transaction(function () use ($siswa) {

                /*
                 * Kunci data siswa agar saldo tidak
                 * berubah secara bersamaan.
                 */
                $siswa = Siswa::where('id', $siswa->id)
                    ->lockForUpdate()
                    ->firstOrFail();


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
                 * Pastikan semua produk masih tersedia.
                 */
                foreach ($details as $detail) {

                    if (!$detail->produk) {
                        throw new \RuntimeException(
                            'Ada produk dalam keranjang yang sudah tidak tersedia.'
                        );
                    }
                }


                /*
                 * Checkout hanya boleh dari satu penjual.
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
                 * Siswa tidak boleh membeli produk sendiri.
                 */
                if ($penjualId === $siswa->id) {
                    throw new \RuntimeException(
                        'Kamu tidak dapat membeli produk milik sendiri.'
                    );
                }


                /*
                 * Hitung total berdasarkan data produk terbaru.
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
                 * Pastikan saldo mencukupi.
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
                 * POTONG SALDO PEMBELI.
                 *
                 * Saldo dikunci sejak pesanan dibuat.
                 * Tidak ada refund.
                 */
                $siswa->decrement(
                    'saldo_poin',
                    $totalPoin
                );  


                /*
                 * Buat pesanan.
                 */
                $pesanan = Pesanan::create([
                    'pembeli_id' => $siswa->id,
                    'total_poin' => $totalPoin,
                    'status' => 'menunggu',
                    'tanggal' => now(),
                ]);

                RiwayatPoin::create([
                    'siswa_id' => $siswa->id,
                    'tipe' => 'keluar',
                    'jumlah_poin' => $totalPoin,
                    'keterangan' => 'Pembelian pesanan #' . $pesanan->id,
                ]);


                /*
                 * Buat detail pesanan dan kurangi stok.
                 */
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

                    $jumlah = $detail->jumlah_produk;

                    if ($produk->stok < $jumlah) {
                        throw new \RuntimeException(
                            'Stok "' .
                            $produk->nama_produk .
                            '" tidak mencukupi.'
                        );
                    }

                    $subtotal = $produk->harga_poin * $jumlah;

                    DetailPesanan::create([
                        'pesanan_id' => $pesanan->id,
                        'produk_id' => $produk->id,
                        'penjual_id' => $produk->siswa_id,
                        'nama_produk' => $produk->nama_produk,
                        'harga_satuan' => $produk->harga_poin,
                        'jumlah_produk' => $jumlah,
                        'subtotal_poin' => $subtotal,
                    ]);

                    $produk->decrement('stok', $jumlah);

                    $produk->refresh();

                    if ($produk->stok <= 0) {
                        $produk->update([
                            'status' => 'tidak tersedia',
                        ]);
                    }
                }


                /*
                 * Kosongkan keranjang.
                 */
                $keranjang->detailKeranjang()->delete();
            });


            return redirect()
                ->route('siswa.pesanan')
                ->with(
                    'success',
                    'Pesanan berhasil dibuat. Poin telah dipotong dan pesanan menunggu diproses penjual.'
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


    /**
     * Penjual memproses pesanan.
     *
     * Tidak ada pemotongan saldo di sini karena
     * saldo sudah dipotong ketika checkout.
     */
    public function process(Request $request, Pesanan $pesanan)
    {
        $penjual = $request->user()->siswa;

        try {

            DB::transaction(function () use ($pesanan, $penjual) {

                /*
                 * Kunci pesanan.
                 */
                $pesanan = Pesanan::where('id', $pesanan->id)
                    ->lockForUpdate()
                    ->firstOrFail();


                /*
                 * Pesanan harus masih menunggu.
                 */
                if ($pesanan->status !== 'menunggu') {
                    throw new \RuntimeException(
                        'Pesanan sudah diproses atau tidak dapat diproses lagi.'
                    );
                }


                /*
                 * Ambil detail.
                 */
                $pesanan->load('detailPesanan');


                if ($pesanan->detailPesanan->isEmpty()) {
                    throw new \RuntimeException(
                        'Pesanan tidak memiliki produk.'
                    );
                }


                /*
                 * Pastikan semua produk milik penjual
                 * yang sedang login.
                 */
                foreach ($pesanan->detailPesanan as $detail) {

                    if ($detail->penjual_id !== $penjual->id) {
                        abort(403);
                    }
                }


                /*
                 * Ubah status menjadi diproses.
                 */
                $pesanan->update([
                    'status' => 'diproses',
                ]);
            });


            return back()->with(
                'success',
                'Pesanan berhasil diproses.'
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


    /**
     * Pembeli menyelesaikan pesanan.
     *
     * Poin dari pesanan masuk ke saldo penjual.
     */
    public function selesai(Request $request, Pesanan $pesanan)
    {
        $siswa = $request->user()->siswa;

        try {

            DB::transaction(function () use ($pesanan, $siswa) {

                /*
                 * Kunci pesanan.
                 */
                $pesanan = Pesanan::where('id', $pesanan->id)
                    ->lockForUpdate()
                    ->firstOrFail();


                /*
                 * Pastikan pesanan milik pembeli.
                 */
                if ($pesanan->pembeli_id !== $siswa->id) {
                    abort(403);
                }


                /*
                 * Pesanan harus sedang diproses.
                 */
                if ($pesanan->status !== 'diproses') {
                    throw new \RuntimeException(
                        'Pesanan belum dapat diselesaikan.'
                    );
                }


                /*
                 * Ambil detail pesanan.
                 */
                $detail = $pesanan->detailPesanan()->first();


                if (!$detail) {
                    throw new \RuntimeException(
                        'Detail pesanan tidak ditemukan.'
                    );
                }


                /*
                 * Kunci saldo penjual.
                 */
                $penjual = Siswa::where('id', $detail->penjual_id)
                    ->lockForUpdate()
                    ->first();


                if (!$penjual) {
                    throw new \RuntimeException(
                        'Data penjual tidak ditemukan.'
                    );
                }


                /*
                 * Tambahkan poin ke saldo penjual.
                 */
                $penjual->increment(
                    'saldo_poin',
                    $pesanan->total_poin
                );


                /*
                 * Catat riwayat poin penjual.
                 */
                RiwayatPoin::create([
                    'siswa_id' => $penjual->id,
                    'tipe' => 'masuk',
                    'jumlah_poin' => $pesanan->total_poin,
                    'keterangan' =>
                        'Hasil penjualan pesanan #' .
                        $pesanan->id,
                ]);


                /*
                 * Tandai pesanan selesai.
                 */
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

    public function buy(Request $request)
    {

        $siswa = $request->user()->siswa;

        $data = $request->validate([
            'produk_id' => ['required', 'exists:produk,id'],
            'jumlah_produk' => ['required', 'integer', 'min:1'],
        ]);

        try {

            DB::transaction(function () use ($siswa, $data) {

                $siswa = Siswa::where('id', $siswa->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $produk = Produk::where('id', $data['produk_id'])
                    ->lockForUpdate()
                    ->first();

                if (!$produk) {
                    throw new \RuntimeException(
                        'Produk tidak ditemukan.'
                    );
                }

                if ($produk->siswa_id === $siswa->id) {
                    throw new \RuntimeException(
                        'Kamu tidak dapat membeli produk milik sendiri.'
                    );
                }

                if ($produk->status !== 'tersedia') {
                    throw new \RuntimeException(
                        'Produk sudah tidak tersedia.'
                    );
                }

                $jumlah = $data['jumlah_produk'];

                if ($produk->stok < $jumlah) {
                    throw new \RuntimeException(
                        'Stok produk tidak mencukupi.'
                    );
                }

                $totalPoin = $produk->harga_poin * $jumlah;

                if ($siswa->saldo_poin < $totalPoin) {
                    throw new \RuntimeException(
                        'Saldo poin tidak mencukupi. Total: ' .
                        number_format($totalPoin, 0, ',', '.') .
                        ' poin, saldo kamu: ' .
                        number_format($siswa->saldo_poin, 0, ',', '.') .
                        ' poin.'
                    );
                }

                $pesanan = Pesanan::create([
                    'pembeli_id' => $siswa->id,
                    'total_poin' => $totalPoin,
                    'status' => 'menunggu',
                    'tanggal' => now(),
                ]);

                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'produk_id' => $produk->id,
                    'penjual_id' => $produk->siswa_id,
                    'nama_produk' => $produk->nama_produk,
                    'harga_satuan' => $produk->harga_poin,
                    'jumlah_produk' => $jumlah,
                    'subtotal_poin' => $totalPoin,
                ]);

                // Kurangi stok
                $produk->decrement('stok', $jumlah);

                // Potong saldo pembeli
                $siswa->decrement('saldo_poin', $totalPoin);

                // Catat riwayat poin
                RiwayatPoin::create([
                    'siswa_id' => $siswa->id,
                    'tipe' => 'keluar',
                    'jumlah_poin' => $totalPoin,
                    'keterangan' => 'Pembelian pesanan #' . $pesanan->id,
                ]);

                // Jika stok habis
                $produk->refresh();

                if ($produk->stok <= 0) {
                    $produk->update([
                        'status' => 'tidak tersedia',
                    ]);
                }
            });

            return redirect()
                ->route('siswa.pesanan')
                ->with(
                    'success',
                    'Pesanan berhasil dibuat. Poin telah dipotong dan pesanan menunggu diproses penjual.'
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
}