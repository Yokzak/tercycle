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

    public function indexAdmin()
    {
        $pencairan = PencairanPoin::with('siswa')
            ->latest('tanggal_pengajuan')
            ->paginate(10);

        return view('admin.pencairan-uang', compact('pencairan'));
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
                'min:100',
            ],

            'metode' => [
                'required',
                'in:cash,e-wallet,bank',
            ],

            'provider' => [
                'nullable',
                'string',
                'max:255',
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

        if (
            in_array($validated['metode'], ['e-wallet', 'bank'])
        ) {
            if (
                empty($validated['provider']) ||
                empty($validated['nomor_tujuan'])
            ) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'nomor_tujuan' =>
                            'Provider dan nomor tujuan wajib diisi.'
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
            'Pencairan berhasil disetujui. Silakan pastikan dana sudah ditransfer ke siswa.'
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

        DB::transaction(function () use ($request, $pencairan) {

            // Kalau sudah diproses, saldo sudah dikurangi.
            // Karena ditolak, saldo harus dikembalikan.
            if ($pencairan->status === 'diproses') {
                $pencairan->siswa->increment(
                    'saldo_poin',
                    $pencairan->jumlah_poin
                );
            }

            $pencairan->update([
                'status' => 'ditolak',
                'catatan' => $request->input('catatan'),
            ]);
        });

        return back()->with(
            'success',
            'Pengajuan pencairan berhasil ditolak.'
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