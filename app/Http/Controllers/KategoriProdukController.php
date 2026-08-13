<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{
    public function index()
    {
        $kategori = KategoriProduk::latest()->get();

        return response()->json($kategori);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:255',
                'unique:kategori_produk,nama_kategori',
            ],
            'deskripsi' => [
                'nullable',
                'string',
            ],
        ]);

        $kategori = KategoriProduk::create($data);

        return response()->json([
            'message' => 'Kategori berhasil ditambahkan.',
            'kategori' => $kategori,
        ], 201);
    }

    public function destroy(Request $request)
    {
        $data = $request->validate([
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['integer', 'exists:kategori_produk,id'],
        ]);

        $kategori = KategoriProduk::whereIn('id', $data['categories'])
            ->withCount('produk')
            ->get();

        $dipakai = $kategori->filter(fn ($item) => $item->produk_count > 0);

        if ($dipakai->isNotEmpty()) {
            return response()->json([
                'message' => 'Kategori tidak dapat dihapus karena masih digunakan oleh produk: '
                    . $dipakai->pluck('nama_kategori')->implode(', '),
            ], 422);
        }

        KategoriProduk::whereIn('id', $data['categories'])->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus.',
            'deleted_ids' => $data['categories'],
        ]);
    }
}