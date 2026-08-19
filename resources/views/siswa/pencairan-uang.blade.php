@extends('layouts.siswa.app')

@section('title', 'Pencairan Uang')

@section('topbar-subtitle', 'Menu')

@section('topbar-title', 'Pencairan Uang')

@section('content')

<div
    x-data="pencairanApp({
        saldo: {{ $siswa->saldo_poin }},
        oldJumlah: {{ old('jumlah_poin', 100) }}
    })"
    class="space-y-6"
>

{{-- HEADER --}}
<div>
    <h1 class="text-2xl font-black">
        Pencairan Uang
    </h1>

    <p class="mt-1 text-sm text-gray-500">
        Tukarkan poin kamu menjadi uang tunai melalui metode pencairan yang tersedia.
    </p>
</div>


{{-- FLASH MESSAGE --}}
@if(session('success'))
    <div class="rounded-xl border border-green-500/20 bg-green-500/10 px-4 py-3 text-sm text-green-600">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3 text-sm text-red-600">
        {{ session('error') }}
    </div>
@endif


{{-- VALIDATION ERROR --}}
@if($errors->any())
    <div class="rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3">
        <ul class="list-disc space-y-1 pl-5 text-sm text-red-600">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{{-- SALDO --}}
<div class="rounded-2xl bg-gray-950 p-6 text-white shadow-lg dark:bg-white dark:text-gray-950">

    <p class="text-sm text-gray-400 dark:text-gray-500">
        Saldo Poin
    </p>

    <div class="mt-2 flex flex-col gap-1 sm:flex-row sm:items-end sm:gap-3">

        <span class="text-3xl font-black">
            {{ number_format($siswa->saldo_poin, 0, ',', '.') }}
        </span>

        <span class="text-sm text-gray-400 dark:text-gray-500">
            poin
        </span>

    </div>

    <p class="mt-3 text-sm text-gray-400 dark:text-gray-500">
        Estimasi nilai:
        <span class="font-bold text-green-400 dark:text-green-600">
            Rp {{ number_format($siswa->saldo_poin * 100, 0, ',', '.') }}
        </span>
    </p>

    <p class="mt-2 text-xs text-gray-500">
        Konversi: 100 poin = Rp10.000
    </p>

</div>


