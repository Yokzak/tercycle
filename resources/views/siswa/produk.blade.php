<!DOCTYPE html>
<html
    lang="id"
    x-data="{
        dark: localStorage.getItem('theme') !== 'light',

        toggleTheme() {
            this.dark = !this.dark;

            localStorage.setItem(
                'theme',
                this.dark ? 'dark' : 'light'
            );

            document.documentElement.classList.toggle(
                'dark',
                this.dark
            );
        },

        search: '',
        category: 'Semua',

        products: [
            {
                name: 'Pulpen Eco',
                category: 'Alat Tulis',
                price: 1000,
                stock: 25,
                icon: '✎'
            },
            {
                name: 'Notebook Daur Ulang',
                category: 'Alat Tulis',
                price: 2500,
                stock: 15,
                icon: '▤'
            },
            {
                name: 'Tumbler Eco',
                category: 'Perlengkapan',
                price: 5000,
                stock: 8,
                icon: '♧'
            },
            {
                name: 'Totebag Daur Ulang',
                category: 'Fashion',
                price: 3500,
                stock: 12,
                icon: '▱'
            },
            {
                name: 'Tempat Pensil Eco',
                category: 'Alat Tulis',
                price: 2000,
                stock: 20,
                icon: '▥'
            },
            {
                name: 'Gantungan Kunci',
                category: 'Aksesoris',
                price: 1500,
                stock: 30,
                icon: '◇'
            }
        ],

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
    x-init="
        document.documentElement.classList.toggle('dark', dark)
    "
    :class="{ 'dark': dark }"
>

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Produk - Tercycle</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>

</head>


<body
    class="min-h-screen bg-gray-50 text-gray-900 transition-colors duration-300 dark:bg-gray-950 dark:text-white"
>


{{-- ========================================================= --}}
{{-- SIDEBAR --}}
{{-- ========================================================= --}}

<aside
    class="fixed inset-y-0 left-0 z-40 hidden w-64 border-r border-gray-200 bg-white dark:border-white/10 dark:bg-gray-950 lg:block"
>

    <div class="flex h-full flex-col">

        {{-- LOGO --}}

        <div
            class="flex h-20 items-center border-b border-gray-200 px-6 dark:border-white/10"
        >

            <a
                href="/siswa/dashboard"
                class="flex items-center gap-3"
            >

                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-500 font-black text-gray-950"
                >
                    T
                </div>

                <span class="text-xl font-bold">
                    Ter<span class="text-green-500">cycle</span>
                </span>

            </a>

        </div>


        {{-- NAVIGATION --}}

        <nav class="flex-1 space-y-1 px-4 py-6">

            <p
                class="mb-3 px-3 text-[11px] font-bold uppercase tracking-wider text-gray-400"
            >
                Menu
            </p>


            {{-- DASHBOARD --}}

            <a
                href="/siswa/dashboard"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
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
                        d="M3 13h8V3H3v10Zm10 8h8V11h-8v10ZM3 21h8v-6H3v6Zm10-18v6h8V3h-8Z"
                    />
                </svg>

                Dashboard

            </a>


            {{-- POIN --}}

            <a
                href="/siswa/poin"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="h-5 w-5"
                >
                    <circle
                        cx="12"
                        cy="12"
                        r="9"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 7v5l3 2"
                    />
                </svg>

                Riwayat Poin

            </a>


            {{-- SETOR BOTOL --}}

            <a
                href="/siswa/tukar"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
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
                        d="M7 3h10M8 3v4l-2 3v8a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3v-8l-2-3V3"
                    />
                </svg>

                Setor Botol

            </a>


            {{-- PRODUK ACTIVE --}}

            <a
                href="/siswa/produk"
                class="flex items-center gap-3 rounded-xl bg-green-500/10 px-3 py-3 text-sm font-semibold text-green-500"
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
                        d="M20 7 12 3 4 7m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                    />
                </svg>

                Produk

            </a>


            {{-- PESANAN --}}

            <a
                href="/siswa/pesanan"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
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
                        d="M3 7h18M5 7v12h14V7M8 7V5a4 4 0 0 1 8 0v2"
                    />
                </svg>

                Pesanan

            </a>


            <p
                class="mb-3 mt-8 px-3 text-[11px] font-bold uppercase tracking-wider text-gray-400"
            >
                Account
            </p>


            {{-- PROFIL --}}

            <a
                href="/siswa/profil"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
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
                        d="M15 19a6 6 0 0 0-12 0m6-8a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z"
                    />
                </svg>

                Profil

            </a>

        </nav>


        {{-- USER --}}

        <div
            class="border-t border-gray-200 p-4 dark:border-white/10"
        >

            <div class="flex items-center gap-3">

                <div
                    class="flex h-10 w-10 items-center justify-center rounded-full bg-green-500 font-bold text-gray-950"
                >
                    K
                </div>

                <div>

                    <p class="text-sm font-semibold">
                        Kevin
                    </p>

                    <p class="text-xs text-gray-500">
                        Siswa
                    </p>

                </div>

            </div>

        </div>

    </div>

