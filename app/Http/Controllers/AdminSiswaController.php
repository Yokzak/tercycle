<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jurusan;

class AdminSiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $siswaBulanIni = Siswa::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
            
        $siswas = Siswa::with('user', 'jurusan')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('kode_siswa', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();
        
        $totalPoin = Siswa::sum('saldo_poin');
        $totalSiswa = Siswa::count();
        $jurusans = Jurusan::orderBy('nama_jurusan')->get();

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
                        'no_telepon' => $siswa->no_telepon,
                        'saldo_poin' => $siswa->saldo_poin,
                    ];
                })
            );
        }

        return view('admin.siswa', compact('siswas', 'totalSiswa', 'siswaBulanIni', 'jurusans', 'totalPoin'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:61'],
            'nis' => ['required', 'string', 'max:8', 'unique:siswa,nis'],
            'kelas' => ['required', 'string', 'max:3'],
            'jurusan_id' => ['required', 'exists:jurusan,id'],
            'no_telepon' => ['required', 'string', 'max:13'],
        ]);

        Siswa::create([
            'user_id' => null,
            'nama_lengkap' => $data['nama_lengkap'],
            'nis' => $data['nis'],
            'kode_siswa' => 'SW-' . $data['nis'],
            'kelas' => $data['kelas'],
            'jurusan_id' => $data['jurusan_id'],
            'no_telepon' => $data['no_telepon'],
            'saldo_poin' => 0,
        ]);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }
}