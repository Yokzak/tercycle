@extends('layouts.siswa.app')

@section('title', 'Pesanan')

@section('topbar-subtitle', 'Marketplace')

@section('topbar-title', 'Pesanan Saya')

@section('content')

<div class="mb-8">

    <p class="text-sm font-medium text-green-500">
        Pesanan
    </p>

    <h1 class="mt-2 text-3xl font-black">
        Pesanan Saya
    </h1>

    <p class="mt-1 text-sm text-gray-500">
        Kelola pesanan yang kamu beli dan pesanan dari pembeli.
    </p>

</div>


{{-- ========================================================= --}}
{{-- SEBAGAI PEMBELI --}}
{{-- ========================================================= --}}

<div class="mb-8 overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]">

    <div class="border-b border-gray-200 px-6 py-5 dark:border-white/10">

        <h2 class="font-bold">
            Pesanan Saya
        </h2>

        <p class="mt-1 text-xs text-gray-500">
            Produk yang kamu beli menggunakan poin.
        </p>

    </div>


    <div class="overflow-x-auto">

        <table class="w-full text-left text-sm">

            <thead class="border-b border-gray-200 text-xs uppercase text-gray-500 dark:border-white/10">

                <tr>

                    <th class="px-6 py-4">
                        Pesanan
                    </th>

                    <th class="px-6 py-4">
                        Produk
                    </th>

                    <th class="px-6 py-4">
                        Total
                    </th>

                    <th class="px-6 py-4">
                        Tanggal
                    </th>

                    <th class="px-6 py-4">
                        Status
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-200 dark:divide-white/10">

                @forelse ($pesanansPembeli as $pesanan)

                    <tr>

                        {{-- ID --}}
                        <td class="px-6 py-5 font-semibold">
                            #{{ $pesanan->id }}
                        </td>


                        {{-- PRODUK --}}
                        <td class="px-6 py-5">

                            @foreach ($pesanan->detailPesanan as $detail)

                                <div>

                                    {{ $detail->nama_produk }}

                                    <span class="text-gray-500">
                                        × {{ $detail->jumlah_produk }}
                                    </span>

                                </div>

                            @endforeach

                        </td>


                        {{-- TOTAL --}}
                        <td class="px-6 py-5 font-semibold">

                            {{ number_format(
                                $pesanan->total_poin,
                                0,
                                ',',
                                '.'
                            ) }}

                            poin

                        </td>


                        {{-- TANGGAL --}}
                        <td class="px-6 py-5 text-gray-500">

                            {{ $pesanan->tanggal->format('d M Y') }}

                        </td>


                        {{-- STATUS --}}
                        <td class="px-6 py-5">

                            @if ($pesanan->status === 'menunggu')

                                <span class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold text-yellow-600 dark:text-yellow-400">
                                    Menunggu
                                </span>

                            @elseif ($pesanan->status === 'diproses')

                                <div class="flex flex-col gap-2">

                                    <span class="w-fit rounded-full bg-blue-500/10 px-3 py-1 text-xs font-semibold text-blue-600 dark:text-blue-400">
                                        Diproses
                                    </span>

                                    @if ($pesanan->pembeli_id === auth()->user()->siswa->id)

                                        <form
                                            action="{{ route('siswa.pesanan.selesai', $pesanan) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="rounded-lg bg-green-500 px-3 py-2 text-xs font-bold text-gray-950 transition hover:bg-green-400"
                                                onclick="return confirm('Yakin pesanan ini sudah diterima?')"
                                            >
                                                Pesanan Diterima
                                            </button>
                                        </form>

                                    @endif

                                </div>

                            @elseif ($pesanan->status === 'selesai')

                                <span class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-600 dark:text-green-400">
                                    Selesai
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="5"
                            class="px-6 py-12 text-center text-sm text-gray-500"
                        >
                            Belum ada pesanan sebagai pembeli.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>



