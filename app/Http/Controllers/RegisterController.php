<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function checkStudent(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => ['required', 'string'],
            'nis' => ['required', 'string'],
            'kelas' => ['required', 'string'],
            'jurusan_id' => ['required', 'string'],
        ]);

        $siswa = Siswa::where('nis', $data['nis'])
            ->where('nama_lengkap', $data['nama_lengkap'])
            ->where('kelas', $data['kelas'])
            ->where('jurusan_id', $data['jurusan_id'])
            ->first();

        if (!$siswa) {
            return response()->json([
                'message' => 'Data siswa tidak ditemukan. Pastikan data yang dimasukkan sesuai dengan data sekolah.'
            ], 422);
        }

        // Pastikan siswa belum memiliki akun
        if ($siswa->user_id !== null) {
            return response()->json([
                'message' => 'Siswa ini sudah memiliki akun.'
            ], 422);
        }

        return response()->json([
            'message' => 'Data siswa ditemukan.',
            'siswa' => [
                'id' => $siswa->id,
                'nama_lengkap' => $siswa->nama_lengkap,
                'nis' => $siswa->nis,
                'kelas' => $siswa->kelas,
                'jurusan_id' => $siswa->jurusan_id,
            ]
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'siswa_id' => [
                'required',
                'exists:siswa,id',
            ],

            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $siswa = Siswa::findOrFail($data['siswa_id']);

        // Jangan izinkan siswa yang sudah punya akun mendaftar lagi
        if ($siswa->user_id !== null) {
            return back()->withErrors([
                'email' => 'Siswa ini sudah memiliki akun.'
            ]);
        }

        DB::transaction(function () use ($data, $siswa) {

            // Buat akun User
            $user = User::create([
                'name' => $siswa->nama_lengkap,
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => 'siswa',
            ]);

            // Hubungkan siswa dengan user
            $siswa->update([
                'user_id' => $user->id,
            ]);
        });

        return redirect()
            ->route('login')
            ->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
}