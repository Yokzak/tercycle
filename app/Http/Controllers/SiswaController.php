<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPoin;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Pesanan;
use App\Models\PenukaranBotol;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SiswaController extends Controller
{


    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $siswa = $user->siswa;

        if (!$siswa) {
            abort(404, 'Data siswa untuk akun ini belum tersedia.');
        }

        $riwayatPoins = RiwayatPoin::where('siswa_id', $siswa->id)
            ->latest()
            ->get();

        return view('siswa.dashboard', compact(
            'siswa',
            'riwayatPoins'
        ));
    }
    
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

    public function poin(Request $request)
    {
        $siswa = $request->user()->siswa;

        $query = RiwayatPoin::where('siswa_id', $siswa->id)
            ->latest();

        $totalDidapatBulanIni = RiwayatPoin::where('siswa_id', $siswa->id)
            ->where('tipe', 'masuk')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('jumlah_poin');

        // FILTER
        if ($request->filter === 'masuk') {
            $query->where('tipe', 'masuk');
        }

        if ($request->filter === 'keluar') {
            $query->where('tipe', 'keluar');
        }

        // PAGINATION
        $riwayatPoins = $query->paginate(5)->withQueryString();

        // Statistik
        $totalDidapat = RiwayatPoin::where('siswa_id', $siswa->id)
            ->where('tipe', 'masuk')
            ->sum('jumlah_poin');

        return view('siswa.poin', compact(
            'siswa',
            'riwayatPoins',
            'totalDidapat',
            'totalDidapatBulanIni'
        ));
    }

    public function dashboard(Request $request)
    {
        $user = $request->user()->load(['siswa.jurusan']);

        $siswa = $user->siswa;

        if (!$siswa) {
            abort(404, 'Data siswa untuk akun ini belum tersedia.');
        }

        $saldoPoin = $siswa->saldo_poin;

        $totalBotol = DB::table('detail_penukaran')
            ->join(
                'penukaran_botol',
                'detail_penukaran.penukaran_id',
                '=',
                'penukaran_botol.id'
            )
            ->where('penukaran_botol.siswa_id', $siswa->id)
            ->where('penukaran_botol.status', 'disetujui')
            ->sum('detail_penukaran.jumlah_botol');

        $poinDidapat = RiwayatPoin::where('siswa_id', $siswa->id)
            ->where('tipe', 'masuk')
            ->sum('jumlah_poin');

        $totalPesanan = Pesanan::where('pembeli_id', $siswa->id)
            ->count();

        // qr siswa
        $qr = QrCode::size(300)
            ->generate($siswa->kode_siswa);

        // Aktivitas poin terbaru
        $riwayatPoins = RiwayatPoin::where('siswa_id', $siswa->id)
            ->latest()
            ->take(3)
            ->get();

        // Pesanan terbaru
        $pesananTerbaru = Pesanan::where('pembeli_id', $siswa->id)
            ->with('detailPesanan')
            ->latest('tanggal')
            ->take(3)
            ->get();

        return view('siswa.dashboard', compact(
            'user',
            'siswa',
            'qr',
            'riwayatPoins',
            'pesananTerbaru',
            'saldoPoin',
            'totalBotol',
            'poinDidapat',
            'totalPesanan'
        ));
    }

    public function pesanan(Request $request)
    {
        $siswa = $request->user()->siswa;

        if (!$siswa) {
            abort(404, 'Data siswa untuk akun ini belum tersedia.');
        }

        $pesanans = Pesanan::with('detailPesanan')
            ->where('pembeli_id', $siswa->id)
            ->latest('tanggal')
            ->get();

        return view('siswa.pesanan', compact('siswa', 'pesanans'));
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
            'jurusan_id' => 'required|exists:jurusan,id',
        ]);

        $siswa->update($validated);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }
}