<?php

namespace App\Http\Controllers;

use App\Models\PenukaranBotol;
use App\Models\KategoriBotol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenukaranBotolController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $kategoriBotol = KategoriBotol::all();

        return view('siswa.tukar', compact('kategoriBotol'));
    }

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

            foreach ($data['botol'] as $item) {

                $kategori = KategoriBotol::findOrFail(
                    $item['kategori_botol_id']
                );

                $subtotal = $item['jumlah_botol']
                    * $kategori->poin_satuan;

                $totalPoin += $subtotal;
            }

            $penukaran = PenukaranBotol::create([
                'siswa_id' => $siswa->id,
                'admin_id' => null,
                'total_poin' => $totalPoin,
                'status' => 'menunggu',
                'tanggal' => now(),
            ]);

            foreach ($data['botol'] as $item) {

                $kategori = KategoriBotol::findOrFail(
                    $item['kategori_botol_id']
                );

                $subtotal = $item['jumlah_botol']
                    * $kategori->poin_satuan;

                $penukaran->detailPenukaran()->create([
                    'kategori_botol_id' => $kategori->id,
                    'jumlah_botol' => $item['jumlah_botol'],
                    'poin_satuan' => $kategori->poin_satuan,
                    'subtotal_poin' => $subtotal,
                ]);
            }
        });

        return redirect()
            ->route('siswa.tukar')
            ->with(
                'success',
                'Pengajuan penukaran terkirim! Silakan taruh botolmu di bank sampah sekolah.'
            );
    }
}