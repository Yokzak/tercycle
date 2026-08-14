<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_jurusan' => [
                'required',
                'string',
                'max:4',
                'unique:jurusan,kode_jurusan',
            ],
            'nama_jurusan' => [
                'required',
                'string',
                'max:60',
                'unique:jurusan,nama_jurusan',
            ],
        ]);

        Jurusan::create($data);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Jurusan berhasil ditambahkan.');
        }

    public function destroy(Request $request)
    {
        $data = $request->validate([
            'jurusan_ids' => ['required', 'array', 'min:1'],
            'jurusan_ids.*' => [
                'integer',
                'exists:jurusan,id',
            ],
        ]);

        $jurusan = Jurusan::whereIn('id', $data['jurusan_ids'])
            ->withCount('siswa')
            ->get();

        $dipakai = $jurusan->filter(
            fn ($item) => $item->siswa_count > 0
        );

        if ($dipakai->isNotEmpty()) {
            return redirect()
                ->back()
                ->with('error', 'Jurusan tidak dapat dihapus karena masih digunakan oleh siswa: ' . $dipakai->pluck('nama_jurusan')->implode(', '));
        }

        Jurusan::whereIn('id', $data['jurusan_ids'])->delete();

        return redirect()
            ->back()
            ->with('success', 'Jurusan berhasil dihapus.');
    }
}