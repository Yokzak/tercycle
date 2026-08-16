<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\PenukaranBotol;
use App\Models\KategoriBotol;
use Illuminate\Http\Request;
use App\Models\RiwayatPoin;
use Illuminate\Support\Facades\DB;

class PenukaranBotolController extends Controller
{
    /**
     * Halaman penukaran admin
     */
    public function index(Request $request)
    {
        // Pengajuan online yang masih menunggu persetujuan
        $pengajuan = PenukaranBotol::with([
            'siswa',
            'detailPenukaran.kategoriBotol',
        ])
            ->where('status', 'menunggu')
            ->latest('tanggal')
            ->get();

        // Riwayat penukaran
        $riwayat = PenukaranBotol::with([
            'siswa',
            'admin',
            'detailPenukaran.kategoriBotol',
        ])
            ->latest('tanggal')
            ->get();

        // Jenis botol untuk input offline
        $kategoriBotol = KategoriBotol::orderBy('nama_kategori')->get();

        return view('admin.penukaran', compact(
            'pengajuan',
            'riwayat',
            'kategoriBotol'
        ));
    }

    /**
     * Cari siswa untuk penukaran offline
     */
    public function cariSiswa(Request $request)
    {
        $request->validate([
            'keyword' => [
                'required',
                'string',
            ],
        ]);

        $keyword = $request->keyword;

        $siswa = Siswa::where('kode_siswa', $keyword)
            ->orWhere('nama_lengkap', 'like', "%{$keyword}%")
            ->first();

        if (!$siswa) {
            return back()
                ->withInput()
                ->with('error', 'Siswa tidak ditemukan.');
        }

        return back()
            ->with('siswa', $siswa);
    }

    /**
     * Form penukaran botol siswa
     */
    public function create()
    {
        $kategoriBotol = KategoriBotol::orderBy('id')->get();
        $siswa = request()->user()->siswa;

        $pengajuan = PenukaranBotol::with([
            'detailPenukaran.kategoriBotol'
        ])
        ->where('siswa_id', $siswa->id)
        ->latest()
        ->get();

        return view('siswa.tukar', compact('kategoriBotol','pengajuan'));
    }

    /**
     * Siswa mengajukan penukaran secara online
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'botol' => ['required', 'array', 'min:1'],

            'botol.*.kategori_botol_id' => [
                'required',
                'exists:kategori_botol,id',
            ],

            'botol.*.jumlah_botol' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        $siswa = $request->user()->siswa;

        DB::transaction(function () use ($data, $siswa) {

            $totalPoin = 0;

            $penukaran = PenukaranBotol::create([
                'siswa_id' => $siswa->id,
                'admin_id' => null,
                'total_poin' => 0,
                'status' => 'menunggu',
                'tanggal' => now(),
            ]);

            foreach ($data['botol'] as $item) {

                $kategori = KategoriBotol::findOrFail(
                    $item['kategori_botol_id']
                );

                $subtotal = $item['jumlah_botol']
                    * $kategori->poin_satuan;

                $totalPoin += $subtotal;

                $penukaran->detailPenukaran()->create([
                    'penukaran_id' => $penukaran->id,
                    'kategori_botol_id' => $kategori->id,
                    'jumlah_botol' => $item['jumlah_botol'],
                    'poin_satuan' => $kategori->poin_satuan,
                    'subtotal_poin' => $subtotal,
                ]);
            }

            $penukaran->update([
                'total_poin' => $totalPoin,
            ]);
        });

        return redirect()
            ->route('siswa.tukar')
            ->with(
                'success',
                'Pengajuan penukaran terkirim! Silakan taruh botolmu di bank sampah sekolah.'
            );
    }

    /**
     * Admin membuat penukaran secara offline
     */
    public function storeOffline(Request $request)
    {
        $data = $request->validate([
            'siswa_id' => [
                'required',
                'exists:siswa,id',
            ],

            'botol' => [
                'required',
                'array',
                'min:1',
            ],

            'botol.*.kategori_botol_id' => [
                'required',
                'exists:kategori_botol,id',
            ],

            'botol.*.jumlah_botol' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        $admin = $request->user();

        DB::transaction(function () use ($data, $admin) {

            $siswa = Siswa::findOrFail($data['siswa_id']);

            $totalPoin = 0;
            $detail = [];

            foreach ($data['botol'] as $item) {

                $kategori = KategoriBotol::findOrFail(
                    $item['kategori_botol_id']
                );

                $subtotal = $item['jumlah_botol']
                    * $kategori->poin_satuan;

                $totalPoin += $subtotal;

                $detail[] = [
                    'kategori_botol_id' => $kategori->id,
                    'jumlah_botol' => $item['jumlah_botol'],
                    'poin_satuan' => $kategori->poin_satuan,
                    'subtotal_poin' => $subtotal,
                ];
            }

            $penukaran = PenukaranBotol::create([
                'siswa_id' => $siswa->id,
                'admin_id' => $admin->id,
                'total_poin' => $totalPoin,

                // Offline langsung disetujui
                'status' => 'disetujui',

                'tanggal' => now(),
            ]);

            foreach ($detail as $item) {
                $penukaran->detailPenukaran()->create($item);
            }

            // Tambahkan poin siswa
            $siswa->increment('saldo_poin', $totalPoin);

            RiwayatPoin::create([
                'siswa_id' => $siswa->id,
                'tipe' => 'masuk',
                'jumlah_poin' => $totalPoin,
                'keterangan' => 'Penukaran botol offline',
            ]);
        });

        return redirect()
            ->route('admin.penukaran')
            ->with(
                'success',
                'Penukaran offline berhasil dicatat dan poin siswa telah ditambahkan.'
            );
    }

    /**
     * Admin menyetujui pengajuan online
     */
    public function setujui(Request $request, PenukaranBotol $penukaran)
    {
        DB::transaction(function () use ($request, $penukaran) {

            // Pastikan hanya pengajuan yang menunggu
            if ($penukaran->status !== 'menunggu') {
                abort(400, 'Pengajuan ini sudah diproses.');
            }

            $siswa = Siswa::findOrFail($penukaran->siswa_id);

            $penukaran->update([
                'admin_id' => $request->user()->id,
                'status' => 'disetujui',
            ]);

            // Tambahkan poin ke saldo siswa
            $siswa->increment(
                'saldo_poin',
                $penukaran->total_poin
            );

            // Simpan ke riwayat poin
            RiwayatPoin::create([
                'siswa_id' => $siswa->id,
                'tipe' => 'masuk',
                'jumlah_poin' => $penukaran->total_poin,
                'keterangan' => 'Penukaran botol',
            ]);
        });

        return redirect()
            ->route('admin.penukaran')
            ->with(
                'success',
                'Pengajuan penukaran berhasil disetujui.'
            );
    }

    /**
     * Admin menolak pengajuan online
     */
    public function tolak(Request $request, PenukaranBotol $penukaran) 
    {
        if ($penukaran->status !== 'menunggu') {
            return back()->with(
                'error',
                'Pengajuan ini sudah diproses.'
            );
        }

        $penukaran->update([
            'admin_id' => $request->user()->id,
            'status' => 'ditolak',
        ]);

        return back()->with(
            'success',
            'Pengajuan penukaran berhasil ditolak.'
        );
    }

}