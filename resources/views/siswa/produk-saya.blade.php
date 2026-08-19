@extends('layouts.siswa.app')
@section('title', 'Produk Saya')
@section('topbar-subtitle', 'Menu')
@section('topbar-title', 'Produk Saya')
@section('content')

<div class="mb-8">
    <p class="text-sm font-medium text-green-500">Marketplace</p>
    <h1 class="mt-2 text-3xl font-black">Produk Saya</h1>
    <p class="mt-1 text-sm text-gray-500">Kelola produk yang kamu jual di marketplace.</p>
</div>

@if (session('success'))

    <div class="mb-6 rounded-xl border border-green-500/20 bg-green-500/10 px-5 py-4 text-sm text-green-600 dark:text-green-400">
        {{ session('success') }}
    </div>

@endif


@if (session('error'))

    <div class="mb-6 rounded-xl border border-red-500/20 bg-red-500/10 px-5 py-4 text-sm text-red-600 dark:text-red-400">
        {{ session('error') }}
    </div>

@endif


@if ($produks->isEmpty())

    <div class="rounded-2xl border border-gray-200 bg-white px-6 py-16 text-center dark:border-white/10 dark:bg-white/[0.03]">
        <div class="mx-auto max-w-md">
            <h2 class="text-lg font-bold">Belum Ada Produk</h2>
            <p class="mt-2 text-sm text-gray-500">Kamu belum memiliki produk yang dijual di marketplace.</p>
            <a href="{{ route('siswa.produk.index') }}" class="mt-6 inline-block rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400">
                Jual Produk
            </a>
        </div>
    </div>

@else

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

        @foreach ($produks as $produk)

            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]">

                {{-- GAMBAR --}}
                <div class="aspect-video overflow-hidden bg-gray-100 dark:bg-white/5">

                    @if ($produk->gambar)

                        <img
                            src="{{ asset('storage/' . $produk->gambar) }}"
                            alt="{{ $produk->nama_produk }}"
                            class="h-full w-full object-cover"
                        >

                    @else

                        <div class="flex h-full items-center justify-center text-sm text-gray-400">
                            Tidak ada gambar
                        </div>

                    @endif

                </div>


                {{-- CONTENT --}}
                <div class="p-5">

                    {{-- STATUS APPROVAL --}}
                    <div class="mb-3">

                        @if ($produk->status_approval === 'menunggu')

                            <span class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold text-yellow-600 dark:text-yellow-400">
                                Menunggu Persetujuan
                            </span>

                        @elseif ($produk->status_approval === 'disetujui')

                            <span class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-600 dark:text-green-400">
                                Disetujui
                            </span>

                        @elseif ($produk->status_approval === 'ditolak')

                            <span class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-600 dark:text-red-400">
                                Ditolak
                            </span>

                        @endif

                    </div>


                    {{-- NAMA --}}
                    <h2 class="text-lg font-bold">
                        {{ $produk->nama_produk }}
                    </h2>


                    {{-- KATEGORI --}}
                    <p class="mt-1 text-xs text-gray-500">
                        {{ $produk->kategoriProduk->nama_kategori ?? 'Tanpa kategori' }}
                    </p>


                    {{-- HARGA --}}
                    <div class="mt-4">

                        <p class="text-xs text-gray-500">
                            Harga
                        </p>

                        <p class="text-xl font-black text-green-500">
                            {{ number_format($produk->harga_poin, 0, ',', '.') }}
                            <span class="text-sm font-semibold">
                                poin
                            </span>
                        </p>

                    </div>


                    {{-- STOK + STATUS --}}
                    <div class="mt-4 flex items-center justify-between">

                        <div>

                            <p class="text-xs text-gray-500">
                                Stok
                            </p>

                            <p class="font-semibold">
                                {{ $produk->stok }}
                            </p>

                        </div>


                        <div>

                            @if ($produk->status === 'tersedia')

                                <span class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-600 dark:text-green-400">
                                    Tersedia
                                </span>

                            @elseif ($produk->status === 'habis')

                                <span class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-600 dark:text-red-400">
                                    Habis
                                </span>

                            @elseif ($produk->status === 'tidak tersedia')

                                <span class="rounded-full bg-gray-500/10 px-3 py-1 text-xs font-semibold text-gray-600 dark:text-gray-400">
                                    Tidak Tersedia
                                </span>

                            @else

                                <span class="rounded-full bg-gray-500/10 px-3 py-1 text-xs font-semibold text-gray-600 dark:text-gray-400">
                                    {{ ucfirst($produk->status) }}
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- DESKRIPSI --}}
                    @if ($produk->deskripsi)

                        <p class="mt-4 line-clamp-2 text-sm text-gray-500">
                            {{ $produk->deskripsi }}
                        </p>

                    @endif


                    {{-- INFO APPROVAL --}}
                    @if ($produk->status_approval === 'menunggu')

                        <div class="mt-4 rounded-xl bg-yellow-500/10 px-4 py-3 text-xs text-yellow-700 dark:text-yellow-400">
                            Produk sedang menunggu persetujuan admin dan belum tampil di marketplace.
                        </div>

                    @elseif ($produk->status_approval === 'ditolak')

                        <div class="mt-4 rounded-xl bg-red-500/10 px-4 py-3 text-xs text-red-700 dark:text-red-400">
                            Produk ditolak oleh admin.
                        </div>

                    @endif

                </div>

            </div>

        @endforeach

    </div>

@endif

@endsection