{{-- FORM PENGAJUAN --}}
<div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]">

    <div class="mb-6">
        <h2 class="text-lg font-bold">
            Ajukan Pencairan
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Minimal pencairan adalah 100 poin.
            100 poin setara dengan Rp10.000.
        </p>
    </div>

    <form
        method="POST"
        action="{{ route('siswa.pencairan.store') }}"
        @submit.prevent="
            if (validateForm()) {
                submitting = true;
                setTimeout(() => $el.submit(), 1200);
            }
        "
        class="space-y-5"
    >
        @csrf

        {{-- JUMLAH POIN --}}
        <div>
            <label class="mb-2 block text-sm font-semibold">
                Jumlah Poin
            </label>

            <input
                type="number"
                name="jumlah_poin"
                min="10"
                :max="saldo"
                x-model.number="jumlahPoin"
                @input="calculate()"
                value="{{ old('jumlah_poin', 100) }}"
                required
                class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-white/5"
            >

            <p class="mt-2 text-xs text-gray-500">
                Saldo tersedia:
                <span
                    class="font-semibold text-green-600"
                    x-text="formatPoin(saldo) + ' poin'"
                ></span>
            </p>

            <p
                class="mt-1 text-xs text-gray-500"
            >
                Nilai pencairan:
                <span
                    class="font-bold text-green-600"
                    x-text="'Rp ' + formatRupiah(jumlahUang)"
                ></span>
            </p>
        </div>


        {{-- QUICK AMOUNT --}}
        <div>
            <label class="mb-2 block text-sm font-semibold">
                Pilih Cepat
            </label>

            <div class="grid grid-cols-2 gap-2 sm:grid-cols-4">

                <template x-for="amount in quickAmounts" :key="amount">

                    <button
                        type="button"
                        @click="setAmount(amount)"
                        :disabled="amount > saldo"
                        class="rounded-xl border border-gray-200 px-3 py-2 text-sm font-semibold transition hover:border-green-500 hover:bg-green-500/10 disabled:cursor-not-allowed disabled:opacity-40 dark:border-white/10"
                        x-text="formatPoin(amount) + ' poin'"
                    ></button>

                </template>

            </div>
        </div>


        {{-- METODE --}}
        <div>
            <label class="mb-2 block text-sm font-semibold">
                Metode Pencairan
            </label>

            <select
                name="metode"
                x-model="metode"
                @change="changeMetode()"
                required
                class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-white/5"
            >
                <option value="">
                    Pilih metode
                </option>

                <option value="cash">
                    Cash
                </option>

                <option value="e-wallet">
                    E-Wallet
                </option>
            </select>
        </div>


        {{-- PROVIDER --}}
        <div
            x-show="metode === 'e-wallet'"
            x-transition
            style="display: none;"
        >

            <label class="mb-2 block text-sm font-semibold">
                Provider
            </label>

            <select
                name="provider"
                x-model="provider"
                :required="metode === 'e-wallet'"
                :disabled="metode !== 'e-wallet'"
                class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-white/5"
            >
                <option value="">
                    Pilih provider
                </option>

                <option value="dana">
                    DANA
                </option>

                <option value="gopay">
                    Gopay
                </option>

                <option value="shopeepay">
                    Shopeepay
                </option>

                <option value="ovo">
                    OVO
                </option>
            </select>

        </div>


        {{-- NAMA PENERIMA --}}
        <div
        x-show="metode === 'cash'"
        x-transition
        style="display: none;"
        >

            <label class="mb-2 block text-sm font-semibold">
                Nama Penerima
            </label>

            <input
                type="text"
                name="nama_penerima"
                value="{{ old('nama_penerima') }}"
                placeholder="Nama penerima"
                :required="metode === 'cash'"
                :disabled="metode !== 'cash'"
                class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-white/5"
            >

        </div>


        {{-- NOMOR TUJUAN --}}
        <div
            x-show="metode === 'e-wallet'"
            x-transition
            style="display: none;"
        >
            <label class="mb-2 block text-sm font-semibold">
                Nama Pemilik E-Wallet
            </label>

            <input
                type="text"
                name="nama_penerima"
                value="{{ old('nama_penerima') }}"
                placeholder="Nama pemilik e-wallet"
                :required="metode === 'e-wallet'"
                :disabled="metode !== 'e-wallet'"
                class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-white/5"
            >

            <label class="mb-2 mt-5 block text-sm font-semibold">
                Nomor Tujuan
            </label>

            <input
                type="text"
                name="nomor_tujuan"
                value="{{ old('nomor_tujuan') }}"
                placeholder="Nomor e-wallet"
                :required="metode === 'e-wallet'"
                :disabled="metode !== 'e-wallet'"
                class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-white/5"
            >
        </div>


        {{-- RINGKASAN --}}
        <div class="rounded-xl bg-gray-100 p-4 dark:bg-white/5">

            <div class="flex items-center justify-between gap-4">

                <span class="text-sm text-gray-500">
                    Poin yang dicairkan
                </span>

                <span
                    class="font-bold"
                    x-text="formatPoin(jumlahPoin) + ' poin'"
                ></span>

            </div>

            <div class="mt-2 flex items-center justify-between gap-4">

                <span class="text-sm text-gray-500">
                    Jumlah uang
                </span>

                <span
                    class="text-lg font-black text-green-600"
                    x-text="'Rp ' + formatRupiah(jumlahUang)"
                ></span>

            </div>

        </div>


        {{-- BUTTON --}}
        <button
            type="submit"
            :disabled="submitting"
            class="w-full rounded-xl bg-green-500 px-4 py-3 font-bold text-gray-950 transition hover:bg-green-400 disabled:cursor-not-allowed disabled:opacity-60"
        >

            <span x-show="!submitting">
                Ajukan Pencairan
            </span>

            <span
                x-show="submitting"
                class="flex items-center justify-center gap-2"
            >

                <svg
                    class="h-5 w-5 animate-spin"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <circle
                        class="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4"
                    ></circle>

                    <path
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                    ></path>
                </svg>

                Memeriksa saldo...
            </span>

        </button>

    </form>


    {{-- POPUP LOADING --}}
    <div
        x-show="submitting"
        x-transition.opacity
        class="fixed inset-0 z-[999] flex items-center justify-center bg-black/50 backdrop-blur-sm"
        style="display: none;"
    >

        <div
            class="mx-4 w-full max-w-sm rounded-2xl bg-white p-8 text-center shadow-2xl dark:bg-gray-900"
        >

            <div class="flex justify-center">

                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-green-500/10">

                    <svg
                        class="h-8 w-8 animate-spin text-green-500"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                        ></circle>

                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                        ></path>
                    </svg>

                </div>

            </div>

            <h3 class="mt-5 text-lg font-bold">
                Memeriksa saldo
            </h3>

            <p class="mt-2 text-sm text-gray-500">
                Sistem sedang memeriksa kesesuaian saldo poin
                dengan jumlah pencairan.
            </p>

            <p class="mt-4 text-xs text-gray-400">
                Mohon jangan tutup halaman ini.
            </p>

        </div>

    </div>

