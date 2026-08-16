<div
    class="flex flex-col items-center justify-center rounded-2xl border border-gray-200 bg-white px-6 py-20 text-center dark:border-white/10 dark:bg-white/[0.03]"
>

    <div
        class="flex h-20 w-20 items-center justify-center rounded-full bg-gray-100 text-4xl dark:bg-white/5"
    >
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