@extends('layouts.siswa.app')

@section('title', 'Dashboard Siswa')

@section('topbar-subtitle', 'Overview')

@section('topbar-title', 'Dashboard')

@section('content')
        {{-- HEADER --}}

        <div class="mb-8">

            <p class="text-sm font-medium text-green-500">
                Dashboard Siswa
            </p>

            <h2 class="mt-2 text-3xl font-black">
                Selamat datang, {{ Auth::user()->name }}
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Pantau poin dan aktivitas Tercycle kamu.
            </p>

        </div>



        {{-- ===================================================== --}}
        {{-- SALDO POIN --}}
        {{-- ===================================================== --}}

        <div
            class="relative overflow-hidden rounded-3xl bg-green-500 p-7 text-gray-950 shadow-lg shadow-green-500/10 sm:p-8"
        >

            <div
                class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/10"
            ></div>

            <div
                class="absolute -bottom-24 right-32 h-48 w-48 rounded-full bg-white/10"
            ></div>


            <div class="relative">

                <p class="text-sm font-semibold text-gray-950/70">
                    Saldo Poin Kamu
                </p>

                <div class="mt-2 flex items-end gap-3">

                    <span class="text-4xl font-black sm:text-5xl">
                        {{ number_format($saldoPoin, 0, ',', '.') }}
                    </span>

                    <span class="mb-1.5 font-semibold">
                        poin
                    </span>

                </div>

                <p class="mt-3 text-sm text-gray-950/70">
                    Terakhir diperbarui hari ini
                </p>

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- STATISTIC --}}
        {{-- ===================================================== --}}

        <div class="mt-6 grid gap-4 sm:grid-cols-3">


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-semibold text-gray-500">
                    Total Botol
                </p>

                <p class="mt-2 text-2xl font-black">
                     {{ number_format($totalBotol, 0, ',', '.') }}
                </p>

                <p class="mt-1 text-xs text-green-500">
                    Botol berhasil didaur ulang
                </p>

            </div>



            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-semibold text-gray-500">
                    Poin Didapat
                </p>

                <p class="mt-2 text-2xl font-black">
                    {{ number_format($poinDidapat, 0, ',', '.') }}
                </p>

                <p class="mt-1 text-xs text-green-500">
                    Total poin sepanjang waktu
                </p>

            </div>



            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-semibold text-gray-500">
                    Pesanan
                </p>

                <p class="mt-2 text-2xl font-black">
                    {{ number_format($totalPesanan, 0, ',', '.') }}
                </p>

                <p class="mt-1 text-xs text-gray-500">
                    Total pesanan
                </p>

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- QUICK ACTION --}}
        {{-- ===================================================== --}}

        <div class="mt-8">

            <div class="mb-4">

                <h3 class="font-bold">
                    Aksi Cepat
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Akses fitur Tercycle dengan cepat.
                </p>

            </div>


            <div class="grid gap-4 sm:grid-cols-3">


                <a
                    href="/siswa/tukar"
                    class="group rounded-2xl border border-gray-200 bg-white p-5 transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
                >

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-xl font-bold text-green-500 transition group-hover:bg-green-500 group-hover:text-gray-950"
                    >
                        +
                    </div>

                    <h4 class="mt-4 font-bold">
                        Setor Botol
                    </h4>

                    <p class="mt-1 text-xs text-gray-500">
                        Tukarkan botol menjadi poin.
                    </p>

                </a>



                <a
                    href="/siswa/produk"
                    class="group rounded-2xl border border-gray-200 bg-white p-5 transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
                >

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-xl font-bold text-green-500 transition group-hover:bg-green-500 group-hover:text-gray-950"
                    >
                        $
                    </div>

                    <h4 class="mt-4 font-bold">
                        Belanja Produk
                    </h4>

                    <p class="mt-1 text-xs text-gray-500">
                        Gunakan poin untuk berbelanja.
                    </p>

                </a>



                <a
                    href="/siswa/jual-produk"
                    class="group rounded-2xl border border-gray-200 bg-white p-5 transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
                >

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-xl font-bold text-green-500 transition group-hover:bg-green-500 group-hover:text-gray-950"
                    >
                        ↑
                    </div>

                    <h4 class="mt-4 font-bold">
                        Jual Produk
                    </h4>

                    <p class="mt-1 text-xs text-gray-500">
                        Jual produk melalui Tercycle.
                    </p>

                </a>

            </div>

        </div>



        {{-- ===================================================== --}}
        {{-- QR + AKTIVITAS --}}
        {{-- ===================================================== --}}

        <div class="mt-8 grid gap-6 lg:grid-cols-3">


            {{-- QR --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <h3 class="font-bold">
                            QR Siswa
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            Gunakan saat setor botol.
                        </p>

                    </div>

                    <span
                        class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                    >
                        Aktif
                    </span>

                </div>


                <div
                    class="mx-auto mt-6 flex h-44 w-44 items-center justify-center rounded-2xl border border-gray-200 bg-white p-4 dark:border-white/10"
                >

                    {!! $qr !!}

                </div>


                <div class="mt-5 text-center">

                    <p class="text-xs text-gray-500">
                        Kode unik
                    </p>

                    <p
                        class="mt-1 font-mono text-sm font-black tracking-wider"
                    >
                        {{ $user->siswa->kode_siswa }}
                    </p>

                </div>

            </div>



            {{-- AKTIVITAS --}}

            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white lg:col-span-2 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10"
                >

                    <div>

                        <h3 class="font-bold">
                            Aktivitas Terbaru
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            Pergerakan poin kamu.
                        </p>

                    </div>

                    <a
                        href="/siswa/poin"
                        class="text-xs font-semibold text-green-500 hover:text-green-400"
                    >
                        Lihat semua
                    </a>

                </div>
                <div class="divide-y divide-gray-200 dark:divide-white/10">

                    @forelse ($riwayatPoins as $riwayat)

                        <div class="flex items-center justify-between px-6 py-5">

                            <div class="flex items-center gap-4">

                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-xl
                                    {{ $riwayat->tipe === 'masuk'
                                        ? 'bg-green-500/10 text-green-500'
                                        : 'bg-red-500/10 text-red-500' }}
                                    font-bold"
                                >
                                    {{ $riwayat->tipe === 'masuk' ? '+' : '-' }}
                                </div>

                                <div>

                                    <p class="text-sm font-semibold">
                                        {{ $riwayat->keterangan }}
                                    </p>

                                    <p class="mt-1 text-xs text-gray-500">
                                        {{ $riwayat->created_at->diffForHumans() }}
                                    </p>

                                </div>

                            </div>

                            <p
                                class="font-bold
                                {{ $riwayat->tipe === 'masuk'
                                    ? 'text-green-500'
                                    : 'text-red-500' }}"
                            >
                                {{ $riwayat->tipe === 'masuk' ? '+' : '-' }}
                                {{ number_format($riwayat->jumlah_poin, 0, ',', '.') }}
                            </p>

                        </div>

                    @empty

                        <div class="px-6 py-8 text-center">

                            <p class="text-sm text-gray-500">
                                Belum ada aktivitas poin.
                            </p>

                        </div>

                    @endforelse

                </div>
            </div>
        </div>



        {{-- ===================================================== --}}
        {{-- PESANAN --}}
        {{-- ===================================================== --}}

        <div
            class="mt-6 overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
        >

            <div
                class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10"
            >

                <div>

                    <h3 class="font-bold">
                        Pesanan Terbaru
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Status pesanan kamu.
                    </p>

                </div>

                <a
                    href="/siswa/pesanan"
                    class="text-xs font-semibold text-green-500 hover:text-green-400"
                >
                    Lihat semua
                </a>

            </div>


            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-gray-200 text-xs uppercase text-gray-500 dark:border-white/10">
                        <tr>
                            <th class="px-6 py-4">Pesanan</th>
                            <th class="px-6 py-4">Produk</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-white/10">
                        @forelse ($pesananTerbaru as $pesanan)
                            <tr>
                                <td class="px-6 py-5 font-semibold">
                                    #{{ $pesanan->id }}
                                </td>

                                <td class="px-6 py-5 text-gray-500">
                                    @if ($pesanan->detailPesanan->count() > 0)
                                        {{ $pesanan->detailPesanan->first()->nama_produk }}
                                        @if ($pesanan->detailPesanan->count() > 1)
                                            +{{ $pesanan->detailPesanan->count() - 1 }} produk
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="px-6 py-5 font-semibold">
                                    {{ number_format($pesanan->total_poin, 0, ',', '.') }} poin
                                </td>

                                <td class="px-6 py-5">
                                    @if ($pesanan->status === 'menunggu')
                                        <span class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold text-yellow-600 dark:text-yellow-400">Menunggu</span>
                                    @elseif ($pesanan->status === 'diproses')
                                        <span class="rounded-full bg-blue-500/10 px-3 py-1 text-xs font-semibold text-blue-600 dark:text-blue-400">Diproses</span>
                                    @elseif ($pesanan->status === 'selesai')
                                        <span class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-600 dark:text-green-400">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                                    Belum ada pesanan.
                                </td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>

@endsection