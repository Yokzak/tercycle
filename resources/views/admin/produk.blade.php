<!DOCTYPE html>
<html
    lang="id"
    x-data="{
        dark: localStorage.getItem('theme') !== 'light',
        sidebarOpen: false,
        logoutModal: false,

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

    <title>Produk - Admin Tercycle</title>

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
    class= "no-scrollbar fixed inset-y-0 left-0 z-50 w-64 overflow-y-auto border-r border-gray-200 bg-white transition-transform duration-300 dark:border-white/10 dark:bg-gray-950 lg:translate-x-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
>

    <div class="flex h-full flex-col">

        {{-- LOGO --}}

        <div
            class="flex h-20 items-center border-b border-gray-200 px-6 dark:border-white/10"
        >

            <a
                href="/admin/dashboard"
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

        <nav class="flex-1 space-y-1 px-4 py-6 overflow-y-auto">

            <p
                class="mb-3 px-3 text-[11px] font-bold uppercase tracking-wider text-gray-400"
            >
                Overview
            </p>


            {{-- DASHBOARD --}}

            <a
                href="/admin/dashboard"
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
                        d="M3 10.5 12 3l9 7.5M5 9.5V21h14V9.5M9 21v-6h6v6"
                    />
                </svg>

                Dashboard
            </a>


            {{-- PENUKARAN --}}

            <a
                href="/admin/penukaran"
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
                        d="M7 7h10M7 12h10M7 17h10M5 7h.01M5 12h.01M5 17h.01"
                    />
                </svg>

                Penukaran Botol
            </a>


            <p
                class="mb-3 mt-8 px-3 text-[11px] font-bold uppercase tracking-wider text-gray-400"
            >
                Management
            </p>


            {{-- BOTOL --}}

            <a
                href="/admin/botol"
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
                        d="M8 3h8M9 3v4l-2 3v8a3 3 0 0 0 3 3h4a3 3 0 0 0 3-3v-8l-2-3V3"
                    />
                </svg>

                Jenis Botol
            </a>


            {{-- SISWA --}}

            <a
                href="/admin/siswa"
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
                        d="M15 19a6 6 0 0 0-12 0m6-8a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM18 8v6m3-3h-6"
                    />
                </svg>

                Siswa
            </a>


            {{-- PRODUK --}}

            <a
                href="/admin/produk"
                class="flex items-center gap-3 rounded-xl bg-green-500/10 px-3 py-3 text-sm font-semibold text-green-500
                transition hover:bg-green-500/20 hover:text-green-600 dark:bg-green-500/20 dark:text-green-400 dark:hover:bg-green-500/30 dark:hover:text-green-300"
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


            {{-- TRANSAKSI --}}

            <a
                href="/admin/transaksi"
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
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>

                Transaksi
            </a>

            {{-- Profil --}}

            <a
                href="/admin/profil"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
            >
                <span class="text-lg">⚙</span>
                Profil
            </a>    


        </nav>


        {{-- ADMIN PROFILE SIDEBAR --}}

        <div
            class="border-t border-gray-200 p-4 dark:border-white/10"
        >

            <div class="flex items-center gap-3">

                <div
                    class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-900 font-bold text-white dark:bg-white dark:text-gray-950"
                >
                    A
                </div>

                <div class="min-w-0 flex-1">

                    <p class="truncate text-sm font-semibold">
                        Administrator
                    </p>

                    <p class="text-xs text-gray-500">
                        Admin
                    </p>

                </div>

                {{-- LOGOUT --}}

                {{-- LOGOUT --}}

                <button
                    type="button"
                    @click="logoutModal = true"
                    class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-red-500/10 hover:text-red-500"
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
                            d="M15 12H3m0 0 4-4m-4 4 4 4M15 4h3a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-3"
                        />
                    </svg>
                </button>
            </div>

        </div>

    </div>

</aside>

