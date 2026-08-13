<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminSiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $siswaBulanIni = Siswa::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $siswas = Siswa::with('user')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('kode_siswa', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        $totalSiswa = Siswa::count();

        if ($request->ajax()) {
            return response()->json(
                $siswas->map(function ($siswa) {
                    return [
                        'id' => $siswa->id,
                        'nama_lengkap' => $siswa->nama_lengkap,
                        'nis' => $siswa->nis,
                        'kode_siswa' => $siswa->kode_siswa,
                        'kelas' => $siswa->kelas,
                        'jurusan' => $siswa->jurusan,
                        'saldo_poin' => $siswa->saldo_poin,
                    ];
                })
            );
        }

        return view('admin.siswa', compact('siswas', 'totalSiswa', 'siswaBulanIni'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'nis' => ['required', 'string', 'max:50', 'unique:siswa,nis'],
            'kelas' => ['required', 'string', 'max:20'],
            'jurusan' => ['required', 'string', 'max:50'],

            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['nama_lengkap'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => 'siswa',
            ]);

            $kode_siswa = 'SIS-' . $data['nis'];
            $siswa = Siswa::create([
                'user_id' => $user->id,
                'nama_lengkap' => $data['nama_lengkap'],
                'nis' => $data['nis'],
                'kode_siswa' => $kode_siswa,
                'kelas' => $data['kelas'],
                'jurusan' => $data['jurusan'],
                'saldo_poin' => 0,
            ]);
        });

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Akun siswa berhasil dibuat.');
    }
}