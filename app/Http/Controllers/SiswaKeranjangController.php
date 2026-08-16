<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\DetailKeranjang;
use App\Models\Produk;
use Illuminate\Http\Request;

class SiswaKeranjangController extends Controller
{
    public function index(Request $request)
    {
        $siswa = $request->user()->siswa;

        $keranjang = Keranjang::firstOrCreate([
            'siswa_id' => $siswa->id,
        ]);

        $keranjang->load([
            'detailKeranjang.produk.kategoriProduk',
            'detailKeranjang.produk.siswa',
        ]);

        return view('siswa.keranjang.index', compact('keranjang'));
    }


    public function store(Request $request, Produk $produk)
    {
        $siswa = $request->user()->siswa;

        if ($produk->status !== 'tersedia') {
            return back()->with('error', 'Produk sudah tidak tersedia.');
        }

        if ($produk->stok < 1) {
            return back()->with('error', 'Stok produk habis.');
        }

        $keranjang = Keranjang::firstOrCreate([
            'siswa_id' => $siswa->id,
        ]);

        $detail = DetailKeranjang::where('keranjang_id', $keranjang->id)
            ->where('produk_id', $produk->id)
            ->first();

        if ($detail) {

            if ($detail->jumlah_produk >= $produk->stok) {
                return back()->with(
                    'error',
                    'Jumlah produk sudah mencapai stok yang tersedia.'
                );
            }

            $detail->increment('jumlah_produk');

        } else {

            DetailKeranjang::create([
                'keranjang_id' => $keranjang->id,
                'produk_id' => $produk->id,
                'jumlah_produk' => 1,
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }


    public function increase(Request $request, DetailKeranjang $detail)
    {
        $siswa = $request->user()->siswa;

        if ($detail->keranjang->siswa_id !== $siswa->id) {
            abort(403);
        }

        $produk = $detail->produk;

        if ($detail->jumlah_produk >= $produk->stok) {
            return back()->with(
                'error',
                'Jumlah melebihi stok produk.'
            );
        }

        $detail->increment('jumlah_produk');

        return back();
    }


    public function decrease(Request $request, DetailKeranjang $detail)
    {
        $siswa = $request->user()->siswa;

        if ($detail->keranjang->siswa_id !== $siswa->id) {
            abort(403);
        }

        if ($detail->jumlah_produk > 1) {

            $detail->decrement('jumlah_produk');

        } else {

            $detail->delete();

        }

        return back();
    }


    public function destroy(Request $request, DetailKeranjang $detail)
    {
        $siswa = $request->user()->siswa;

        if ($detail->keranjang->siswa_id !== $siswa->id) {
            abort(403);
        }

        $detail->delete();

        return back()->with(
            'success',
            'Produk berhasil dihapus dari keranjang.'
        );
    }


    public function clear(Request $request)
    {
        $siswa = $request->user()->siswa;

        $keranjang = Keranjang::where(
            'siswa_id',
            $siswa->id
        )->first();

        if ($keranjang) {
            $keranjang->detailKeranjang()->delete();
        }

        return back()->with(
            'success',
            'Keranjang berhasil dikosongkan.'
        );
    }
}