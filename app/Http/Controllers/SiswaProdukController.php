<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;

class SiswaProdukController extends Controller
{
    public function index(Request $request)
    {
        $kategoriProduk = KategoriProduk::orderBy('nama_kategori')->get();
        $siswa = $request->user()->siswa;

        $produk = Produk::with('kategoriProduk')
        ->where('siswa_id', '!=', $siswa->id)
        ->where('status', 'tersedia')
        ->where('status_approval', 'disetujui')
        ->latest()
        ->get();


        return view('siswa.produk', compact('produk', 'kategoriProduk'));
    }

    public function produkSaya(Request $request)
    {
        $siswa = $request->user()->siswa;

        $produks = Produk::with('kategoriProduk')
            ->where('siswa_id', $siswa->id)
            ->latest()
            ->get();

        return view('siswa.produk-saya', compact('produks'));
    }

    public function store(Request $request)
    {
        $siswa = $request->user()->siswa;

        $data = $request->validate([
            'kategori_produk_id' => [
                'required',
                'exists:kategori_produk,id',
            ],
            'nama_produk' => [
                'required',
                'string',
                'max:255',
            ],
            'deskripsi' => [
                'nullable',
                'string',
            ],
            'harga_poin' => [
                'required',
                'integer',
                'min:1',
            ],
            'stok' => [
                'required',
                'integer',
                'min:0',
            ],
            'gambar' => [
                'nullable',
                'image',
                'max:2048',
            ],
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request
                ->file('gambar')
                ->store('produk', 'public');
        }

        Produk::create([
            'siswa_id' => $siswa->id,
            'kategori_produk_id' => $data['kategori_produk_id'],
            'nama_produk' => $data['nama_produk'],
            'deskripsi' => $data['deskripsi'] ?? null,
            'harga_poin' => $data['harga_poin'],
            'stok' => $data['stok'],
            'gambar' => $data['gambar'] ?? null,
            'status' => 'tidak tersedia',
            'status_approval' => 'menunggu',
        ]);

        return redirect()
            ->route('siswa.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }
}