{{-- ========================================================= --}}
{{-- SEBAGAI PENJUAL --}}
{{-- ========================================================= --}}

<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]">

    <div class="border-b border-gray-200 px-6 py-5 dark:border-white/10">

        <h2 class="font-bold">
            Pesanan Masuk
        </h2>

        <p class="mt-1 text-xs text-gray-500">
            Pesanan dari siswa yang membeli produk kamu.
        </p>

    </div>


    <div class="overflow-x-auto">

        <table class="w-full text-left text-sm">

            <thead class="border-b border-gray-200 text-xs uppercase text-gray-500 dark:border-white/10">

                <tr>

                    <th class="px-6 py-4">
                        Pesanan
                    </th>

                    <th class="px-6 py-4">
                        Pembeli
                    </th>

                    <th class="px-6 py-4">
                        Produk
                    </th>

                    <th class="px-6 py-4">
                        Total
                    </th>

                    <th class="px-6 py-4">
                        Tanggal
                    </th>

                    <th class="px-6 py-4">
                        Status
                    </th>

                    <th class="px-6 py-4">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-200 dark:divide-white/10">

                @forelse ($pesanansPenjual as $pesanan)

                    <tr>

                        {{-- ID --}}
                        <td class="px-6 py-5 font-semibold">
                            #{{ $pesanan->id }}
                        </td>


                        {{-- PEMBELI --}}
                        <td class="px-6 py-5">

                            <div class="font-semibold">
                                {{ $pesanan->pembeli->nama_lengkap ?? '-' }}
                            </div>

                            <div class="text-xs text-gray-500">
                                {{ $pesanan->pembeli->nis ?? '-' }}
                            </div>

                        </td>


                        {{-- PRODUK --}}
                        <td class="px-6 py-5">

                            @foreach ($pesanan->detailPesanan as $detail)

                                @if ($detail->penjual_id == auth()->user()->siswa->id)

                                    <div>

                                        {{ $detail->nama_produk }}

                                        <span class="text-gray-500">
                                            × {{ $detail->jumlah_produk }}
                                        </span>

                                    </div>

                                @endif

                            @endforeach

                        </td>


                        {{-- TOTAL --}}
                        <td class="px-6 py-5 font-semibold">

                            {{ number_format(
                                $pesanan->total_poin,
                                0,
                                ',',
                                '.'
                            ) }}

                            poin

                        </td>


                        {{-- TANGGAL --}}
                        <td class="px-6 py-5 text-gray-500">

                            {{ $pesanan->tanggal->format('d M Y') }}

                        </td>


                        {{-- STATUS --}}
                        <td class="px-6 py-5">

                            @if ($pesanan->status === 'menunggu')

                                <span class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold text-yellow-600 dark:text-yellow-400">
                                    Menunggu
                                </span>

                            @elseif ($pesanan->status === 'diproses')

                                <span class="rounded-full bg-blue-500/10 px-3 py-1 text-xs font-semibold text-blue-600 dark:text-blue-400">
                                    Diproses
                                </span>

                            @elseif ($pesanan->status === 'selesai')

                                <span class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-600 dark:text-green-400">
                                    Selesai
                                </span>

                            @endif

                        </td>


                        {{-- AKSI --}}
                        <td class="px-6 py-5">

                            @if ($pesanan->status === 'menunggu')

                                <form
                                    action="{{ route('siswa.pesanan.process', $pesanan->id) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="rounded-xl bg-green-500 px-4 py-2 text-xs font-bold text-gray-950 transition hover:bg-green-400"
                                    >
                                        Proses
                                    </button>

                                </form>

                            @elseif ($pesanan->status === 'diproses')

                                <span class="text-xs font-semibold text-blue-500">
                                    Menunggu pembeli
                                </span>

                            @else

                                <span class="text-xs font-semibold text-green-500">
                                    Selesai
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="px-6 py-12 text-center text-sm text-gray-500"
                        >
                            Belum ada pesanan untuk produk kamu.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection