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
     * Menampilkan halaman penukaran botol admin.
     *
     * Menampilkan:
     * - Pengajuan online yang masih menunggu persetujuan
     * - Riwayat seluruh penukaran
     * - Kategori botol untuk penukaran offline
     */
    public function index(Request $request)
    {
        // Ambil pengajuan online yang masih menunggu persetujuan admin.
        // Admin dapat mencari berdasarkan nama atau kode siswa.
        $pengajuan = PenukaranBotol::with([
            'siswa',
            'detailPenukaran.kategoriBotol',
        ])
            ->where('status', 'menunggu')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->whereHas('siswa', function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('kode_siswa', 'like', "%{$search}%");
                });
            })
            ->latest('tanggal')
            ->paginate(10)
            ->withQueryString();

        // Ambil seluruh riwayat penukaran botol.
        $riwayat = PenukaranBotol::with([
            'siswa',
            'admin',
            'detailPenukaran.kategoriBotol',
        ])
            ->latest('tanggal')
            ->get();

        // Ambil seluruh kategori botol untuk input penukaran offline.
        $kategoriBotol = KategoriBotol::orderBy('nama_kategori')->get();

        return view('admin.penukaran', compact(
            'pengajuan',
            'riwayat',
            'kategoriBotol'
        ));
    }

    /**
     * Mencari siswa untuk melakukan penukaran botol secara offline.
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
     * Menampilkan halaman penukaran botol untuk siswa.
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
     * Menyimpan pengajuan penukaran botol dari siswa.
     *
     * Pengajuan dibuat dengan status "menunggu"
     * dan belum menambahkan poin ke saldo siswa.
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
     * Menyimpan penukaran botol yang dilakukan secara offline oleh admin.
     *
     * Penukaran offline langsung disetujui dan poin
     * langsung ditambahkan ke saldo siswa.
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
     * Menyetujui pengajuan penukaran botol dari siswa.
     *
     * Setelah disetujui:
     * - Status pengajuan menjadi "disetujui"
     * - Admin dicatat sebagai pemroses
     * - Poin ditambahkan ke saldo siswa
     * - Transaksi poin dicatat ke riwayat
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
     * Menolak pengajuan penukaran botol dari siswa.
     *
     * Pengajuan yang ditolak tidak menambahkan poin
     * ke saldo siswa.
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