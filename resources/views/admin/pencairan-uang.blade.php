@extends('layouts.admin.app')

@section('title', 'Pencairan Dana')

@section('topbar-subtitle', 'Keuangan')

@section('topbar-title', 'Pencairan Dana')

@section('content')

<div class="space-y-6">

{{-- HEADER --}}
<div>
    <h2 class="text-2xl font-black">
        Pencairan Dana
    </h2>

    <p class="mt-1 text-sm text-gray-500">
        Kelola pengajuan pencairan poin siswa.
    </p>
</div>


{{-- FLASH MESSAGE --}}
@if (session('success'))
    <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700 dark:border-green-500/20 dark:bg-green-500/10 dark:text-green-400">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400">
        {{ session('error') }}
    </div>
@endif


{{-- TABLE --}}
<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]">

    {{-- TABLE HEADER --}}
    <div class="border-b border-gray-200 p-6 dark:border-white/10">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h3 class="font-bold">
                    Pengajuan Pencairan
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Daftar pengajuan pencairan poin dari siswa.
                </p>
            </div>

            <div class="text-sm text-gray-500">
                Total:
                <span class="font-bold text-gray-900 dark:text-white">
                    {{ $pencairan->total() }}
                </span>
                pengajuan
            </div>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="overflow-x-auto">

        <table class="w-full text-left text-sm">

            <thead class="border-b border-gray-200 text-xs uppercase text-gray-500 dark:border-white/10">

                <tr>

                    <th class="whitespace-nowrap px-6 py-4">
                        ID
                    </th>

                    <th class="whitespace-nowrap px-6 py-4">
                        Siswa
                    </th>

                    <th class="whitespace-nowrap px-6 py-4">
                        Poin
                    </th>

                    <th class="whitespace-nowrap px-6 py-4">
                        Nominal
                    </th>

                    <th class="whitespace-nowrap px-6 py-4">
                        Metode
                    </th>

                    <th class="whitespace-nowrap px-6 py-4">
                        Penerima
                    </th>

                    <th class="whitespace-nowrap px-6 py-4">
                        Status
                    </th>

                    <th class="whitespace-nowrap px-6 py-4">
                        Pengajuan
                    </th>

                    <th class="whitespace-nowrap px-6 py-4 text-right">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-200 dark:divide-white/10">

                @forelse ($pencairan as $item)

                    <tr class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]">

                        {{-- ID --}}
                        <td class="whitespace-nowrap px-6 py-5">

                            <span class="font-mono text-xs font-semibold">
                                PEN-{{ str_pad($item->id, 6, '0', STR_PAD_LEFT) }}
                            </span>

                        </td>


                        {{-- SISWA --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-500 font-bold text-gray-950">

                                    {{ strtoupper(substr($item->siswa->nama_lengkap ?? 'S', 0, 1)) }}

                                </div>

                                <div>

                                    <p class="font-semibold">
                                        {{ $item->siswa->nama_lengkap ?? '-' }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $item->siswa->kode_siswa ?? '-' }}
                                    </p>

                                </div>

                            </div>

                        </td>


                        {{-- POIN --}}
                        <td class="whitespace-nowrap px-6 py-5">

                            <span class="font-bold text-green-500">
                                {{ number_format($item->jumlah_poin, 0, ',', '.') }}
                            </span>

                            <span class="text-xs text-gray-500">
                                poin
                            </span>

                        </td>


                        {{-- NOMINAL --}}
                        <td class="whitespace-nowrap px-6 py-5">

                            <span class="font-bold">
                                Rp {{ number_format($item->jumlah_uang, 0, ',', '.') }}
                            </span>

                        </td>


                        {{-- METODE --}}
                        <td class="px-6 py-5">

                            @if ($item->metode === 'e-wallet')

                                <div>
                                    <p class="font-semibold">
                                        E-Wallet
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $item->provider ?? '-' }}
                                    </p>
                                </div>

                            @elseif ($item->metode === 'bank')

                                <div>
                                    <p class="font-semibold">
                                        Bank
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $item->provider ?? '-' }}
                                    </p>
                                </div>

                            @else

                                <span class="font-semibold">
                                    Cash
                                </span>

                            @endif

                        </td>


                        {{-- PENERIMA --}}
                        <td class="px-6 py-5">

                            <p class="font-semibold">
                                {{ $item->nama_penerima }}
                            </p>

                            @if ($item->nomor_tujuan)

                                <p class="font-mono text-xs text-gray-500">
                                    {{ $item->nomor_tujuan }}
                                </p>

                            @endif

                        </td>


                        {{-- STATUS --}}
                        <td class="whitespace-nowrap px-6 py-5">

                            @if ($item->status === 'menunggu')

                                <span class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold text-yellow-600 dark:text-yellow-400">
                                    Menunggu
                                </span>

                            @elseif ($item->status === 'diproses')

                                <span class="rounded-full bg-blue-500/10 px-3 py-1 text-xs font-semibold text-blue-600 dark:text-blue-400">
                                    Diproses
                                </span>

                            @elseif ($item->status === 'disetujui')

                                <span class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-600 dark:text-green-400">
                                    Disetujui
                                </span>

                            @elseif ($item->status === 'ditolak')

                                <span class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-600 dark:text-red-400">
                                    Ditolak
                                </span>

                            @elseif ($item->status === 'selesai')

                                <span class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-600 dark:text-green-400">
                                    Selesai
                                </span>

                            @else

                                <span class="rounded-full bg-gray-500/10 px-3 py-1 text-xs font-semibold text-gray-500">
                                    {{ ucfirst($item->status) }}
                                </span>

                            @endif

                        </td>


                        {{-- TANGGAL --}}
                        <td class="whitespace-nowrap px-6 py-5">

                            <p class="text-xs font-medium">
                                {{ $item->tanggal_pengajuan?->format('d M Y') }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ $item->tanggal_pengajuan?->format('H:i') }}
                            </p>

                        </td>


                        {{-- AKSI --}}
                        <td class="px-6 py-5">

                            <div class="flex justify-end gap-2">

                                {{-- MENUNGGU --}}
                                @if ($item->status === 'menunggu')

                                    <form
                                        method="POST"
                                        action="{{ route('admin.pencairan-uang.process', $item) }}"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            onclick="return confirm('Proses pengajuan pencairan ini? Saldo siswa akan dikurangi.')"
                                            class="rounded-lg bg-blue-500 px-3 py-2 text-xs font-bold text-white transition hover:bg-blue-600"
                                        >
                                            Proses
                                        </button>

                                    </form>


                                    <form
                                        method="POST"
                                        action="{{ route('admin.pencairan-uang.reject', $item) }}"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            onclick="return confirm('Tolak pengajuan pencairan ini?')"
                                            class="rounded-lg border border-red-200 px-3 py-2 text-xs font-bold text-red-500 transition hover:bg-red-50 dark:border-red-500/20 dark:hover:bg-red-500/10"
                                        >
                                            Tolak
                                        </button>

                                    </form>


                                {{-- DIPROSES --}}
                                @elseif ($item->status === 'diproses')

                                    <form
                                        method="POST"
                                        action="{{ route('admin.pencairan-uang.approve', $item) }}"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            onclick="return confirm('Pastikan dana sebesar Rp {{ number_format($item->jumlah_uang, 0, ',', '.') }} sudah ditransfer kepada siswa sebelum melanjutkan.')"
                                            class="rounded-lg bg-green-500 px-3 py-2 text-xs font-bold text-gray-950 transition hover:bg-green-400"
                                        >
                                            Konfirmasi Transfer
                                        </button>

                                    </form>


                                    <form
                                        method="POST"
                                        action="{{ route('admin.pencairan-uang.reject', $item) }}"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            onclick="return confirm('Tolak pengajuan ini? Saldo siswa akan dikembalikan.')"
                                            class="rounded-lg border border-red-200 px-3 py-2 text-xs font-bold text-red-500 transition hover:bg-red-50 dark:border-red-500/20 dark:hover:bg-red-500/10"
                                        >
                                            Tolak
                                        </button>

                                    </form>


                                {{-- STATUS FINAL --}}
                                @else

                                    <span class="text-xs text-gray-400">
                                        Tidak ada aksi
                                    </span>

                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="9"
                            class="px-6 py-16 text-center"
                        >

                            <div class="flex flex-col items-center">

                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-gray-400 dark:bg-white/10">

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
                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                        />
                                    </svg>

                                </div>

                                <p class="mt-3 font-semibold">
                                    Belum ada pengajuan pencairan
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    Pengajuan pencairan dari siswa akan muncul di sini.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- PAGINATION --}}
    @if ($pencairan->hasPages())

        <div class="border-t border-gray-200 px-6 py-4 dark:border-white/10">

            {{ $pencairan->links() }}

        </div>

    @endif

</div>


</div>

@endsection
