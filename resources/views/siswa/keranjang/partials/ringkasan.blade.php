@php

    $totalItems = $keranjang->detailKeranjang->sum(
        'jumlah_produk'
    );

    $totalPrice = $keranjang->detailKeranjang->sum(
        fn ($detail) =>
            $detail->produk->harga_poin *
            $detail->jumlah_produk
    );

@endphp


<div>

    <div class="sticky top-24 rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]">

        <h2 class="font-bold">
            Ringkasan Pesanan
        </h2>


        <div class="mt-5 space-y-3">

            <div class="flex justify-between text-sm">

                <span class="text-gray-500">
                    Total item
                </span>

                <span class="font-semibold">
                    {{ $totalItems }}
                </span>

            </div>


            <div class="flex justify-between text-sm">

                <span class="text-gray-500">
                    Jenis produk
                </span>

                <span class="font-semibold">
                    {{ $keranjang->detailKeranjang->count() }}
                </span>

            </div>

        </div>


        <div class="my-5 border-t border-gray-200 dark:border-white/10"></div>


        <div class="flex items-end justify-between">

            <div>

                <p class="text-xs text-gray-500">
                    Total
                </p>

                <p class="mt-1 text-2xl font-black text-green-500">
                    {{ number_format($totalPrice, 0, ',', '.') }}
                </p>

            </div>

            <span class="text-sm font-semibold text-gray-500">
                poin
            </span>

        </div>


        <form
            action="{{ route('siswa.pesanan.store') }}"
            method="POST"
        >

            @csrf

            <button
                type="submit"
                class="mt-6 w-full rounded-xl bg-green-500 px-5 py-3.5 text-sm font-bold text-gray-950 transition hover:bg-green-400"
            >
                Lanjutkan Pesanan
            </button>

        </form>


        <a
            href="{{ route('siswa.produk.index') }}"
            class="mt-3 block w-full rounded-xl border border-gray-200 px-5 py-3.5 text-center text-sm font-semibold text-gray-600 transition hover:bg-gray-100 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/5"
        >
            Lanjut Belanja
        </a>

    </div>

</div>