<!DOCTYPE html>
<html
    lang="id"
    x-data="{
        dark: localStorage.getItem('theme') !== 'light',
        filter: 'Semua',

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

        orders: [
            {
                id: '#TRC-00125',
                product: 'Pulpen Eco',
                qty: 2,
                total: 2000,
                date: '10 Agustus 2026',
                status: 'Diproses'
            },
            {
                id: '#TRC-00120',
                product: 'Tumbler Eco',
                qty: 1,
                total: 5000,
                date: '9 Agustus 2026',
                status: 'Selesai'
            },
            {
                id: '#TRC-00115',
                product: 'Totebag Daur Ulang',
                qty: 1,
                total: 3500,
                date: '7 Agustus 2026',
                status: 'Selesai'
            },
            {
                id: '#TRC-00108',
                product: 'Notebook Daur Ulang',
                qty: 2,
                total: 5000,
                date: '5 Agustus 2026',
                status: 'Dibatalkan'
            }
        ],

        get filteredOrders() {
            if (this.filter === 'Semua') {
                return this.orders;
            }

            return this.orders.filter(
                order => order.status === this.filter
            );
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

    <title>Pesanan - Tercycle</title>

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


        {{-- MENU --}}

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


            {{-- PRODUK --}}

            <a
                href="/siswa/produk"
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
                        d="M20 7 12 3 4 7m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                    />
                </svg>

                Produk

            </a>


            {{-- PESANAN ACTIVE --}}

            <a
                href="/siswa/pesanan"
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
                Transaksi
            </p>

            <h1 class="font-bold">
                Pesanan Saya
            </h1>

        </div>


        <div class="flex items-center gap-4">

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
                        d="M12 3v2m0 14v2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M3 12h2m14 0h2M4.93 19.07l-1.42-1.42m12.72-12.72 1.42-1.42"
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


        {{-- PAGE HEADER --}}

        <div class="mb-8">

            <p class="text-sm font-medium text-green-500">
                Riwayat Transaksi
            </p>

            <h2 class="mt-2 text-3xl font-black">
                Pesanan Saya
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Pantau semua pembelian produk yang kamu lakukan.
            </p>

        </div>



        {{-- ================================================= --}}
        {{-- SUMMARY --}}
        {{-- ================================================= --}}

        <div
            class="grid gap-4 sm:grid-cols-3"
        >

            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs text-gray-500">
                    Total Pesanan
                </p>

                <p class="mt-2 text-2xl font-black">
                    4
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs text-gray-500">
                    Sedang Diproses
                </p>

                <p class="mt-2 text-2xl font-black text-yellow-500">
                    1
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs text-gray-500">
                    Selesai
                </p>

                <p class="mt-2 text-2xl font-black text-green-500">
                    2
                </p>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- FILTER --}}
        {{-- ================================================= --}}

        <div class="mt-8 flex flex-wrap gap-2">

            <template
                x-for="item in ['Semua', 'Diproses', 'Selesai', 'Dibatalkan']"
                :key="item"
            >

                <button
                    type="button"
                    @click="filter = item"
                    class="rounded-xl px-4 py-2.5 text-xs font-semibold transition"
                    :class="
                        filter === item
                            ? 'bg-green-500 text-gray-950'
                            : 'border border-gray-200 bg-white text-gray-500 hover:border-green-500 hover:text-green-500 dark:border-white/10 dark:bg-white/[0.03]'
                    "
                    x-text="item"
                ></button>

            </template>

        </div>



        {{-- ================================================= --}}
        {{-- ORDER LIST --}}
        {{-- ================================================= --}}

        <div class="mt-5 space-y-4">


            <template
                x-for="order in filteredOrders"
                :key="order.id"
            >

                <div
                    class="rounded-2xl border border-gray-200 bg-white p-6 transition hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
                >

                    <div
                        class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between"
                    >


                        {{-- LEFT --}}

                        <div class="flex items-center gap-4">

                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-green-500/10 text-xl font-bold text-green-500"
                            >
                                T
                            </div>


                            <div>

                                <div
                                    class="flex flex-wrap items-center gap-2"
                                >

                                    <p
                                        class="font-bold"
                                        x-text="order.id"
                                    >
                                        #TRC-00125
                                    </p>

                                    <span
                                        class="rounded-full bg-gray-100 px-2 py-1 text-[10px] font-semibold text-gray-500 dark:bg-white/5"
                                        x-text="order.date"
                                    >
                                        10 Agustus 2026
                                    </span>

                                </div>


                                <p
                                    class="mt-1 text-sm text-gray-500"
                                >

                                    <span x-text="order.product">
                                        Pulpen Eco
                                    </span>

                                    <span>
                                        ·
                                    </span>

                                    <span>
                                        Qty
                                    </span>

                                    <span x-text="order.qty">
                                        2
                                    </span>

                                </p>

                            </div>

                        </div>



                        {{-- RIGHT --}}

                        <div
                            class="flex items-center justify-between gap-6 md:justify-end"
                        >

                            <div class="text-left md:text-right">

                                <p class="text-[10px] uppercase tracking-wider text-gray-400">
                                    Total
                                </p>

                                <p
                                    class="font-bold text-green-500"
                                >

                                    <span
                                        x-text="order.total.toLocaleString('id-ID')"
                                    >
                                        2.000
                                    </span>

                                    poin

                                </p>

                            </div>


                            {{-- STATUS --}}

                            <span
                                class="rounded-full px-3 py-1.5 text-xs font-semibold"
                                :class="{
                                    'bg-yellow-500/10 text-yellow-600 dark:text-yellow-400':
                                        order.status === 'Diproses',

                                    'bg-green-500/10 text-green-600 dark:text-green-400':
                                        order.status === 'Selesai',

                                    'bg-red-500/10 text-red-600 dark:text-red-400':
                                        order.status === 'Dibatalkan'
                                }"
                                x-text="order.status"
                            >
                                Diproses
                            </span>


                            <button
                                type="button"
                                class="rounded-xl border border-gray-200 px-4 py-2 text-xs font-semibold text-gray-600 transition hover:border-green-500 hover:text-green-500 dark:border-white/10 dark:text-gray-300"
                            >
                                Detail
                            </button>

                        </div>

                    </div>

                </div>

            </template>


            {{-- EMPTY --}}

            <div
                x-show="filteredOrders.length === 0"
                class="rounded-2xl border border-dashed border-gray-300 py-16 text-center dark:border-white/10"
            >

                <p class="font-semibold">
                    Belum ada pesanan
                </p>

                <p class="mt-1 text-sm text-gray-500">
                    Pesanan dengan status ini belum tersedia.
                </p>

            </div>

        </div>



        {{-- INFO --}}

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
                        Informasi pesanan
                    </p>

                    <p class="mt-1 text-xs leading-5 text-gray-500">
                        Pesanan akan diproses oleh admin setelah pembelian
                        berhasil. Status pesanan dapat berubah sesuai
                        proses pengambilan atau penyerahan produk.
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