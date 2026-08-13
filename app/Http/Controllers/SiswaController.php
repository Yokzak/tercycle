<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SiswaController extends Controller
{
    public function profil(Request $request)
    {
        $user = $request->user()->load('siswa');

        $qr = QrCode::size(300)
            ->generate($user->siswa->kode_siswa);

        return view('siswa.profil', compact('user', 'qr'));
    }

    public function qr()
    {
        $siswa = auth()->user()->siswa;

        $qr = QrCode::size(300)
            ->generate($siswa->kode_siswa);

        return view('siswa.qr', compact('siswa', 'qr'));
    }

    public function updateProfil(Request $request)
    {
        $user = $request->user();
        $siswa = $user->siswa;

        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:20'],
            'jurusan' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update([
            'email' => $data['email'],
        ]);

        $siswa->update([
            'nama_lengkap' => $data['nama_lengkap'],
            'kelas' => $data['kelas'],
            'jurusan' => $data['jurusan'],
        ]);

        return redirect()
            ->route('siswa.profil')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}