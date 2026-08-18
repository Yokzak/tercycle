@extends('layouts.admin.app')

@section('title', 'Riwayat Transaksi')

@section('topbar-subtitle', 'Transaksi')

@section('topbar-title', 'Riwayat Transaksi')

@section('content')

<div
    x-data="transaksiFilter()"
    class="relative"
>

{{-- =========================================================
    HEADER
========================================================== --}}

<div>
    <h2 class="text-2xl font-black">
        Riwayat Transaksi
    </h2>

    <p class="mt-1 text-sm text-gray-500">
        Pantau seluruh aktivitas poin dan pembelian siswa.
    </p>
</div>


{{-- =========================================================
    TRANSACTION CARD
========================================================== --}}

<div
    class="mt-8 overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
>

    {{-- =====================================================
        TOOLBAR
    ====================================================== --}}

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
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 pl-10 text-sm outline-none transition focus:border-green-500 dark:border-white/10 dark:bg-gray-900 sm:w-60"
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


            {{-- FILTER BUTTON --}}

            <button
                type="button"
                @click="showFilter = true"
                class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm font-semibold transition hover:border-green-500 hover:text-green-500 dark:border-white/10 dark:bg-gray-900"
            >
                Filter
            </button>

        </div>

    </div>


    {{-- =====================================================
        TABLE
    ====================================================== --}}

    <div class="overflow-x-auto">

        <table class="w-full text-left text-sm">

            {{-- TABLE HEADER --}}

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

                    <th class="px-6 py-4 text-right">
                        Aksi
                    </th>

                </tr>
            </thead>


            {{-- TABLE BODY --}}

            <tbody
                class="divide-y divide-gray-200 dark:divide-white/10"
            >

                @forelse ($transaksi as $item)

                    {{-- =================================================
                        MAIN ROW
                    ================================================== --}}

                    <tr
                        class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                    >

                        {{-- ID --}}

                        <td class="px-6 py-5">

                            <span class="font-mono text-xs font-semibold">
                                {{ $item['id'] }}
                            </span>

                        </td>


                        {{-- SISWA --}}

                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-500 font-bold text-gray-950"
                                >
                                    {{ strtoupper(substr($item['siswa']->nama_lengkap ?? 'U', 0, 1)) }}
                                </div>

                                <div>

                                    <p class="font-semibold">
                                        {{ $item['siswa']->nama_lengkap ?? 'Tidak diketahui' }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $item['siswa']->kode_siswa ?? '-' }}
                                    </p>

                                </div>

                            </div>

                        </td>


                        {{-- JENIS --}}

                        <td class="px-6 py-5">

                            @if ($item['jenis'] === 'penukaran')

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Penukaran
                                </span>

                            @elseif ($item['jenis'] === 'pembelian')

                                <span
                                    class="rounded-full bg-blue-500/10 px-3 py-1 text-xs font-semibold text-blue-500"
                                >
                                    Pembelian
                                </span>

                            @else

                                <span
                                    class="rounded-full bg-purple-500/10 px-3 py-1 text-xs font-semibold text-purple-500"
                                >
                                    Penjualan
                                </span>

                            @endif

                        </td>


                        {{-- RINGKASAN --}}

                        <td class="px-6 py-5">

                            <p class="font-medium">
                                {{ $item['ringkasan'] }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ $item['jumlah'] }}
                                {{ $item['jenis'] === 'penukaran' ? 'botol' : 'produk' }}
                            </p>

                        </td>


                        {{-- POIN --}}

                        <td class="px-6 py-5">

                            <span
                                class="font-bold
                                {{ $item['jenis'] === 'pembelian'
                                    ? 'text-red-500'
                                    : 'text-green-500' }}"
                            >

                                {{ $item['jenis'] === 'pembelian' ? '-' : '+' }}{{ number_format($item['poin'], 0, ',', '.') }}

                            </span>

                        </td>


                        {{-- STATUS --}}

                        <td class="px-6 py-5">

                            @php
                                $status = strtolower($item['status']);

                                $statusClass = match ($status) {
                                    'menunggu' =>
                                        'bg-yellow-500/10 text-yellow-500',

                                    'disetujui',
                                    'diproses' =>
                                        'bg-blue-500/10 text-blue-500',

                                    'ditolak',
                                    'dibatalkan' =>
                                        'bg-red-500/10 text-red-500',

                                    'selesai' =>
                                        'bg-green-500/10 text-green-500',

                                    default =>
                                        'bg-gray-500/10 text-gray-500',
                                };

                                $statusLabel = match ($status) {
                                    'menunggu' => 'Menunggu',
                                    'disetujui' => 'Disetujui',
                                    'ditolak' => 'Ditolak',
                                    'diproses' => 'Diproses',
                                    'selesai' => 'Selesai',
                                    'dibatalkan' => 'Dibatalkan',
                                    default => ucfirst($item['status']),
                                };
                            @endphp

                            <span
                                class="rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass }}"
                            >
                                {{ $statusLabel }}
                            </span>

                        </td>


                        {{-- WAKTU --}}

                        <td class="whitespace-nowrap px-6 py-5">

                            <p class="text-xs font-medium">
                                {{ \Carbon\Carbon::parse($item['tanggal'])->format('d M Y') }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($item['tanggal'])->format('H:i') }}
                            </p>

                        </td>


                        {{-- ACTION --}}

                        <td class="px-6 py-5 text-right">

                            <button
                                type="button"
                                @click="toggleDetail('{{ $item['id'] }}')"
                                class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold transition hover:border-green-500 hover:text-green-500 dark:border-white/10"
                            >

                                <span
                                    x-text="openDetail === '{{ $item['id'] }}' ? 'Tutup' : 'Detail'"
                                >
                                    Detail
                                </span>

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    class="h-4 w-4 transition-transform"
                                    :class="openDetail === '{{ $item['id'] }}' ? 'rotate-180' : ''"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m19 9-7 7-7-7"
                                    />
                                </svg>

                            </button>

                        </td>

                    </tr>


                    {{-- =================================================
                        DETAIL ROW
                    ================================================== --}}

                    <tr
                        x-show="openDetail === '{{ $item['id'] }}'"
                        x-transition
                        x-cloak
                        class="bg-gray-50 dark:bg-white/[0.02]"
                    >

                        <td
                            colspan="8"
                            class="px-6 py-6"
                        >

                            <div class="rounded-xl border border-gray-200 bg-white dark:border-white/10 dark:bg-gray-900">

                                {{-- DETAIL HEADER --}}

                                <div
                                    class="flex flex-col gap-2 border-b border-gray-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between dark:border-white/10"
                                >

                                    <div>

                                        <h4 class="font-bold">
                                            Detail Transaksi
                                        </h4>

                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $item['id'] }}
                                        </p>

                                    </div>

                                    <div class="text-sm">

                                        <span class="text-gray-500">
                                            Total:
                                        </span>

                                        <span
                                            class="ml-1 font-bold
                                            {{ $item['jenis'] === 'pembelian'
                                                ? 'text-red-500'
                                                : 'text-green-500' }}"
                                        >
                                            {{ $item['jenis'] === 'pembelian' ? '-' : '+' }}{{ number_format($item['poin'], 0, ',', '.') }}
                                            poin
                                        </span>

                                    </div>

                                </div>


                                {{-- =================================================
                                    DETAIL PENUKARAN
                                ================================================== --}}

                                @if ($item['jenis'] === 'penukaran')

                                    <div class="overflow-x-auto">

                                        <table class="w-full text-left text-sm">

                                            <thead class="text-xs uppercase text-gray-500">

                                                <tr>

                                                    <th class="px-5 py-3">
                                                        Kategori Botol
                                                    </th>

                                                    <th class="px-5 py-3">
                                                        Jumlah
                                                    </th>

                                                    <th class="px-5 py-3">
                                                        Poin
                                                    </th>

                                                </tr>

                                            </thead>

                                            <tbody
                                                class="divide-y divide-gray-200 dark:divide-white/10"
                                            >

                                                @forelse ($item['detail'] as $detail)

                                                    <tr>

                                                        <td class="px-5 py-4 font-medium">
                                                            {{ $detail->kategoriBotol->nama_kategori ?? 'Kategori' }}
                                                        </td>

                                                        <td class="px-5 py-4">
                                                            {{ $detail->jumlah_botol }} botol
                                                        </td>

                                                        <td class="px-5 py-4 font-semibold text-green-500">

                                                            @if (isset($detail->poin))
                                                                +{{ number_format($detail->poin, 0, ',', '.') }}
                                                            @else
                                                                -
                                                            @endif

                                                        </td>

                                                    </tr>

                                                @empty

                                                    <tr>
                                                        <td
                                                            colspan="3"
                                                            class="px-5 py-6 text-center text-sm text-gray-500"
                                                        >
                                                            Tidak ada detail penukaran.
                                                        </td>
                                                    </tr>

                                                @endforelse

                                            </tbody>

                                        </table>

                                    </div>


                                {{-- =================================================
                                    DETAIL PEMBELIAN / PENJUALAN
                                ================================================== --}}

                                @else

                                    <div class="overflow-x-auto">

                                        <table class="w-full text-left text-sm">

                                            <thead class="text-xs uppercase text-gray-500">

                                                <tr>

                                                    <th class="px-5 py-3">
                                                        Produk
                                                    </th>

                                                    <th class="px-5 py-3">
                                                        Harga Satuan
                                                    </th>

                                                    <th class="px-5 py-3">
                                                        Jumlah
                                                    </th>

                                                    <th class="px-5 py-3">
                                                        Subtotal Poin
                                                    </th>

                                                </tr>

                                            </thead>

                                            <tbody
                                                class="divide-y divide-gray-200 dark:divide-white/10"
                                            >

                                                @forelse ($item['detail'] as $detail)

                                                    <tr>

                                                        <td class="px-5 py-4 font-medium">
                                                            {{ $detail->nama_produk }}
                                                        </td>

                                                        <td class="px-5 py-4">
                                                            {{ number_format($detail->harga_satuan, 0, ',', '.') }}
                                                        </td>

                                                        <td class="px-5 py-4">
                                                            {{ $detail->jumlah_produk }}
                                                        </td>

                                                        <td
                                                            class="px-5 py-4 font-semibold
                                                            {{ $item['jenis'] === 'pembelian'
                                                                ? 'text-red-500'
                                                                : 'text-green-500' }}"
                                                        >
                                                            {{ $item['jenis'] === 'pembelian' ? '-' : '+' }}{{ number_format($detail->subtotal_poin, 0, ',', '.') }}
                                                        </td>

                                                    </tr>

                                                @empty

                                                    <tr>

                                                        <td
                                                            colspan="4"
                                                            class="px-5 py-6 text-center text-sm text-gray-500"
                                                        >
                                                            Tidak ada detail produk.
                                                        </td>

                                                    </tr>

                                                @endforelse

                                            </tbody>

                                        </table>

                                    </div>

                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="8"
                            class="px-6 py-12 text-center"
                        >

                            <div class="flex flex-col items-center">

                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-gray-400 dark:bg-white/5"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="h-6 w-6"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 13.5V6.75A2.25 2.25 0 0 1 5.25 4.5h13.5A2.25 2.25 0 0 1 21 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 17.25v-3.75Zm0 0h18"
                                        />
                                    </svg>
                                </div>

                                <p class="mt-3 font-semibold">
                                    Tidak ada transaksi
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    Belum ada transaksi yang sesuai dengan filter.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- =====================================================
        PAGINATION
    ====================================================== --}}

    <div
        class="flex flex-col gap-4 border-t border-gray-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between dark:border-white/10"
    >

        <p class="text-xs text-gray-500">

            Menampilkan
            <span class="font-semibold text-gray-700 dark:text-gray-300">
                {{ $transaksi->firstItem() ?? 0 }}
            </span>

            -
            <span class="font-semibold text-gray-700 dark:text-gray-300">
                {{ $transaksi->lastItem() ?? 0 }}
            </span>

            dari

            <span class="font-semibold text-gray-700 dark:text-gray-300">
                {{ $transaksi->total() }}
            </span>

            transaksi

        </p>


        <div>
            {{ $transaksi->links() }}
        </div>

    </div>

