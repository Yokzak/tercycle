<div class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-white/10 dark:bg-white/[0.03]">

    <div class="flex gap-4">

        {{-- IMAGE --}}
        <div class="flex h-24 w-24 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-gray-100 dark:bg-white/5 sm:h-28 sm:w-28">

            @if ($detail->produk->gambar)

                <img
                    src="{{ asset('storage/' . $detail->produk->gambar) }}"
                    alt="{{ $detail->produk->nama_produk }}"
                    class="h-full w-full object-cover"
                >

            @else

                <span class="text-4xl">
                    📦
                </span>

            @endif

        </div>


        {{-- DETAIL --}}
        <div class="min-w-0 flex-1">

            <div class="flex items-start justify-between gap-3">

                <div class="min-w-0">

                    <p class="text-xs font-medium text-green-500">
                        {{ $detail->produk->kategoriProduk->nama_kategori ?? 'Tanpa Kategori' }}
                    </p>

                    <h3 class="mt-1 truncate font-bold">
                        {{ $detail->produk->nama_produk }}
                    </h3>

                </div>


                {{-- DELETE --}}
                <form
                    action="{{ route('siswa.keranjang.destroy', $detail) }}"
                    method="POST"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 transition hover:bg-red-500/10 hover:text-red-500"
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
                                d="M6 7h12M9 7V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2m2 0v12a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1V7m3 4v6m4-6v6"
                            />
                        </svg>
                    </button>

                </form>

            </div>


            <div class="mt-4 flex items-end justify-between gap-4">

                {{-- PRICE --}}
                <div>

                    <p class="text-xs text-gray-500">
                        Harga
                    </p>

                    <p class="mt-1 font-black text-green-500">
                        {{ number_format($detail->produk->harga_poin, 0, ',', '.') }}
                        poin
                    </p>

                </div>


                {{-- QUANTITY --}}
                <div class="flex items-center rounded-xl border border-gray-200 dark:border-white/10">

                    {{-- DECREASE --}}
                    <form
                        action="{{ route('siswa.keranjang.decrease', $detail) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="flex h-9 w-9 items-center justify-center text-gray-500 hover:bg-gray-100 dark:hover:bg-white/5"
                        >
                            −
                        </button>

                    </form>


                    <span class="w-8 text-center text-sm font-bold">
                        {{ $detail->jumlah_produk }}
                    </span>


                    {{-- INCREASE --}}
                    <form
                        action="{{ route('siswa.keranjang.increase', $detail) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="flex h-9 w-9 items-center justify-center text-gray-500 hover:bg-gray-100 dark:hover:bg-white/5"
                        >
                            +
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>


    {{-- SUBTOTAL --}}
    <div class="mt-4 flex items-center justify-between border-t border-gray-200 pt-3 dark:border-white/10">

        <span class="text-xs text-gray-500">
            Subtotal
        </span>

        <span class="text-sm font-bold">

            {{ number_format(
                $detail->produk->harga_poin * $detail->jumlah_produk,
                0,
                ',',
                '.'
            ) }}

            poin

        </span>

    </div>

</div>