<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SiswaController extends Controller
{
    public function profil(Request $request)
    {
        $user = $request->user()->load(['siswa.jurusan']);

        $siswa = $user->siswa;

        if (!$siswa) {
            abort(404, 'Data siswa untuk akun ini belum tersedia.');
        }

        $qr = QrCode::size(300)
            ->generate($siswa->kode_siswa);

        $jurusans = Jurusan::orderBy('nama_jurusan')->get();

        return view('siswa.profil', compact(
            'user',
            'siswa',
            'qr',
            'jurusans'
        ));
    }

    public function qr(Request $request)
    {
        $siswa = $request->user()->siswa;

        if (!$siswa) {
            abort(404, 'Data siswa untuk akun ini belum tersedia.');
        }

        $qr = QrCode::size(300)
            ->generate($siswa->kode_siswa);

        return view('siswa.qr', compact('siswa', 'qr'));
    }

    public function updateProfil(Request $request)
    {
        $user = $request->user();
        $siswa = $user->siswa;

        if (!$siswa) {
            abort(404, 'Data siswa untuk akun ini belum tersedia.');
        }

        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:20'],
            'jurusan_id' => ['required', 'exists:jurusan,id'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],
        ]);

        DB::transaction(function () use ($user, $siswa, $data) {
            $user->update([
                'email' => $data['email'],
            ]);

            $siswa->update([
                'nama_lengkap' => $data['nama_lengkap'],
                'kelas' => $data['kelas'],
                'jurusan_id' => $data['jurusan_id'],
            ]);
        });

        return redirect()
            ->route('siswa.profil')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}