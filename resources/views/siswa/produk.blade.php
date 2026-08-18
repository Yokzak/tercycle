@extends('layouts.siswa.app')

@section('title', 'Produk - Tercycle')

@section('topbar-subtitle', 'Marketplace')

@section('topbar-title', 'Produk Tercycle')

@section('content')


<div
    x-data="{
        kategori: [
        {
        id: null, nama_kategori: 'Semua'
        },
        ...@js($kategoriProduk)
        ],
        kategoriAktif: null,
        productModal: false,
        search: '',
        category: 'Semua',

        buyModal: false,
        selectedProduct: null,
        buyQuantity: 1,

        openBuyModal(product) {
            this.selectedProduct = product;
            this.buyQuantity = 1;
            this.buyModal = true;
        },

        closeBuyModal() {
            this.buyModal = false;
            this.selectedProduct = null;
            this.buyQuantity = 1;
        },

        get buyTotal() {
            if (!this.selectedProduct) return 0;

            return this.selectedProduct.price * this.buyQuantity;
        },

        products: @js(
            $produk->map(function ($produk) {
                return [
                    'id' => $produk->id,
                    'name' => $produk->nama_produk,
                    'category' => $produk->kategoriProduk->nama_kategori ?? 'Tanpa Kategori',
                    'price' => $produk->harga_poin,
                    'stock' => $produk->stok,
                    'description' => $produk->deskripsi,
                    'image' => $produk->gambar,
                ];
            })
        ),

        get filteredProducts() {
            return this.products.filter(product => {
                const matchSearch =
                    product.name
                        .toLowerCase()
                        .includes(this.search.toLowerCase());

                const matchCategory =
                    this.category === 'Semua' ||
                    product.category === this.category;

                return matchSearch && matchCategory;
            });
        }
    }"