</div>


{{-- RIWAYAT --}}
<div class="rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]">

    <div class="border-b border-gray-200 p-6 dark:border-white/10">

        <h2 class="font-bold">
            Riwayat Pencairan
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Pantau status pengajuan pencairan kamu.
        </p>

    </div>


    <div class="overflow-x-auto">

        <table class="w-full text-left text-sm">

            <thead class="border-b border-gray-200 text-xs uppercase text-gray-500 dark:border-white/10">

                <tr>

                    <th class="px-6 py-4">
                        Tanggal
                    </th>

                    <th class="px-6 py-4">
                        Jumlah
                    </th>

                    <th class="px-6 py-4">
                        Metode
                    </th>

                    <th class="px-6 py-4">
                        Tujuan
                    </th>

                    <th class="px-6 py-4">
                        Status
                    </th>

                    <th class="px-6 py-4 text-center">
                        Detail
                    </th>

                    <th class="px-6 py-4 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-200 dark:divide-white/10">

                @forelse($pencairan as $item)

                    <tr>

                        <td class="whitespace-nowrap px-6 py-5">

                            <p class="font-medium">
                                {{ $item->tanggal_pengajuan->format('d M Y') }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ $item->tanggal_pengajuan->format('H:i') }}
                            </p>

                        </td>


                        <td class="px-6 py-5">

                            <p class="font-bold">
                                {{ number_format($item->jumlah_poin, 0, ',', '.') }}
                                poin
                            </p>

                            <p class="text-xs text-green-500">
                                Rp {{ number_format($item->jumlah_uang, 0, ',', '.') }}
                            </p>

                        </td>


                        <td class="px-6 py-5">

                            <p class="font-semibold">
                                {{ $item->metode === 'e-wallet'
                                    ? 'E-Wallet'
                                    : ucfirst($item->metode) }}
                            </p>

                            @if($item->provider)

                                <p class="text-xs text-gray-500">
                                    {{ $item->provider }}
                                </p>

                            @endif

                        </td>


                        <td class="px-6 py-5">

                            <p class="font-medium">
                                {{ $item->nama_penerima }}
                            </p>

                            @if($item->nomor_tujuan)

                                <p class="text-xs text-gray-500">
                                    {{ $item->nomor_tujuan }}
                                </p>

                            @endif

                        </td>


                        <td class="px-6 py-5">

                            @php

                                $statusClass = match($item->status) {

                                    'menunggu' =>
                                        'bg-yellow-500/10 text-yellow-600',

                                    'diproses' =>
                                        'bg-blue-500/10 text-blue-600',

                                    'disetujui' =>
                                        'bg-green-500/10 text-green-600',

                                    'selesai' =>
                                        'bg-green-500/10 text-green-600',

                                    'ditolak' =>
                                        'bg-red-500/10 text-red-600',

                                    default =>
                                        'bg-gray-500/10 text-gray-600',
                                };

                                $statusLabel = ucfirst($item->status);

                            @endphp

                            <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>

                        </td>


                        {{-- DETAIL --}}
                        <td class="px-6 py-5 text-center">

                            @if(in_array($item->status, ['diproses', 'disetujui', 'selesai']))

                                <button
                                    type="button"
                                    @click="openBukti({
                                        id: {{ $item->id }},
                                        nama: @js($item->siswa->nama_lengkap ?? Auth::user()->name),
                                        kodeSiswa: @js($item->siswa->kode_siswa ?? '-'),
                                        poin: {{ $item->jumlah_poin }},
                                        uang: {{ $item->jumlah_uang }},
                                        metode: @js($item->metode),
                                        provider: @js($item->provider),
                                        penerima: @js($item->nama_penerima),
                                        nomor: @js($item->nomor_tujuan),
                                        status: @js($item->status),
                                        tanggal: @js($item->tanggal_pengajuan?->format('d M Y')),
                                        waktu: @js($item->tanggal_pengajuan?->format('H:i'))
                                    })"
                                    class="rounded-lg border border-green-200 px-3 py-2 text-xs font-bold text-green-600 transition hover:bg-green-50 dark:border-green-500/20 dark:hover:bg-green-500/10"
                                >
                                    Lihat Bukti
                                </button>

                            @else

                                <span class="text-xs text-gray-400">
                                    -
                                </span>

                            @endif

                        </td>


                        {{-- AKSI --}}
                        <td class="px-6 py-5 text-center">

                            @if($item->status === 'disetujui')

                                <form
                                    method="POST"
                                    action="{{ route('siswa.pencairan.selesai', $item) }}"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="rounded-lg bg-green-500 px-3 py-2 text-xs font-bold text-gray-950 transition hover:bg-green-400"
                                    >
                                        Sudah Diterima
                                    </button>

                                </form>

                            @elseif($item->status === 'selesai')

                                <span class="text-xs font-semibold text-green-600">
                                    Selesai
                                </span>

                            @elseif($item->status === 'ditolak')

                                <span class="text-xs font-semibold text-red-600">
                                    Ditolak
                                </span>

                                @if($item->catatan)

                                    <p class="mt-1 max-w-xs text-xs text-gray-500">
                                        {{ $item->catatan }}
                                    </p>

                                @endif

                            @else

                                <span class="text-xs text-gray-400">
                                    Menunggu proses
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="px-6 py-10 text-center text-sm text-gray-500"
                        >
                            Belum ada riwayat pencairan.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- POPUP BUKTI PENCAIRAN --}}