</aside>



{{-- ========================================================= --}}
{{-- MOBILE HEADER --}}
{{-- ========================================================= --}}

<div
    class="flex h-16 items-center justify-between border-b border-gray-200 bg-white px-5 dark:border-white/10 dark:bg-gray-950 lg:hidden"
>

    <a
        href="/siswa/dashboard"
        class="flex items-center gap-2"
    >

        <div
            class="flex h-9 w-9 items-center justify-center rounded-lg bg-green-500 font-black text-gray-950"
        >
            T
        </div>

        <span class="font-bold">
            Ter<span class="text-green-500">cycle</span>
        </span>

    </a>


    <button
        type="button"
        @click="toggleTheme()"
        class="flex h-9 w-9 items-center justify-center rounded-xl border border-gray-200 dark:border-white/10"
    >

        <svg
            x-show="dark"
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
                d="M12 3v2m0 14v2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M3 12h2m14 0h2M4.93 19.07l1.42-1.42m11.3-11.3 1.42-1.42"
            />
        </svg>

        <svg
            x-show="!dark"
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
                d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z"
            />
        </svg>

    </button>

</div>



{{-- ========================================================= --}}
{{-- MAIN --}}
{{-- ========================================================= --}}

<div class="lg:pl-64">


    {{-- TOPBAR --}}

    <header
        class="sticky top-0 z-30 hidden h-20 items-center justify-between border-b border-gray-200 bg-white/90 px-6 backdrop-blur-xl dark:border-white/10 dark:bg-gray-950/90 lg:flex lg:px-8"
    >

        <div>

            <p class="text-sm font-medium text-gray-500">
                Marketplace
            </p>

            <h1 class="font-bold">
                Produk Tercycle
            </h1>

        </div>


        <div class="flex items-center gap-4">

            {{-- SALDO --}}

            <div
                class="rounded-xl bg-green-500/10 px-4 py-2"
            >

                <p class="text-[10px] uppercase tracking-wide text-gray-500">
                    Saldo
                </p>

                <p class="text-sm font-bold text-green-500">
                    12.500 poin
                </p>

            </div>


            {{-- THEME --}}

            <button
                type="button"
                @click="toggleTheme()"
                class="flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-gray-50 text-gray-700 dark:border-white/10 dark:bg-white/5 dark:text-gray-300"
            >

                <svg
                    x-show="dark"
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
                        d="M12 3v2m0 14v2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M3 12h2m14 0h2M4.93 19.07l-1.42 1.42m12.72-12.72 1.42-1.42"
                    />
                </svg>

                <svg
                    x-show="!dark"
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
                        d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z"
                    />
                </svg>

            </button>

        </div>

    </header>



    {{-- CONTENT --}}

    <main class="mx-auto max-w-7xl px-6 py-8 lg:px-8">


        {{-- HEADER --}}

        <div class="mb-8">

            <p class="text-sm font-medium text-green-500">
                Marketplace
            </p>

            <h2 class="mt-2 text-3xl font-black">
                Tukarkan Poinmu
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Gunakan poin yang kamu kumpulkan untuk mendapatkan
                produk ramah lingkungan.
            </p>

        </div>



        {{-- ================================================= --}}
        {{-- SEARCH --}}
        {{-- ================================================= --}}

        <div
            class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
        >

            {{-- SEARCH BOX --}}

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


            {{-- CATEGORY --}}

            <div class="flex gap-2 overflow-x-auto">

                <template
                    x-for="item in ['Semua', 'Alat Tulis', 'Perlengkapan', 'Fashion', 'Aksesoris']"
                    :key="item"
                >

                    <button
                        type="button"
                        @click="category = item"
                        class="whitespace-nowrap rounded-xl px-4 py-2.5 text-xs font-semibold transition"
                        :class="
                            category === item
                                ? 'bg-green-500 text-gray-950'
                                : 'border border-gray-200 bg-white text-gray-500 hover:border-green-500 hover:text-green-500 dark:border-white/10 dark:bg-white/[0.03]'
                        "
                        x-text="item"
                    ></button>

                </template>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- PRODUCT GRID --}}
        {{-- ================================================= --}}

        <div
            class="mt-8 grid gap-5 sm:grid-cols-2 xl:grid-cols-3"
        >

            <template
                x-for="product in filteredProducts"
                :key="product.name"
            >

                <div
                    class="group overflow-hidden rounded-2xl border border-gray-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-green-500/30 hover:shadow-lg hover:shadow-green-500/5 dark:border-white/10 dark:bg-white/[0.03]"
                >


                    {{-- IMAGE PLACEHOLDER --}}

                    <div
                        class="flex h-48 items-center justify-center bg-gray-100 text-6xl text-gray-400 transition group-hover:bg-green-500/10 group-hover:text-green-500 dark:bg-white/5"
                    >

                        <span x-text="product.icon">
                            ✎
                        </span>

                    </div>


                    {{-- PRODUCT INFO --}}

                    <div class="p-5">

                        <div class="flex items-start justify-between gap-3">

                            <div>

                                <p
                                    class="text-[11px] font-semibold uppercase tracking-wider text-green-500"
                                    x-text="product.category"
                                >
                                    Alat Tulis
                                </p>

                                <h3
                                    class="mt-1 font-bold"
                                    x-text="product.name"
                                >
                                    Pulpen Eco
                                </h3>

                            </div>


                            <span
                                class="rounded-full bg-gray-100 px-2.5 py-1 text-[10px] font-semibold text-gray-500 dark:bg-white/5"
                            >

                                Stok
                                <span x-text="product.stock">
                                    25
                                </span>

                            </span>

                        </div>


                        <div class="mt-5 flex items-end justify-between">

                            <div>

                                <p class="text-[11px] text-gray-400">
                                    Harga
                                </p>

                                <p
                                    class="text-xl font-black text-green-500"
                                >

                                    <span
                                        x-text="product.price.toLocaleString('id-ID')"
                                    >
                                        1.000
                                    </span>

                                    <span class="text-xs font-semibold">
                                        poin
                                    </span>

                                </p>

                            </div>


                            <button
                                type="button"
                                class="rounded-xl bg-green-500 px-4 py-2.5 text-xs font-bold text-gray-950 transition hover:bg-green-400"
                            >
                                Beli
                            </button>

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



        {{-- ================================================= --}}
        {{-- INFO --}}
        {{-- ================================================= --}}

        <div
            class="mt-8 rounded-2xl border border-green-500/20 bg-green-500/5 p-5"
        >

            <div class="flex gap-4">

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green-500/10 font-bold text-green-500"
                >
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


    </main>



    {{-- FOOTER --}}

    <footer
        class="mt-10 border-t border-gray-200 dark:border-white/10"
    >

        <div
            class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-8"
        >

            <p class="text-xs text-gray-500">
                © {{ date('Y') }} Tercycle
            </p>

            <p class="text-xs text-gray-500">
                Bank Sampah Digital
            </p>

        </div>

    </footer>

</div>


</body>
</html>