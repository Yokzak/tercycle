@extends('layouts.admin.app')

@section('title', 'Dashboard Admin')

@section('topbar-subtitle', 'Overview')

@section('topbar-title', 'Dashboard')

@section('content')


        {{-- HEADER --}}

        <div class="mb-8">

            <p class="text-sm font-medium text-green-500">
                Tercycle Admin
            </p>

            <h2 class="mt-1 text-2xl font-black sm:text-3xl">
                Selamat datang, Administrator
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                Pantau aktivitas bank sampah dan sistem Tercycle.
            </p>

        </div>



        {{-- ================================================= --}}
        {{-- STATISTICS --}}
        {{-- ================================================= --}}

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">


            {{-- TOTAL SISWA --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm text-gray-500">
                            Total Siswa
                        </p>

                        <p class="mt-2 text-3xl font-black">
                            {{ number_format($totalSiswa, 0, ',', '.') }}
                        </p>

                        <p class="mt-2 text-xs text-green-500">
                        </p>

                    </div>

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 19a6 6 0 0 0-12 0m6-8a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm6-4h3m-1.5-1.5v3"
                            />
                        </svg>
                    </div>

                </div>

            </div>


            {{-- TOTAL BOTOL --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm text-gray-500">
                            Botol Terkumpul
                        </p>

                        <p class="mt-2 text-3xl font-black">
                            {{ number_format($totalBotol, 0, ',', '.') }}
                        </p>

                        <p class="mt-2 text-xs text-green-500">
                            +1.240 bulan ini
                        </p>

                    </div>

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 3h6m-5 0v4.5L6.5 12v5.5A3.5 3.5 0 0 0 10 21h4a3.5 3.5 0 0 0 3.5-3.5V12L14 7.5V3"
                            />
                        </svg>
                    </div>

                </div>

            </div>


            {{-- POIN BEREDAR --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm text-gray-500">
                            Poin Beredar
                        </p>

                        <p class="mt-2 text-3xl font-black">
                            {{ number_format($poinBeredar, 0, ',', '.') }}
                        </p>

                        <p class="mt-2 text-xs text-green-500">
                            +8,4% bulan ini
                        </p>

                    </div>

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500"
                    >
                        <span class="text-lg font-black">
                            P
                        </span>
                    </div>

                </div>

            </div>


            {{-- TRANSAKSI --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm text-gray-500">
                            Transaksi
                        </p>

                        <p class="mt-2 text-3xl font-black">
                            {{ number_format($totalTransaksi, 0, ',', '.') }}
                        </p>

                        <p class="mt-2 text-xs text-green-500">
                            +156 bulan ini
                        </p>

                    </div>

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>
                    </div>

                </div>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- QUICK ACTION --}}
        {{-- ================================================= --}}

        <div class="mt-8">

            <div class="mb-4">

                <h3 class="font-bold">
                    Aksi Cepat
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Akses fitur administrasi yang sering digunakan.
                </p>

            </div>


            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">


                <a
                    href="/admin/penukaran"
                    class="group rounded-2xl border border-gray-200 bg-white p-5 transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
                >

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500 transition group-hover:bg-green-500 group-hover:text-gray-950"
                    >
                        +
                    </div>

                    <h4 class="mt-4 font-bold">
                        Penukaran Botol
                    </h4>

                    <p class="mt-1 text-xs text-gray-500">
                        Input penukaran botol siswa.
                    </p>

                </a>


                <a
                    href="/admin/siswa"
                    class="group rounded-2xl border border-gray-200 bg-white p-5 transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
                >

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500 transition group-hover:bg-green-500 group-hover:text-gray-950"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 19a6 6 0 0 0-12 0m6-8a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm6-4h3m-1.5-1.5v3"
                            />
                        </svg>
                    </div>

                    <h4 class="mt-4 font-bold">
                        Kelola Siswa
                    </h4>

                    <p class="mt-1 text-xs text-gray-500">
                        Lihat dan kelola data siswa.
                    </p>

                </a>


                <a
                    href="/admin/produk"
                    class="group rounded-2xl border border-gray-200 bg-white p-5 transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
                >

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500 transition group-hover:bg-green-500 group-hover:text-gray-950"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.8"
                            stroke="currentColor"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M20 7 12 3 4 7m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                            />
                        </svg>
                    </div>

                    <h4 class="mt-4 font-bold">
                        Kelola Produk
                    </h4>

                    <p class="mt-1 text-xs text-gray-500">
                        Tambah dan kelola produk.
                    </p>

                </a>


                <a
                    href="/admin/transaksi"
                    class="group rounded-2xl border border-gray-200 bg-white p-5 transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
                >

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500 transition group-hover:bg-green-500 group-hover:text-gray-950"
                    >
                        ≡
                    </div>

                    <h4 class="mt-4 font-bold">
                        Lihat Transaksi
                    </h4>

                    <p class="mt-1 text-xs text-gray-500">
                        Pantau seluruh transaksi.
                    </p>

                </a>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- CONTENT GRID --}}
        {{-- ================================================= --}}

        <div class="mt-8 grid gap-8 lg:grid-cols-3">


            {{-- TRANSAKSI TERBARU --}}

            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white lg:col-span-2 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10"
                >

                    <div>

                        <h3 class="font-bold">
                            Transaksi Terbaru
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            Aktivitas terbaru di Tercycle.
                        </p>

                    </div>

                    <a
                        href="/admin/transaksi"
                        class="text-sm font-semibold text-green-500 hover:text-green-400"
                    >
                        Lihat semua
                    </a>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full text-left text-sm">

                        <thead
                            class="border-b border-gray-200 text-xs uppercase text-gray-500 dark:border-white/10"
                        >

                            <tr>

                                <th class="px-6 py-4">
                                    Siswa
                                </th>

                                <th class="px-6 py-4">
                                    Aktivitas
                                </th>

                                <th class="px-6 py-4">
                                    Poin
                                </th>

                                <th class="px-6 py-4">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-200 dark:divide-white/10">
                            @forelse ($transaksiTerbaru as $transaksi)
                                <tr>
                                    <td class="px-6 py-5">
                                        <p class="font-semibold">{{ $transaksi['siswa'] }}</p>
                                        <p class="mt-1 text-xs text-gray-500">#{{ $transaksi['id'] }}</p>
                                    </td>

                                    {{-- AKTIVITAS --}}
                                    <td class="px-6 py-5 text-gray-500">
                                        {{ $transaksi['aktivitas'] }}
                                    </td>


                                    {{-- POIN --}}
                                    <td class="px-6 py-5 font-bold
                                        {{ $transaksi['poin'] >= 0
                                            ? 'text-green-500'
                                            : 'text-red-500'
                                        }}"
                                    >

                                        {{ $transaksi['poin'] >= 0 ? '+' : '' }}
                                        {{ number_format($transaksi['poin'], 0, ',', '.') }}

                                    </td>

                                    {{-- STATUS --}}
            <td class="px-6 py-5">

                @if ($transaksi['status'] === 'selesai')

                    <span
                        class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                    >
                        Berhasil
                    </span>

                @elseif ($transaksi['status'] === 'menunggu')

                    <span
                        class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold text-yellow-600 dark:text-yellow-400"
                    >
                        Menunggu
                    </span>

                @elseif ($transaksi['status'] === 'ditolak')

                    <span
                        class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-500"
                    >
                        Ditolak
                    </span>

                @else

                    <span
                        class="rounded-full bg-gray-500/10 px-3 py-1 text-xs font-semibold text-gray-500"
                    >
                        {{ ucfirst($transaksi['status']) }}
                    </span>

                @endif

            </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-sm text-gray-500">
                                        Belum ada transaksi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>



            {{-- RINGKASAN --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <h3 class="font-bold">
                    Ringkasan Hari Ini
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Statistik aktivitas hari ini.
                </p>


                <div class="mt-6 space-y-5">


                    <div>

                        <div class="flex items-center justify-between">

                            <p class="text-sm text-gray-500">
                                Penukaran Botol
                            </p>

                            <p class="font-bold">
                                {{ number_format($penukaranBotolHariIni, 0, ',', '.') }}
                            </p>

                        </div>

                        <div class="mt-2 h-2 overflow-hidden rounded-full bg-gray-100 dark:bg-white/10">

                            <div
                                class="h-full w-[75%] rounded-full bg-green-500"
                            ></div>

                        </div>

                    </div>


                    <div>

                        <div class="flex items-center justify-between">

                            <p class="text-sm text-gray-500">
                                Poin Diberikan
                            </p>

                            <p class="font-bold">
                                {{ number_format($poinDiberikanHariIni, 0, ',', '.') }}
                            </p>

                        </div>

                        <div class="mt-2 h-2 overflow-hidden rounded-full bg-gray-100 dark:bg-white/10">

                            <div
                                class="h-full w-[65%] rounded-full bg-green-500"
                            ></div>

                        </div>

                    </div>


                    <div>

                        <div class="flex items-center justify-between">

                            <p class="text-sm text-gray-500">
                                Produk Terjual
                            </p>

                            <p class="font-bold">
                                {{ number_format($produkTerjualHariIni, 0, ',', '.') }}
                            </p>

                        </div>

                        <div class="mt-2 h-2 overflow-hidden rounded-full bg-gray-100 dark:bg-white/10">

                            <div
                                class="h-full w-[45%] rounded-full bg-green-500"
                            ></div>

                        </div>

                    </div>


                    <div>

                        <div class="flex items-center justify-between">

                            <p class="text-sm text-gray-500">
                                Siswa Aktif
                            </p>

                            <p class="font-bold">
                                {{ number_format($siswaAktifHariIni, 0, ',', '.') }}
                            </p>

                        </div>

                        <div class="mt-2 h-2 overflow-hidden rounded-full bg-gray-100 dark:bg-white/10">

                            <div
                                class="h-full w-[55%] rounded-full bg-green-500"
                            ></div>

                        </div>

                    </div>

                </div>


                <a
                    href="/admin/transaksi"
                    class="mt-7 block rounded-xl border border-gray-200 px-4 py-3 text-center text-sm font-semibold transition hover:border-green-500 hover:text-green-500 dark:border-white/10"
                >
                    Lihat Semua Aktivitas
                </a>

            </div>

        </div>



    @endsection