<div
    x-show="showBukti"
    x-cloak
    x-transition.opacity
    class="fixed inset-0 z-[1000] flex items-center justify-center bg-black/50 px-4 backdrop-blur-sm"
>
    <div
        x-show="showBukti"
        x-transition
        @click.outside="closeBukti()"
        class="w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-900"
    >

        {{-- HEADER --}}
        <div class="bg-gray-950 px-6 py-5 text-white dark:bg-white dark:text-gray-950">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">
                        Bukti Pencairan
                    </p>

                    <h3 class="mt-1 text-xl font-black">
                        Pencairan Poin
                    </h3>
                </div>

                <button
                    type="button"
                    @click="closeBukti()"
                    class="rounded-lg p-2 text-gray-400 transition hover:bg-white/10 hover:text-white dark:hover:bg-black/10 dark:hover:text-gray-950"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="h-5 w-5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18 18 6M6 6l12 12"
                        />
                    </svg>
                </button>

            </div>

        </div>


        {{-- CONTENT --}}
        <div class="p-6">

            {{-- ID TRANSAKSI --}}
            <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-4 text-center dark:border-white/10 dark:bg-white/5">

                <p class="text-xs text-gray-500">
                    ID Pencairan
                </p>

                <p
                    class="mt-1 font-mono text-xl font-black tracking-wider"
                    x-text="'PEN-' + String(bukti.id).padStart(6, '0')"
                ></p>

            </div>


            {{-- STATUS --}}
            <div class="mt-5 text-center">

                <span
                    class="inline-flex rounded-full px-3 py-1 text-xs font-bold"
                    :class="{
                        'bg-blue-500/10 text-blue-600': bukti.status === 'diproses',
                        'bg-green-500/10 text-green-600': ['disetujui', 'selesai'].includes(bukti.status)
                    }"
                    x-text="formatStatus(bukti.status)"
                ></span>

            </div>


            {{-- JUMLAH --}}
            <div class="mt-6 rounded-xl bg-green-500/10 p-5 text-center">

                <p class="text-xs font-medium text-gray-500">
                    Jumlah Pencairan
                </p>

                <p
                    class="mt-1 text-3xl font-black text-green-600"
                    x-text="'Rp ' + formatRupiah(bukti.uang)"
                ></p>

                <p
                    class="mt-1 text-sm text-gray-500"
                    x-text="formatPoin(bukti.poin) + ' poin'"
                ></p>

            </div>


            {{-- DETAIL --}}
            <div class="mt-6 space-y-3">

                <div class="flex justify-between gap-4">

                    <span class="text-sm text-gray-500">
                        Nama
                    </span>

                    <span
                        class="text-right text-sm font-semibold"
                        x-text="bukti.nama"
                    ></span>

                </div>


                <div class="flex justify-between gap-4">

                    <span class="text-sm text-gray-500">
                        Kode Siswa
                    </span>

                    <span
                        class="font-mono text-sm font-semibold"
                        x-text="bukti.kodeSiswa"
                    ></span>

                </div>


                <div class="flex justify-between gap-4">

                    <span class="text-sm text-gray-500">
                        Metode
                    </span>

                    <span
                        class="text-right text-sm font-semibold"
                        x-text="formatMetode(bukti.metode)"
                    ></span>

                </div>


                <template x-if="bukti.provider">

                    <div class="flex justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Provider
                        </span>

                        <span
                            class="text-right text-sm font-semibold"
                            x-text="bukti.provider.toUpperCase()"
                        ></span>

                    </div>

                </template>


                <div class="flex justify-between gap-4">

                    <span class="text-sm text-gray-500">
                        Penerima
                    </span>

                    <span
                        class="text-right text-sm font-semibold"
                        x-text="bukti.penerima"
                    ></span>

                </div>


                <template x-if="bukti.nomor">

                    <div class="flex justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Nomor Tujuan
                        </span>

                        <span
                            class="font-mono text-sm font-semibold"
                            x-text="bukti.nomor"
                        ></span>

                    </div>

                </template>


                <div class="flex justify-between gap-4">

                    <span class="text-sm text-gray-500">
                        Tanggal
                    </span>

                    <span
                        class="text-right text-sm font-semibold"
                        x-text="bukti.tanggal + ' ' + bukti.waktu"
                    ></span>

                </div>

            </div>


            {{-- INFO --}}
            <div class="mt-6 rounded-xl border border-yellow-200 bg-yellow-50 p-4 dark:border-yellow-500/20 dark:bg-yellow-500/10">

                <div class="flex gap-3">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-5 w-5 shrink-0 text-yellow-600"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v3.75m0 3.75h.008M10.29 3.86l-7.1 12.28A1.5 1.5 0 0 0 4.49 18.4h15.02a1.5 1.5 0 0 0 1.3-2.26L13.71 3.86a1.98 1.98 0 0 0-3.42 0Z"
                        />
                    </svg>

                    <p class="text-xs leading-relaxed text-yellow-700 dark:text-yellow-400">
                        Tunjukkan bukti ini kepada kasir untuk membantu proses pencairan.
                    </p>

                </div>

            </div>


            {{-- CLOSE --}}
            <button
                type="button"
                @click="closeBukti()"
                class="mt-6 w-full rounded-xl bg-gray-950 px-4 py-3 text-sm font-bold text-white transition hover:bg-gray-800 dark:bg-white dark:text-gray-950 dark:hover:bg-gray-200"
            >
                Tutup
            </button>

        </div>

    </div>