>

    {{-- HEADER --}}

    <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-center">

        <div>
            <h2 class="text-2xl font-black">
                Tukarkan Poinmu
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Gunakan poin yang kamu kumpulkan untuk mendapatkan
                produk ramah lingkungan.
            </p>
        </div>

        <button
            type="button"
            @click="productModal = true"
            class="inline-flex items-center gap-2 rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
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
                    d="M12 5v14M5 12h14"
                />
            </svg>

            Tambah Produk
        </button>

    </div>


    {{-- SEARCH & CATEGORY --}}

    <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div class="relative w-full sm:max-w-md">

            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                />
            </svg>

            <input
                type="text"
                x-model="search"
                placeholder="Cari produk..."
                class="w-full rounded-xl border border-gray-200 bg-white py-3 pl-11 pr-4 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/10 dark:border-white/10 dark:bg-white/[0.03]"
            >

        </div>


        <div class="flex gap-2 overflow-x-auto">

            <template
                x-for="item in kategori"
                :key="item.id ?? 'semua'"
            >

                <button
                    type="button"
                    @click="kategoriAktif = item.id"
                    class="whitespace-nowrap rounded-xl px-4 py-2.5 text-xs font-semibold transition"
                    :class="
                        kategoriAktif === item.id
                            ? 'bg-green-500 text-gray-950'
                            : 'border border-gray-200 bg-white text-gray-500 hover:border-green-500 hover:text-green-500 dark:border-white/10 dark:bg-white/[0.03]'
                    "
                    x-text="item.nama_kategori"
                ></button>

            </template>

        </div>

    </div>


    {{-- PRODUCT GRID --}}

    <div class="mt-8 grid gap-5 sm:grid-cols-2 xl:grid-cols-3">

        <template
            x-for="product in filteredProducts"
            :key="product.id"
        >

            <div
                class="group overflow-hidden rounded-2xl border border-gray-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-green-500/30 hover:shadow-lg hover:shadow-green-500/5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                {{-- IMAGE --}}

                <div
                    class="flex h-48 items-center justify-center overflow-hidden bg-gray-100 dark:bg-white/5"
                >

                    <template x-if="product.image">

                        <img
                            :src="'/storage/' + product.image"
                            :alt="product.name"
                            class="h-full w-full object-cover"
                        >

                    </template>

                    <template x-if="!product.image">

                        <span class="text-6xl text-gray-400">
                            📦
                        </span>

                    </template>

                </div>


                {{-- INFO --}}

                <div class="p-5">

                    <div class="flex items-start justify-between gap-3">

                        <div>

                            <p
                                class="text-[11px] font-semibold uppercase tracking-wider text-green-500"
                                x-text="product.category"
                            ></p>

                            <h3
                                class="mt-1 font-bold"
                                x-text="product.name"
                            ></h3>

                        </div>

                        <span class="rounded-full bg-gray-100 px-2.5 py-1 text-[10px] font-semibold text-gray-500 dark:bg-white/5">
                            Stok
                            <span x-text="product.stock"></span>
                        </span>

                    </div>


                    <div class="mt-5 flex items-end justify-between">

                        <div>

                            <p class="text-[11px] text-gray-400">
                                Harga
                            </p>

                            <p class="text-xl font-black text-green-500">

                                <span
                                    x-text="product.price.toLocaleString('id-ID')"
                                ></span>

                                <span class="text-xs font-semibold">
                                    poin
                                </span>

                            </p>

                        </div>


                        <div class="flex gap-2">

                            <form :action="`{{ route('siswa.keranjang.store', ['produk' => '__ID__']) }}`.replace('__ID__', product.id)" method="POST">
                                @csrf
                                <button type="submit" class="rounded-xl bg-gray-100 px-4 py-2.5 text-xs font-bold text-gray-950 transition hover:bg-green-400">
                                    + Keranjang
                                </button>
                            </form>

                            <button type="button" @click="openBuyModal(product)" class="rounded-xl bg-green-500 px-4 py-2.5 text-xs font-bold text-gray-950 transition hover:bg-green-400">
                                Beli
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </template>


        {{-- EMPTY --}}

        <div
            x-show="filteredProducts.length === 0"
            class="col-span-full rounded-2xl border border-dashed border-gray-300 py-16 text-center dark:border-white/10"
        >

            <p class="font-semibold">
                Produk tidak ditemukan
            </p>

            <p class="mt-1 text-sm text-gray-500">
                Coba gunakan kata pencarian lain.
            </p>

        </div>

    </div>


    {{-- INFO --}}

    <div class="mt-8 rounded-2xl border border-green-500/20 bg-green-500/5 p-5">

        <div class="flex gap-4">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green-500/10 font-bold text-green-500">
                i
            </div>

            <div>

                <p class="text-sm font-semibold">
                    Cara membeli produk
                </p>

                <p class="mt-1 text-xs leading-5 text-gray-500">
                    Pilih produk yang kamu inginkan, pastikan saldo
                    poin mencukupi, lalu lakukan pembelian. Poin akan
                    otomatis dipotong setelah pesanan berhasil dibuat.
                </p>

            </div>

        </div>

    </div>


    {{-- MODAL TAMBAH PRODUK --}}

    <div
        x-show="productModal"
        x-transition.opacity
        x-effect="document.body.style.overflow = productModal ? 'hidden' : ''"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
        style="display: none;"
    >

        <div
            class="absolute inset-0 bg-black/50 backdrop-blur-md"
            @click="productModal = false"
        ></div>


        <div
            x-show="productModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.stop
            class="no-scrollbar relative max-h-[85vh] w-full max-w-md overflow-y-auto overscroll-contain rounded-2xl bg-white p-4 shadow-2xl dark:bg-gray-900 sm:p-5"
        >

            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10">

                <div>

                    <h2 class="text-lg font-bold">
                        Tambah Produk
                    </h2>

                    <p class="mt-1 text-xs text-gray-500">
                        Masukkan informasi produk yang ingin dijual.
                    </p>

                </div>

                <button
                    type="button"
                    @click="productModal = false"
                    class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/10 dark:hover:text-white"
                >
                    ✕
                </button>

            </div>


            <form
                action="{{ route('siswa.produk.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="p-6"
            >

                @csrf

                {{-- NAMA --}}

                <div>

                    <label
                        for="nama_produk"
                        class="mb-2 block text-sm font-semibold"
                    >
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        id="nama_produk"
                        name="nama_produk"
                        placeholder="Contoh: Tumbler Eco"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                    >

                </div>


                {{-- DESKRIPSI --}}

                <div class="mt-5">

                    <label
                        for="deskripsi"
                        class="mb-2 block text-sm font-semibold"
                    >
                        Deskripsi
                    </label>

                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        rows="3"
                        placeholder="Deskripsi singkat produk..."
                        class="w-full resize-none rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                    ></textarea>

                </div>


                {{-- HARGA + STOK --}}

                <div class="mt-5 grid gap-4 sm:grid-cols-2">

                    <div>

                        <label
                            for="harga_poin"
                            class="mb-2 block text-sm font-semibold"
                        >
                            Harga Poin
                        </label>

                        <input
                            type="number"
                            id="harga_poin"
                            name="harga_poin"
                            min="1"
                            placeholder="5000"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                        >

                    </div>


                    <div>

                        <label
                            for="stok"
                            class="mb-2 block text-sm font-semibold"
                        >
                            Stok
                        </label>

                        <input
                            type="number"
                            id="stok"
                            name="stok"
                            min="0"
                            placeholder="10"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                        >

                    </div>

                </div>


                {{-- KATEGORI --}}

                <div class="mt-5">

                    <label
                        for="kategori_produk_id"
                        class="mb-2 block text-sm font-semibold"
                    >
                        Kategori
                    </label>

                    <select
                        id="kategori_produk_id"
                        name="kategori_produk_id"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                    >

                        <option value="">
                            Pilih kategori
                        </option>

                        @foreach ($kategoriProduk as $item)

                            <option value="{{ $item->id }}">
                                {{ $item->nama_kategori }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- GAMBAR --}}

                <div class="mt-5">

                    <label
                        for="gambar"
                        class="mb-2 block text-sm font-semibold"
                    >
                        Gambar Produk
                    </label>

                    <input
                        type="file"
                        id="gambar"
                        name="gambar"
                        accept="image/*"
                        class="block w-full cursor-pointer rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-500 file:mr-4 file:border-0 file:bg-green-500 file:px-4 file:py-3 file:font-semibold file:text-gray-950 hover:file:bg-green-400 dark:border-white/10 dark:bg-gray-950"
                    >

                    <p class="mt-2 text-xs text-gray-400">
                        Format JPG, PNG, atau WEBP.
                    </p>

                </div>


                {{-- BUTTON --}}

                <div class="mt-7 flex justify-end gap-3 border-t border-gray-200 pt-5 dark:border-white/10">

                    <button
                        type="button"
                        @click="productModal = false"
                        class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-100 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/5"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
                    >
                        Simpan Produk
                    </button>

                </div>
            </form>
        </div>
    </div>

    {{-- MODAL BELI PRODUK --}}

    <div
        x-show="buyModal"
        x-transition.opacity
        x-effect="document.body.style.overflow = buyModal ? 'hidden' : ''"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
        style="display: none;"
    >
        <div
            class="absolute inset-0 bg-black/50 backdrop-blur-md"
            @click="closeBuyModal()"
        ></div>

        <div
            x-show="buyModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.stop
            class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900"
        >

            {{-- HEADER --}}

            <div class="flex items-start justify-between">

                <div>
                    <h2 class="text-lg font-bold">
                        Beli Produk
                    </h2>

                    <p class="mt-1 text-xs text-gray-500">
                        Atur jumlah produk yang ingin kamu beli.
                    </p>
                </div>

                <button
                    type="button"
                    @click="closeBuyModal()"
                    class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 dark:hover:bg-white/10"
                >
                    ✕
                </button>

            </div>


            {{-- PRODUK --}}

            <div
                class="mt-6 rounded-xl border border-gray-200 p-4 dark:border-white/10"
            >

                <div class="flex gap-4">

                    <div
                        class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-gray-100 dark:bg-white/5"
                    >

                        <template x-if="selectedProduct?.image">

                            <img
                                :src="'/storage/' + selectedProduct.image"
                                :alt="selectedProduct?.name"
                                class="h-full w-full object-cover"
                            >

                        </template>

                        <template x-if="!selectedProduct?.image">

                            <span class="text-3xl">
                                📦
                            </span>

                        </template>

                    </div>


                    <div class="min-w-0">

                        <p
                            class="text-xs font-semibold text-green-500"
                            x-text="selectedProduct?.category"
                        ></p>

                        <h3
                            class="mt-1 truncate font-bold"
                            x-text="selectedProduct?.name"
                        ></h3>

                        <p class="mt-1 text-sm text-gray-500">

                            <span
                                x-text="selectedProduct?.price?.toLocaleString('id-ID')"
                            ></span>

                            poin / produk

                        </p>

                    </div>

                </div>

            </div>


            {{-- JUMLAH --}}

            <div class="mt-6">

                <div class="flex items-center justify-between">

                    <label class="text-sm font-semibold">
                        Jumlah
                    </label>

                    <span class="text-xs text-gray-500">

                        Stok:
                        <span x-text="selectedProduct?.stock"></span>

                    </span>

                </div>


                <div class="mt-3 flex items-center gap-3">

                    <button
                        type="button"
                        @click="
                            if (buyQuantity > 1) {
                                buyQuantity--;
                            }
                        "
                        class="flex h-11 w-11 items-center justify-center rounded-xl border border-gray-200 text-lg font-bold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/10"
                    >
                        −
                    </button>


                    <div
                        class="flex h-11 flex-1 items-center justify-center rounded-xl border border-gray-200 font-bold dark:border-white/10"
                        x-text="buyQuantity"
                    ></div>


                    <button
                        type="button"
                        @click="
                            if (
                                selectedProduct &&
                                buyQuantity < selectedProduct.stock
                            ) {
                                buyQuantity++;
                            }
                        "
                        class="flex h-11 w-11 items-center justify-center rounded-xl border border-gray-200 text-lg font-bold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/10"
                    >
                        +
                    </button>

                </div>

            </div>


            {{-- TOTAL --}}

            <div
                class="mt-6 rounded-xl bg-green-500/10 p-4"
            >

                <div class="flex items-center justify-between">

                    <span class="text-sm text-gray-500">
                        Total
                    </span>

                    <span
                        class="text-xl font-black text-green-500"
                        x-text="' ' + buyTotal.toLocaleString('id-ID') + ' poin'"
                    ></span>

                </div>

            </div>


            {{-- BUTTON --}}

            <div class="mt-6 flex gap-3">

                <button
                    type="button"
                    @click="closeBuyModal()"
                    class="flex-1 rounded-xl border border-gray-200 px-4 py-3 text-sm font-semibold text-gray-600 hover:bg-gray-100 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/5"
                >
                    Batal
                </button>


                <form
                    method="POST"
                    action="{{ route('siswa.pesanan.store') }}"
                    class="flex-1"
                >

                    @csrf

                    <input
                        type="hidden"
                        name="produk_id"
                        :value="selectedProduct?.id"
                    >

                    <input
                        type="hidden"
                        name="jumlah_produk"
                        :value="buyQuantity"
                    >

                    <button
                        type="submit"
                        class="w-full rounded-xl bg-green-500 px-4 py-3 text-sm font-bold text-gray-950 hover:bg-green-400"
                    >
                        Lanjutkan Pesanan
                    </button>

                </form>

            </div>

        </div>

    </div>
</div>

@endsection