</div>


{{-- =========================================================
    FILTER OVERLAY
========================================================== --}}

<div
    x-show="showFilter"
    x-transition.opacity
    x-cloak
    class="fixed inset-0 z-50 bg-black/40"
    @keydown.escape.window="showFilter = false"
>

    {{-- OVERLAY CLICK --}}

    <div
        class="absolute inset-0"
        @click="showFilter = false"
    ></div>


    {{-- SLIDING PANEL --}}

    <div
        x-show="showFilter"
        x-transition:enter="transform transition duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="absolute right-0 top-0 h-full w-full max-w-md overflow-y-auto bg-white p-6 shadow-2xl dark:bg-gray-900"
        @click.stop
    >

        {{-- PANEL HEADER --}}

        <div class="flex items-center justify-between">

            <div>

                <h3 class="text-lg font-bold">
                    Filter Transaksi
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Atur transaksi yang ingin ditampilkan.
                </p>

            </div>

            <button
                type="button"
                @click="showFilter = false"
                class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/10 dark:hover:text-white"
            >
                ✕
            </button>

        </div>


        {{-- FILTER FORM --}}

        <form
            method="GET"
            action="{{ route('admin.transaksi.index') }}"
            class="mt-6"
        >

            {{-- POIN --}}

            <div>
                <div class="flex items-center justify-between">
                    <label class="font-semibold">
                        Rentang Poin
                    </label>

                    <span class="text-xs text-gray-500">
                        <span x-text="formatPoin(minPoin)"></span>
                        -
                        <span x-text="formatPoin(maxPoin)"></span>
                    </span>
                </div>

                {{-- INPUT ANGKA --}}
                <div class="mt-4 flex gap-3">

                    <div class="flex-1">
                        <label class="mb-1 block text-xs text-gray-500">
                            Minimum
                        </label>

                        <input
                            type="number"
                            name="min_poin"
                            min="0"
                            max="999999"
                            step="1"
                            x-model.number="minPoin"
                            @input="updateMinPoinFromInput"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm outline-none focus:border-green-500 dark:border-white/10 dark:bg-gray-900"
                        >
                    </div>

                    <div class="flex-1">
                        <label class="mb-1 block text-xs text-gray-500">
                            Maximum
                        </label>

                        <input
                            type="number"
                            name="max_poin"
                            min="0"
                            max="999999"
                            step="1"
                            x-model.number="maxPoin"
                            @input="updateMaxPoinFromInput"
                            class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm outline-none focus:border-green-500 dark:border-white/10 dark:bg-gray-900"
                        >
                    </div>

                </div>

                {{-- DUAL SLIDER --}}
                <div class="relative mt-6 h-6">

                    {{-- TRACK --}}
                    <div
                        class="absolute top-1/2 h-2 w-full -translate-y-1/2 rounded-full bg-gray-200 dark:bg-white/10"
                    ></div>

                    {{-- RANGE AKTIF --}}
                    <div
                        class="absolute top-1/2 h-2 -translate-y-1/2 rounded-full bg-green-500"
                        :style="`
                            left: ${(minPoin / 999999) * 100}%;
                            right: ${100 - (maxPoin / 999999) * 100}%;
                        `"
                    ></div>

                    {{-- MIN --}}
                    <input
                        type="range"
                        min="0"
                        max="999999"
                        step="1"
                        x-model.number="minPoin"
                        @input="updateMinPoin"
                        class="pointer-events-none absolute top-1/2 h-2 w-full -translate-y-1/2 appearance-none bg-transparent [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:h-5 [&::-webkit-slider-thumb]:w-5 [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-green-500 [&::-moz-range-thumb]:pointer-events-auto [&::-moz-range-thumb]:h-5 [&::-moz-range-thumb]:w-5 [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:border-0 [&::-moz-range-thumb]:bg-green-500"
                    >

                    {{-- MAX --}}
                    <input
                        type="range"
                        min="0"
                        max="999999"
                        step="1"
                        x-model.number="maxPoin"
                        @input="updateMaxPoin"
                        class="pointer-events-none absolute top-1/2 h-2 w-full -translate-y-1/2 appearance-none bg-transparent [&::-webkit-slider-thumb]:pointer-events-auto [&::-webkit-slider-thumb]:h-5 [&::-webkit-slider-thumb]:w-5 [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-green-500 [&::-moz-range-thumb]:pointer-events-auto [&::-moz-range-thumb]:h-5 [&::-moz-range-thumb]:w-5 [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:border-0 [&::-moz-range-thumb]:bg-green-500"
                    >

                </div>

            </div>


            {{-- JENIS --}}

            <div class="mt-8">

                <label class="font-semibold">
                    Jenis Transaksi
                </label>

                <div class="mt-3 space-y-3">

                    {{-- PENUKARAN --}}

                    <label class="flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="jenis[]"
                            value="penukaran"
                            x-model="jenis"
                            class="h-4 w-4 rounded border-gray-300 text-green-500 focus:ring-green-500"
                        >

                        <span class="text-sm">
                            Penukaran
                        </span>

                    </label>


                    {{-- PEMBELIAN --}}

                    <label class="flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="jenis[]"
                            value="pembelian"
                            x-model="jenis"
                            class="h-4 w-4 rounded border-gray-300 text-green-500 focus:ring-green-500"
                        >

                        <span class="text-sm">
                            Pembelian
                        </span>

                    </label>


                    {{-- PENJUALAN --}}

                    <label class="flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="jenis[]"
                            value="penjualan"
                            x-model="jenis"
                            class="h-4 w-4 rounded border-gray-300 text-green-500 focus:ring-green-500"
                        >

                        <span class="text-sm">
                            Penjualan
                        </span>

                    </label>

                </div>

            </div>


            {{-- =================================================
                STATUS PENUKARAN
            ================================================== --}}

            <div
                x-show="hasJenis('penukaran')"
                x-transition
                class="mt-6 rounded-xl border border-gray-200 p-4 dark:border-white/10"
            >

                <p class="text-sm font-semibold">
                    Status Penukaran
                </p>

                <div class="mt-3 space-y-3">

                    <label class="flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="status_penukaran[]"
                            value="menunggu"
                            x-model="statusPenukaran"
                            class="h-4 w-4 rounded border-gray-300 text-green-500 focus:ring-green-500"
                        >

                        <span class="text-sm">
                            Menunggu
                        </span>

                    </label>


                    <label class="flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="status_penukaran[]"
                            value="disetujui"
                            x-model="statusPenukaran"
                            class="h-4 w-4 rounded border-gray-300 text-green-500 focus:ring-green-500"
                        >

                        <span class="text-sm">
                            Disetujui
                        </span>

                    </label>


                    <label class="flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="status_penukaran[]"
                            value="ditolak"
                            x-model="statusPenukaran"
                            class="h-4 w-4 rounded border-gray-300 text-green-500 focus:ring-green-500"
                        >

                        <span class="text-sm">
                            Ditolak
                        </span>

                    </label>

                </div>

            </div>


            {{-- =================================================
                STATUS PEMBELIAN
            ================================================== --}}

            <div
                x-show="hasJenis('pembelian')"
                x-transition
                class="mt-6 rounded-xl border border-gray-200 p-4 dark:border-white/10"
            >

                <p class="text-sm font-semibold">
                    Status Pembelian
                </p>

                <div class="mt-3 space-y-3">

                    <label class="flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="status_pembelian[]"
                            value="menunggu"
                            x-model="statusPembelian"
                            class="h-4 w-4 rounded border-gray-300 text-green-500 focus:ring-green-500"
                        >

                        <span class="text-sm">
                            Menunggu
                        </span>

                    </label>


                    <label class="flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="status_pembelian[]"
                            value="diproses"
                            x-model="statusPembelian"
                            class="h-4 w-4 rounded border-gray-300 text-green-500 focus:ring-green-500"
                        >

                        <span class="text-sm">
                            Diproses
                        </span>

                    </label>


                    <label class="flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="status_pembelian[]"
                            value="selesai"
                            x-model="statusPembelian"
                            class="h-4 w-4 rounded border-gray-300 text-green-500 focus:ring-green-500"
                        >

                        <span class="text-sm">
                            Selesai
                        </span>

                    </label>

                </div>

            </div>


            {{-- =================================================
                STATUS PENJUALAN
            ================================================== --}}

            <div
                x-show="hasJenis('penjualan')"
                x-transition
                class="mt-6 rounded-xl border border-gray-200 p-4 dark:border-white/10"
            >

                <p class="text-sm font-semibold">
                    Status Penjualan
                </p>

                <div class="mt-3 space-y-3">

                    <label class="flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="status_penjualan[]"
                            value="menunggu"
                            x-model="statusPenjualan"
                            class="h-4 w-4 rounded border-gray-300 text-green-500 focus:ring-green-500"
                        >

                        <span class="text-sm">
                            Menunggu
                        </span>

                    </label>


                    <label class="flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="status_penjualan[]"
                            value="diproses"
                            x-model="statusPenjualan"
                            class="h-4 w-4 rounded border-gray-300 text-green-500 focus:ring-green-500"
                        >

                        <span class="text-sm">
                            Diproses
                        </span>

                    </label>


                    <label class="flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="status_penjualan[]"
                            value="selesai"
                            x-model="statusPenjualan"
                            class="h-4 w-4 rounded border-gray-300 text-green-500 focus:ring-green-500"
                        >

                        <span class="text-sm">
                            Selesai
                        </span>

                    </label>

                </div>

            </div>


            {{-- =================================================
                ACTION
            ================================================== --}}

            <div class="mt-8 flex gap-3">

                <button
                    type="submit"
                    class="flex-1 rounded-xl bg-green-500 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
                >
                    Terapkan Filter
                </button>

                <a
                    href="{{ route('admin.transaksi.index') }}"
                    @click="resetFilter"
                    class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-semibold transition hover:border-red-500 hover:text-red-500 dark:border-white/10"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>

</div>

</div>

{{-- =============================================================
DATA UNTUK ALPINE
============================================================= --}}

<script>

    window.transaksiFilterData = {
        jenis: @json($jenis ?? []),

        statusPenukaran: @json($statusPenukaran ?? []),

        statusPenjualan: @json($statusPenjualan ?? []),

        statusPembelian: @json($statusPembelian ?? []),

        minPoin: {{ $minPoin ?? 0 }},

        maxPoin: {{ $maxPoin ?? 999999 }}
    };

</script>

@endsection
