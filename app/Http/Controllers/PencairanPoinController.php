<?php

namespace App\Http\Controllers;

use App\Models\PencairanPoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PencairanPoinController extends Controller
{
    /**
     * Menampilkan halaman pencairan poin siswa.
     */
    public function index()
    {
        $siswa = Auth::user()->siswa;

        $pencairan = PencairanPoin::where('siswa_id', $siswa->id
        )
            ->latest('tanggal_pengajuan')
            ->get();

        return view('siswa.pencairan-uang',
            compact(
                'siswa',
                'pencairan'
            )
        );
    }

    public function indexAdmin(Request $request)
    {
        $search = $request->input('search');

        $pencairan = PencairanPoin::with('siswa')
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    // Cari berdasarkan ID pencairan
                    $q->where('id', 'like', "%{$search}%")

                        // Nama penerima
                        ->orWhere('nama_penerima', 'like', "%{$search}%")

                        // Nomor tujuan
                        ->orWhere('nomor_tujuan', 'like', "%{$search}%")

                        // Provider
                        ->orWhere('provider', 'like', "%{$search}%")

                        // Status
                        ->orWhere('status', 'like', "%{$search}%")

                        // Cari berdasarkan data siswa
                        ->orWhereHas('siswa', function ($siswa) use ($search) {
                            $siswa->where('nama_lengkap', 'like', "%{$search}%")
                                ->orWhere('kode_siswa', 'like', "%{$search}%");
                        });

                });

            })
            ->latest('tanggal_pengajuan')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pencairan-uang', compact(
            'pencairan',
            'search'
        ));
    }


    /**
     * Mengajukan pencairan poin.
     */
    public function store(Request $request)
    {
        $siswa = Auth::user()->siswa;

        $validated = $request->validate([
            'jumlah_poin' => [
                'required',
                'integer',
                'min:10',
            ],

            'metode' => [
                'required',
                'in:cash,e-wallet',
            ],

            'provider' => [
                'nullable',
                'in:dana,gopay,shopeepay,ovo',
            ],

            'nama_penerima' => [
                'required',
                'string',
                'max:255',
            ],

            'nomor_tujuan' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        $jumlahPoin = (int) $validated['jumlah_poin'];

        /*
        |--------------------------------------------------------------------------
        | VALIDASI DATA METODE
        |--------------------------------------------------------------------------
        */

        if ($validated['metode'] === 'e-wallet') {
            if (
                empty($validated['provider']) ||
                empty($validated['nomor_tujuan'])
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'nomor_tujuan' => 'Provider dan nomor tujuan wajib diisi.',
                    ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | KONVERSI POIN
        |--------------------------------------------------------------------------
        |
        | 100 poin = Rp10.000
        | 1 poin   = Rp100
        |
        */

        $jumlahUang = $jumlahPoin * 100;

        /*
        |--------------------------------------------------------------------------
        | CEK SALDO + KURANGI SALDO + BUAT PENGAJUAN
        |--------------------------------------------------------------------------
        */

        try {

            DB::transaction(function () use (
                $siswa,
                $jumlahPoin,
                $jumlahUang,
                $validated
            ) {

                // Kunci data siswa agar tidak terjadi race condition
                $siswa = $siswa->newQuery()
                    ->where('id', $siswa->id)
                    ->lockForUpdate()
                    ->first();

                /*
                |--------------------------------------------------------------
                | CEK SALDO
                |--------------------------------------------------------------
                */

                if ($siswa->saldo_poin < $jumlahPoin) {
                    throw new \Exception(
                        'Saldo poin tidak mencukupi untuk pencairan ini.'
                    );
                }

                /*
                |--------------------------------------------------------------
                | KURANGI SALDO
                |--------------------------------------------------------------
                */

                $siswa->decrement(
                    'saldo_poin',
                    $jumlahPoin
                );

                /*
                |--------------------------------------------------------------
                | BUAT PENGAJUAN
                |--------------------------------------------------------------
                */

                PencairanPoin::create([
                    'siswa_id' => $siswa->id,

                    'jumlah_poin' => $jumlahPoin,

                    'jumlah_uang' => $jumlahUang,

                    'metode' => $validated['metode'],

                    'provider' => $validated['provider'] ?? null,

                    'nama_penerima' => $validated['nama_penerima'],

                    'nomor_tujuan' => $validated['nomor_tujuan'] ?? null,

                    // Karena saldo sudah lolos pengecekan
                    'status' => 'diproses',

                    'tanggal_pengajuan' => now(),
                ]);
            });

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->withErrors([
                    'jumlah_poin' => $e->getMessage()
                ]);
        }

        return redirect()
            ->route('siswa.pencairan.uang')
            ->with(
                'success',
                'Saldo berhasil diverifikasi. Pengajuan pencairan sedang diproses.'
            );
    }

    public function approve(PencairanPoin $pencairan)
    {
        // Pengajuan harus sudah diproses terlebih dahulu
        if ($pencairan->status !== 'diproses') {
            return back()->with(
                'error',
                'Pengajuan pencairan belum dapat disetujui.'
            );
        }

        $pencairan->update([
            'status' => 'disetujui',
            'tanggal_pencairan' => now(),
        ]);

        return back()->with(
            'success',
            'Transfer dana berhasil dikonfirmasi. Pengajuan pencairan telah disetujui.'
        );
    }

    public function reject(Request $request, PencairanPoin $pencairan)
    {
        if (!in_array($pencairan->status, ['menunggu', 'diproses'])) {
            return back()->with(
                'error',
                'Pengajuan ini tidak dapat ditolak.'
            );
        }

        try {
            DB::transaction(function () use ($request, $pencairan) {

                if ($pencairan->status === 'diproses') {

                    $siswa = $pencairan->siswa()
                        ->lockForUpdate()
                        ->first();

                    $siswa->increment(
                        'saldo_poin',
                        $pencairan->jumlah_poin
                    );
                }

                $pencairan->update([
                    'status' => 'ditolak',
                    'catatan' => $request->input('catatan'),
                ]);
            });

        } catch (\Throwable $e) {

            return back()->with(
                'error',
                'Gagal menolak pengajuan pencairan.'
            );
        }

        return back()->with(
            'success',
            'Pengajuan pencairan berhasil ditolak dan saldo poin telah dikembalikan.'
        );
    }

    public function selesai(PencairanPoin $pencairan)
    {
        $siswa = Auth::user()->siswa;

        // Pastikan pengajuan ini milik siswa yang sedang login
        if ($pencairan->siswa_id !== $siswa->id) {
            abort(403, 'Anda tidak memiliki akses ke pengajuan ini.');
        }

        // Hanya pencairan yang sudah disetujui yang dapat diselesaikan
        if ($pencairan->status !== 'disetujui') {
            return back()->with(
                'error',
                'Pengajuan pencairan belum dapat diselesaikan.'
            );
        }

        $pencairan->update([
            'status' => 'selesai',
        ]);

        return back()->with(
            'success',
            'Pencairan dana berhasil dikonfirmasi selesai.'
        );
    }

}