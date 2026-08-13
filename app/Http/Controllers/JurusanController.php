<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        return response()->json(
            Jurusan::orderBy('nama_jurusan')->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_jurusan' => [
                'required',
                'string',
                'max:20',
                'unique:jurusan,kode_jurusan',
            ],
            'nama_jurusan' => [
                'required',
                'string',
                'max:255',
                'unique:jurusan,nama_jurusan',
            ],
        ]);

        $jurusan = Jurusan::create($data);

        return response()->json([
            'message' => 'Jurusan berhasil ditambahkan.',
            'jurusan' => $jurusan,
        ], 201);
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
            return response()->json([
                'message' =>
                    'Jurusan tidak dapat dihapus karena masih digunakan oleh siswa: ' .
                    $dipakai->pluck('nama_jurusan')->implode(', '),
            ], 422);
        }

        Jurusan::whereIn('id', $data['jurusan_ids'])->delete();

        return response()->json([
            'message' => 'Jurusan berhasil dihapus.',
            'deleted_ids' => $data['jurusan_ids'],
        ]);
    }
}