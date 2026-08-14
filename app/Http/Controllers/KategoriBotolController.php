<?php

namespace App\Http\Controllers;

use App\Models\KategoriBotol;
use Illuminate\Http\Request;

class KategoriBotolController extends Controller
{
    public function index()
    {
        $kategoriBotols = KategoriBotol::orderBy('nama_kategori')->get();
        return view('admin.botol', compact('kategoriBotols'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:255',
            ],

            'ukuran' => [
                'required',
                'string',
                'max:255',
            ],

            'poin_satuan' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);

        KategoriBotol::create($data);

        return redirect()
            ->route('admin.botol.index')
            ->with('success', 'Kategori botol berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'ukuran' => ['required', 'string', 'max:50'],
            'poin_satuan' => ['required', 'integer', 'min:0'],
        ]);

        $kategori = KategoriBotol::findOrFail($id);

        $kategori->update([
            'ukuran' => $data['ukuran'],
            'poin_satuan' => $data['poin_satuan'],
        ]);

        return redirect()
            ->route('admin.botol.index')
            ->with('success', 'Kategori botol berhasil diperbarui.');
    }

    public function destroy(KategoriBotol $kategoriBotol)
    {
        $kategoriBotol->delete();

        return redirect()
            ->route('admin.botol.index')
            ->with('success', 'Kategori botol berhasil dihapus.');
    }
}