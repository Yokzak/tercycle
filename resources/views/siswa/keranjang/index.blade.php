@extends('layouts.siswa.app')

@section('title', 'Keranjang - Tercycle')

@section('topbar-subtitle', 'Belanja')

@section('topbar-title', 'Keranjang')

@section('content')

<div class="mx-auto max-w-7xl">

    <div class="mb-6 flex items-center justify-between gap-4">

        <div>
            <h2 class="text-2xl font-black tracking-tight">
                Keranjang
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Produk yang ingin kamu tukarkan dengan poin.
            </p>
        </div>

        @if ($keranjang->detailKeranjang->count() > 0)

            <span class="rounded-xl bg-green-500/10 px-4 py-2 text-sm font-semibold text-green-600">
                {{ $keranjang->detailKeranjang->sum('jumlah_produk') }}
                item
            </span>

        @endif

    </div>


    @if ($keranjang->detailKeranjang->isEmpty())

        <div class="flex flex-col items-center justify-center rounded-2xl border border-gray-200 bg-white px-6 py-20 text-center dark:border-white/10 dark:bg-white/[0.03]">

            <div class="flex h-20 w-20 items-center justify-center rounded-full bg-gray-100 text-4xl dark:bg-white/5">
                🛒
            </div>

            <h2 class="mt-5 text-lg font-bold">
                Keranjang masih kosong
            </h2>

            <p class="mt-2 max-w-sm text-sm text-gray-500">
                Belum ada produk yang masuk ke keranjang.
            </p>

            <a
                href="{{ route('siswa.produk.index') }}"
                class="mt-6 rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
            >
                Belanja Produk
            </a>

        </div>

    @else

        <div class="grid gap-6 lg:grid-cols-[1fr_360px]">

            {{-- PRODUCT LIST --}}
            <div class="space-y-4">

                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]">

                    <div class="flex items-center justify-between">

                        <div>

                            <h2 class="font-bold">
                                Produk Dipilih
                            </h2>

                            <p class="mt-1 text-xs text-gray-500">
                                {{ $keranjang->detailKeranjang->sum('jumlah_produk') }}
                                item dalam keranjang
                            </p>

                        </div>

                        <form
                            action="{{ route('siswa.keranjang.clear') }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="text-xs font-semibold text-red-500 hover:text-red-600"
                            >
                                Hapus Semua
                            </button>

                        </form>

                    </div>

                </div>


                {{-- ITEMS --}}
                @foreach ($keranjang->detailKeranjang as $detail)

                    @include(
                        'siswa.keranjang.partials.item',
                        ['detail' => $detail]
                    )

                @endforeach

            </div>


            {{-- SUMMARY --}}
            @include(
                'siswa.keranjang.partials.ringkasan',
                ['keranjang' => $keranjang]
            )

        </div>

    @endif

</div>

@endsection