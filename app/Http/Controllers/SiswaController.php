<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Models\Siswa;
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

    public function dashboard(Request $request)
    {
        $user = $request->user()->load(['siswa.jurusan']);

        $siswa = $user->siswa;

        if (!$siswa) {
            abort(404, 'Data siswa untuk akun ini belum tersedia.');
        }

        $qr = QrCode::size(300)
            ->generate($siswa->kode_siswa);

        return view('siswa.dashboard', compact(
            'user',
            'siswa',
            'qr'
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
            'kelas' => ['required', 'string', 'max:3'],
            'jurusan_id' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        DB::transaction(function () use ($user, $siswa, $data) {
            $user->update([
                'email' => $data['email'],
            ]);

            $siswa->update([
                'kelas' => $data['kelas'],
                'jurusan_id' => $data['jurusan_id'],
            ]);
        });

        $siswa->update([
            'kelas' => $data['kelas'],
            'jurusan_id' => $data['jurusan_id'],
        ]);

        return redirect()
            ->route('siswa.profil')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nis' => 'required|string|max:50',
            'no_telepon' => 'nullable|string|max:20',
            'kelas' => 'required|in:X,XI,XII',
            'jurusan_id' => 'required|exists:jurusans,id',
        ]);

        $siswa->update($validated);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }
}