<div
    x-show="sidebarOpen"
    x-transition.opacity
    @click="sidebarOpen = false"
    class="fixed inset-0 z-40 bg-black/50 backdrop-blur-md lg:hidden"
    style="display: none;"
></div>

{{-- ========================================================= --}}
{{-- MAIN --}}
{{-- ========================================================= --}}

<div class="lg:pl-64">


    {{-- TOPBAR --}}

    <header
        class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-gray-200 bg-white/90 px-6 backdrop-blur-xl dark:border-white/10 dark:bg-gray-950/90 lg:px-8"
    >

        <div class="flex items-center gap-3">


            {{-- HAMBURGER MOBILE --}}

            <button
                type="button"
                @click="sidebarOpen = true"
                class="flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-gray-50 text-gray-700 transition hover:bg-gray-100 dark:border-white/10 dark:bg-white/5 dark:text-gray-300 dark:hover:bg-white/10 lg:hidden"
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
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>

            </button>


            <div>

                <p class="text-xs font-medium text-gray-500 sm:text-sm">
                    Management
                </p>

                <h1 class="font-bold">
                    Produk
                </h1>

            </div>

        </div>



        {{-- THEME --}}

        <button
            type="button"
            @click="toggleTheme()"
            class="flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-gray-50 text-gray-700 transition hover:bg-gray-100 dark:border-white/10 dark:bg-white/5 dark:text-gray-300 dark:hover:bg-white/10"
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
                    d="M12 3v2m0 14v2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M3 12h2m14 0h2M4.93 19.07l1.42-1.42m11.3-11.3 1.42-1.42M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"
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

    </header>



    {{-- CONTENT --}}

    <main class="mx-auto max-w-7xl px-6 py-8 lg:px-8">


        {{-- HEADER --}}

        <div
            class="flex flex-col justify-between gap-5 sm:flex-row sm:items-center"
        >

            <div>

                <h2 class="text-2xl font-black">
                    Kelola Produk
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Kelola produk yang dapat dibeli menggunakan poin.
                </p>

            </div>

        </div>



        {{-- STATISTICS --}}

        <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Total Produk
                </p>

                <p class="mt-2 text-3xl font-black">
                    24
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Produk Aktif
                </p>

                <p class="mt-2 text-3xl font-black text-green-500">
                    19
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Total Stok
                </p>

                <p class="mt-2 text-3xl font-black">
                    487
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Terjual Bulan Ini
                </p>

                <p class="mt-2 text-3xl font-black">
                    86
                </p>

            </div>

        </div>



        {{-- FILTER --}}

        <div
            class="mt-8 flex flex-col gap-4 rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03] lg:flex-row lg:items-center lg:justify-between"
        >

            <div class="flex flex-col gap-3 sm:flex-row">

                <div class="relative">

                    <input
                        type="text"
                        placeholder="Cari produk..."
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 pl-10 text-sm outline-none focus:border-green-500 sm:w-64 dark:border-white/10 dark:bg-gray-900"
                    >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="absolute left-3 top-3 h-4 w-4 text-gray-400"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                        />

                    </svg>

                </div>


                <select
                    class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm outline-none focus:border-green-500 dark:border-white/10 dark:bg-gray-900"
                >

                    <option>
                        Semua Kategori
                    </option>

                    <option>
                        Alat Tulis
                    </option>

                    <option>
                        Fashion
                    </option>

                    <option>
                        Rumah Tangga
                    </option>

                    <option>
                        Aksesoris
                    </option>

                </select>


                <select
                    class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm outline-none focus:border-green-500 dark:border-white/10 dark:bg-gray-900"
                >

                    <option>
                        Semua Status
                    </option>

                    <option>
                        Aktif
                    </option>

                    <option>
                        Habis
                    </option>

                    <option>
                        Nonaktif
                    </option>

                </select>

            </div>


            <p class="text-xs text-gray-500">
                24 produk ditemukan
            </p>

        </div>



        {{-- PRODUCT GRID --}}

        <div
            class="mt-6 grid gap-5 sm:grid-cols-2 xl:grid-cols-3"
        >


            {{-- PRODUCT 1 --}}

            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="flex h-48 items-center justify-center bg-gray-100 dark:bg-white/5"
                >

                    <div class="text-7xl">
                        🖊️
                    </div>

                </div>


                <div class="p-5">

                    <div class="flex items-start justify-between gap-3">

                        <div>

                            <p class="text-xs font-medium text-green-500">
                                Alat Tulis
                            </p>

                            <h3 class="mt-1 font-bold">
                                Pulpen Eco
                            </h3>

                        </div>


                        <span
                            class="rounded-full bg-green-500/10 px-2.5 py-1 text-[11px] font-semibold text-green-500"
                        >
                            Aktif
                        </span>

                    </div>


                    <p class="mt-3 text-sm text-gray-500">
                        Pulpen ramah lingkungan dari bahan daur ulang.
                    </p>


                    <div
                        class="mt-5 flex items-end justify-between"
                    >

                        <div>

                            <p class="text-xs text-gray-500">
                                Harga
                            </p>

                            <p class="mt-1 text-xl font-black text-green-500">
                                1.000 poin
                            </p>

                        </div>


                        <div class="text-right">

                            <p class="text-xs text-gray-500">
                                Stok
                            </p>

                            <p class="mt-1 font-bold">
                                120
                            </p>

                        </div>

                    </div>


                    <div
                        class="mt-5 flex gap-2 border-t border-gray-200 pt-4 dark:border-white/10"
                    >

                        <button
                            class="flex-1 rounded-lg border border-gray-200 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                        >
                            Terima
                        </button>

                        <button
                            class="rounded-lg border border-red-500/20 px-4 py-2 text-xs font-semibold text-red-500 hover:bg-red-500/10"
                        >
                            Tolak
                        </button>

                    </div>

                </div>

            </div>



            {{-- PRODUCT 2 --}}

            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="flex h-48 items-center justify-center bg-gray-100 dark:bg-white/5"
                >

                    <div class="text-7xl">
                        🥤
                    </div>

                </div>


                <div class="p-5">

                    <div class="flex items-start justify-between gap-3">

                        <div>

                            <p class="text-xs font-medium text-green-500">
                                Rumah Tangga
                            </p>

                            <h3 class="mt-1 font-bold">
                                Tumbler Recycle
                            </h3>

                        </div>


                        <span
                            class="rounded-full bg-green-500/10 px-2.5 py-1 text-[11px] font-semibold text-green-500"
                        >
                            Aktif
                        </span>

                    </div>


                    <p class="mt-3 text-sm text-gray-500">
                        Tumbler reusable untuk mengurangi sampah plastik.
                    </p>


                    <div
                        class="mt-5 flex items-end justify-between"
                    >

                        <div>

                            <p class="text-xs text-gray-500">
                                Harga
                            </p>

                            <p class="mt-1 text-xl font-black text-green-500">
                                5.000 poin
                            </p>

                        </div>


                        <div class="text-right">

                            <p class="text-xs text-gray-500">
                                Stok
                            </p>

                            <p class="mt-1 font-bold">
                                42
                            </p>

                        </div>

                    </div>


                    <div
                        class="mt-5 flex gap-2 border-t border-gray-200 pt-4 dark:border-white/10"
                    >

                        <button
                            class="flex-1 rounded-lg border border-gray-200 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                        >
                            Terima
                        </button>

                        <button
                            class="rounded-lg border border-red-500/20 px-4 py-2 text-xs font-semibold text-red-500 hover:bg-red-500/10"
                        >
                            Tolak
                        </button>

                    </div>

                </div>

            </div>



            {{-- PRODUCT 3 --}}

            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="flex h-48 items-center justify-center bg-gray-100 dark:bg-white/5"
                >

                    <div class="text-7xl">
                        👕
                    </div>

                </div>


                <div class="p-5">

                    <div class="flex items-start justify-between gap-3">

                        <div>

                            <p class="text-xs font-medium text-green-500">
                                Fashion
                            </p>

                            <h3 class="mt-1 font-bold">
                                Kaos Recycle
                            </h3>

                        </div>


                        <span
                            class="rounded-full bg-green-500/10 px-2.5 py-1 text-[11px] font-semibold text-green-500"
                        >
                            Aktif
                        </span>

                    </div>


                    <p class="mt-3 text-sm text-gray-500">
                        Kaos berbahan serat hasil daur ulang.
                    </p>


                    <div
                        class="mt-5 flex items-end justify-between"
                    >

                        <div>

                            <p class="text-xs text-gray-500">
                                Harga
                            </p>

                            <p class="mt-1 text-xl font-black text-green-500">
                                8.000 poin
                            </p>

                        </div>


                        <div class="text-right">

                            <p class="text-xs text-gray-500">
                                Stok
                            </p>

                            <p class="mt-1 font-bold">
                                18
                            </p>

                        </div>

                    </div>


                    <div
                        class="mt-5 flex gap-2 border-t border-gray-200 pt-4 dark:border-white/10"
                    >

                        <button
                            class="flex-1 rounded-lg border border-gray-200 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                        >
                            Terima
                        </button>

                        <button
                            class="rounded-lg border border-red-500/20 px-4 py-2 text-xs font-semibold text-red-500 hover:bg-red-500/10"
                        >
                            Tolak
                        </button>

                    </div>

                </div>

            </div>



            {{-- PRODUCT 4 --}}

            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="flex h-48 items-center justify-center bg-gray-100 dark:bg-white/5"
                >

                    <div class="text-7xl">
                        👜
                    </div>

                </div>


                <div class="p-5">

                    <div class="flex items-start justify-between gap-3">

                        <div>

                            <p class="text-xs font-medium text-green-500">
                                Aksesoris
                            </p>

                            <h3 class="mt-1 font-bold">
                                Tote Bag Recycle
                            </h3>

                        </div>


                        <span
                            class="rounded-full bg-green-500/10 px-2.5 py-1 text-[11px] font-semibold text-green-500"
                        >
                            Aktif
                        </span>

                    </div>


                    <p class="mt-3 text-sm text-gray-500">
                        Tas belanja reusable berbahan kain daur ulang.
                    </p>


                    <div
                        class="mt-5 flex items-end justify-between"
                    >

                        <div>

                            <p class="text-xs text-gray-500">
                                Harga
                            </p>

                            <p class="mt-1 text-xl font-black text-green-500">
                                3.500 poin
                            </p>

                        </div>


                        <div class="text-right">

                            <p class="text-xs text-gray-500">
                                Stok
                            </p>

                            <p class="mt-1 font-bold">
                                76
                            </p>

                        </div>

                    </div>


                    <div
                        class="mt-5 flex gap-2 border-t border-gray-200 pt-4 dark:border-white/10"
                    >

                        <button
                            class="flex-1 rounded-lg border border-gray-200 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                        >
                            Terima
                        </button>

                        <button
                            class="rounded-lg border border-red-500/20 px-4 py-2 text-xs font-semibold text-red-500 hover:bg-red-500/10"
                        >
                            Tolak
                        </button>

                    </div>

                </div>

            </div>



            {{-- PRODUCT 5 HABIS --}}

            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white opacity-70 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="relative flex h-48 items-center justify-center bg-gray-100 dark:bg-white/5"
                >

                    <div class="text-7xl grayscale">
                        📒
                    </div>

                    <span
                        class="absolute right-4 top-4 rounded-full bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-500"
                    >
                        Stok Habis
                    </span>

                </div>


                <div class="p-5">

                    <p class="text-xs font-medium text-green-500">
                        Alat Tulis
                    </p>

                    <h3 class="mt-1 font-bold">
                        Buku Daur Ulang
                    </h3>

                    <p class="mt-3 text-sm text-gray-500">
                        Buku tulis yang dibuat dari kertas daur ulang.
                    </p>


                    <div
                        class="mt-5 flex items-end justify-between"
                    >

                        <div>

                            <p class="text-xs text-gray-500">
                                Harga
                            </p>

                            <p class="mt-1 text-xl font-black">
                                2.000 poin
                            </p>

                        </div>


                        <div class="text-right">

                            <p class="text-xs text-gray-500">
                                Stok
                            </p>

                            <p class="mt-1 font-bold text-red-500">
                                0
                            </p>

                        </div>

                    </div>


                    <div
                        class="mt-5 flex gap-2 border-t border-gray-200 pt-4 dark:border-white/10"
                    >

                        <button
                            class="flex-1 rounded-lg border border-gray-200 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                        >
                            Terima
                        </button>

                        <button
                            class="rounded-lg border border-red-500/20 px-4 py-2 text-xs font-semibold text-red-500 hover:bg-red-500/10"
                        >
                            Tolak
                        </button>

                    </div>

                </div>

            </div>

        </div>



        {{-- PAGINATION --}}

        <div
            class="mt-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
        >

            <p class="text-xs text-gray-500">
                Menampilkan 1-6 dari 24 produk
            </p>


            <div class="flex gap-2">

                <button
                    class="rounded-lg border border-gray-200 px-3 py-2 text-xs text-gray-400 dark:border-white/10"
                >
                    Sebelumnya
                </button>

                <button
                    class="rounded-lg bg-green-500 px-3 py-2 text-xs font-bold text-gray-950"
                >
                    1
                </button>

                <button
                    class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold dark:border-white/10"
                >
                    2
                </button>

                <button
                    class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold dark:border-white/10"
                >
                    3
                </button>

                <button
                    class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold dark:border-white/10"
                >
                    Selanjutnya
                </button>

            </div>

        </div>

    </main>

