@extends('layouts.admin.app')

@section('title', 'Riwayat Transaksi')

@section('topbar-subtitle', 'Transaksi')

@section('topbar-title', 'Riwayat Transaksi')

@section('content')


        {{-- HEADER --}}

        <div>

            <h2 class="text-2xl font-black">
                Riwayat Transaksi
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Pantau seluruh aktivitas poin dan pembelian siswa.
            </p>

        </div>



        {{-- STATISTICS --}}

        <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Total Transaksi
                </p>

                <p class="mt-2 text-3xl font-black">
                    1.284
                </p>

                <p class="mt-2 text-xs text-green-500">
                    +14,2% bulan ini
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Poin Masuk
                </p>

                <p class="mt-2 text-3xl font-black text-green-500">
                    +245.800
                </p>

                <p class="mt-2 text-xs text-gray-500">
                    Dari penukaran botol
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Poin Keluar
                </p>

                <p class="mt-2 text-3xl font-black">
                    -82.450
                </p>

                <p class="mt-2 text-xs text-gray-500">
                    Dari pembelian produk
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Transaksi Hari Ini
                </p>

                <p class="mt-2 text-3xl font-black">
                    47
                </p>

                <p class="mt-2 text-xs text-green-500">
                    Aktivitas normal
                </p>

            </div>

        </div>



        {{-- TRANSACTION TABLE --}}

        <div
            class="mt-8 overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
        >


            {{-- FILTER --}}

            <div
                class="flex flex-col gap-4 border-b border-gray-200 p-6 dark:border-white/10 lg:flex-row lg:items-center lg:justify-between"
            >

                <div>

                    <h3 class="font-bold">
                        Semua Transaksi
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Riwayat aktivitas terbaru.
                    </p>

                </div>


                <div class="flex flex-col gap-3 sm:flex-row">


                    {{-- SEARCH --}}

                    <div class="relative">

                        <input
                            type="text"
                            placeholder="Cari transaksi..."
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 pl-10 text-sm outline-none focus:border-green-500 sm:w-60 dark:border-white/10 dark:bg-gray-900"
                        >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="absolute left-3 top-3 h-4 w-4 text-gray-400"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                            />

                        </svg>

                    </div>


                    {{-- TYPE --}}

                    <select
                        class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm outline-none focus:border-green-500 dark:border-white/10 dark:bg-gray-900"
                    >

                        <option>
                            Semua Transaksi
                        </option>

                        <option>
                            Penukaran Botol
                        </option>

                        <option>
                            Pembelian Produk
                        </option>

                    </select>


                    {{-- STATUS --}}

                    <select
                        class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm outline-none focus:border-green-500 dark:border-white/10 dark:bg-gray-900"
                    >

                        <option>
                            Semua Status
                        </option>

                        <option>
                            Berhasil
                        </option>

                        <option>
                            Menunggu
                        </option>

                        <option>
                            Dibatalkan
                        </option>

                    </select>

                </div>

            </div>



            {{-- TABLE --}}

            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead
                        class="border-b border-gray-200 text-xs uppercase text-gray-500 dark:border-white/10"
                    >

                        <tr>

                            <th class="px-6 py-4">
                                ID Transaksi
                            </th>

                            <th class="px-6 py-4">
                                Siswa
                            </th>

                            <th class="px-6 py-4">
                                Jenis
                            </th>

                            <th class="px-6 py-4">
                                Detail
                            </th>

                            <th class="px-6 py-4">
                                Poin
                            </th>

                            <th class="px-6 py-4">
                                Status
                            </th>

                            <th class="px-6 py-4">
                                Waktu
                            </th>

                        </tr>

                    </thead>



                    <tbody
                        class="divide-y divide-gray-200 dark:divide-white/10"
                    >


                        {{-- TRANSACTION 1 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <span class="font-mono text-xs font-semibold">
                                    TRX-001284
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-9 w-9 items-center justify-center rounded-full bg-green-500 font-bold text-gray-950"
                                    >
                                        K
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Kevin
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            ECO-2026-00125
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Penukaran
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <p class="font-medium">
                                    Botol Plastik
                                </p>

                                <p class="text-xs text-gray-500">
                                    25 botol
                                </p>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="font-bold text-green-500"
                                >
                                    +1.250
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Berhasil
                                </span>

                            </td>


                            <td class="whitespace-nowrap px-6 py-5">

                                <p class="text-xs font-medium">
                                    10 Agu 2026
                                </p>

                                <p class="text-xs text-gray-500">
                                    14:32
                                </p>

                            </td>

                        </tr>



                        {{-- TRANSACTION 2 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <span class="font-mono text-xs font-semibold">
                                    TRX-001283
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-900 font-bold text-white dark:bg-white dark:text-gray-950"
                                    >
                                        I
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Ilyas
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            ECO-2026-00118
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-blue-500/10 px-3 py-1 text-xs font-semibold text-blue-500"
                                >
                                    Pembelian
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <p class="font-medium">
                                    Tumbler Recycle
                                </p>

                                <p class="text-xs text-gray-500">
                                    1 produk
                                </p>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="font-bold text-red-500"
                                >
                                    -5.000
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Berhasil
                                </span>

                            </td>


                            <td class="whitespace-nowrap px-6 py-5">

                                <p class="text-xs font-medium">
                                    10 Agu 2026
                                </p>

                                <p class="text-xs text-gray-500">
                                    13:57
                                </p>

                            </td>

                        </tr>



                        {{-- TRANSACTION 3 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <span class="font-mono text-xs font-semibold">
                                    TRX-001282
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-9 w-9 items-center justify-center rounded-full bg-green-500 font-bold text-gray-950"
                                    >
                                        A
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Arya
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            ECO-2026-00109
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Penukaran
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <p class="font-medium">
                                    Botol Kaca
                                </p>

                                <p class="text-xs text-gray-500">
                                    10 botol
                                </p>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="font-bold text-green-500"
                                >
                                    +1.000
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold text-yellow-500"
                                >
                                    Menunggu
                                </span>

                            </td>


                            <td class="whitespace-nowrap px-6 py-5">

                                <p class="text-xs font-medium">
                                    10 Agu 2026
                                </p>

                                <p class="text-xs text-gray-500">
                                    13:21
                                </p>

                            </td>

                        </tr>



                        {{-- TRANSACTION 4 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <span class="font-mono text-xs font-semibold">
                                    TRX-001281
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-900 font-bold text-white dark:bg-white dark:text-gray-950"
                                    >
                                        W
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Wandi
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            ECO-2026-00097
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-blue-500/10 px-3 py-1 text-xs font-semibold text-blue-500"
                                >
                                    Pembelian
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <p class="font-medium">
                                    Tote Bag Recycle
                                </p>

                                <p class="text-xs text-gray-500">
                                    1 produk
                                </p>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="font-bold text-red-500"
                                >
                                    -3.500
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-500"
                                >
                                    Dibatalkan
                                </span>

                            </td>


                            <td class="whitespace-nowrap px-6 py-5">

                                <p class="text-xs font-medium">
                                    10 Agu 2026
                                </p>

                                <p class="text-xs text-gray-500">
                                    12:48
                                </p>

                            </td>

                        </tr>



                        {{-- TRANSACTION 5 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <span class="font-mono text-xs font-semibold">
                                    TRX-001280
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-900 font-bold text-white dark:bg-white dark:text-gray-950"
                                    >
                                        O
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Omar
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            ECO-2026-00081
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Penukaran
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <p class="font-medium">
                                    Botol Plastik
                                </p>

                                <p class="text-xs text-gray-500">
                                    15 botol
                                </p>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="font-bold text-green-500"
                                >
                                    +750
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Berhasil
                                </span>

                            </td>


                            <td class="whitespace-nowrap px-6 py-5">

                                <p class="text-xs font-medium">
                                    10 Agu 2026
                                </p>

                                <p class="text-xs text-gray-500">
                                    11:26
                                </p>

                            </td>

                        </tr>


                    </tbody>

                </table>

            </div>



            {{-- PAGINATION --}}

            <div
                class="flex flex-col gap-4 border-t border-gray-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between dark:border-white/10"
            >

                <p class="text-xs text-gray-500">
                    Menampilkan 1-5 dari 1.284 transaksi
                </p>


                <div class="flex gap-2">

                    <button
                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs text-gray-400 dark:border-white/10"
                    >
                        Sebelumnya
                    </button>

                    <button
                        class="rounded-lg bg-green-500 px-3 py-2 text-xs font-bold text-gray-950"
                    >
                        1
                    </button>

                    <button
                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold dark:border-white/10"
                    >
                        2
                    </button>

                    <button
                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold dark:border-white/10"
                    >
                        3
                    </button>

                    <button
                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold dark:border-white/10"
                    >
                        Selanjutnya
                    </button>

                </div>

            </div>

        </div>

    @endsection