</div>

</div>

<script>

function pencairanApp(config) {

    return {

        saldo: Number(config.saldo || 0),
        jumlahPoin: Number(config.oldJumlah || 100),
        jumlahUang: 10000,
        submitting: false,

        showBukti: false,

        bukti: {
            id: null,
            nama: '',
            kodeSiswa: '',
            poin: 0,
            uang: 0,
            metode: '',
            provider: '',
            penerima: '',
            nomor: '',
            status: '',
            tanggal: '',
            waktu: ''
        },

        metode: '',
        provider: '',
        quickAmounts: [100, 500, 1000, 5000],

        init() {

            this.calculate();

        },

        openBukti(data) {

            this.bukti = data;

            this.showBukti = true;

            document.body.classList.add('overflow-hidden');

        },

        closeBukti() {

            this.showBukti = false;

            document.body.classList.remove('overflow-hidden');

        },

        formatStatus(status) {

            const labels = {
                diproses: 'Sedang Diproses',
                disetujui: 'Disetujui',
                selesai: 'Selesai'
            };

            return labels[status] || status;

        },

        formatMetode(metode) {

            if (metode === 'e-wallet') {
                return 'E-Wallet';
            }

            if (metode === 'cash') {
                return 'Cash';
            }

            return metode;

        },

        formatPoin(value) {

            return new Intl.NumberFormat('id-ID')
                .format(Number(value) || 0);

        },

        formatRupiah(value) {

            return new Intl.NumberFormat('id-ID')
                .format(Number(value) || 0);

        },

        calculate() {

            let poin = Number(this.jumlahPoin) || 0;

            if (poin < 0) {
                poin = 0;
            }

            this.jumlahPoin = poin;

            this.jumlahUang = poin * 100;

        },

        setAmount(amount) {

            if (amount <= this.saldo) {

                this.jumlahPoin = amount;

                this.calculate();

            }

        },

        changeMetode() {

            this.provider = '';

        },

        validateForm() {

            const poin = Number(this.jumlahPoin);

            if (poin < 100) {

                alert('Minimal pencairan adalah 100 poin.');

                return false;

            }

            if (poin > this.saldo) {

                alert('Saldo poin tidak mencukupi.');

                return false;

            }

            if (this.metode === '') {

                alert('Silakan pilih metode pencairan.');

                return false;

            }

            if (
                this.metode === 'e-wallet'
                && this.provider === ''
            ) {

                alert('Silakan pilih provider.');

                return false;

            }

            return true;

        }

    };

}

</script>

@endsection