</div>

{{-- ========================================================= --}}
{{-- MODAL KONFIRMASI LOGOUT --}}
{{-- ========================================================= --}}

<div
    x-show="logoutModal"
    x-transition.opacity
    x-effect="document.body.style.overflow = logoutModal ? 'hidden' : ''"
    class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-4"
    style="display: none;"
>
    {{-- BACKDROP --}}
    <div
        class="absolute inset-0 bg-black/50 backdrop-blur-md"
        @click="logoutModal = false"
    ></div>


    {{-- MODAL --}}
    <div
        x-show="logoutModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @click.stop
        class="relative w-full max-w-sm rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900"
    >

        {{-- ICON --}}
        <div class="flex justify-center">

            <div
                class="flex h-12 w-12 items-center justify-center rounded-full bg-red-500/10 text-red-500"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="h-6 w-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m10 17 5-5-5-5m5 5H3"
                    />
                </svg>
            </div>

        </div>


        {{-- TEXT --}}
        <div class="mt-4 text-center">

            <h2 class="text-lg font-bold">
                Yakin mau logout?
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                Kamu akan keluar dari akun dan harus login kembali.
            </p>

        </div>


        {{-- BUTTON --}}
        <div class="mt-6 grid grid-cols-2 gap-3">

            {{-- BATAL --}}
            <button
                type="button"
                @click="logoutModal = false"
                class="rounded-xl border border-gray-200 px-4 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-100 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/5"
            >
                Batal
            </button>


            {{-- LOGOUT --}}
            <form
                action="/logout"
                method="POST"
            >
                @csrf

                <button
                    type="submit"
                    class="w-full rounded-xl bg-red-500 px-4 py-3 text-sm font-bold text-white transition hover:bg-red-600"
                >
                    Logout
                </button>

            </form>

        </div>

    </div>

</div>
</body>
</html>