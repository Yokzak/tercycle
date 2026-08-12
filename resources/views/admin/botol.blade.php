<!DOCTYPE html>
<html
    lang="id"
    x-data="{
        dark: localStorage.getItem('theme') !== 'light',
        sidebarOpen: false,
        logoutModal: false,
        bottleModal: false,

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

    <title>Jenis Botol - Admin Tercycle</title>

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
    class="fixed inset-y-0 left-0 z-50 w-64 border-r border-gray-200 bg-white transition-transform duration-300 dark:border-white/10 dark:bg-gray-950 lg:translate-x-0"
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
    class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm lg:hidden"
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

                    <p class="text-sm font-medium text-gray-500">
                        Management
                    </p>

                    <h1 class="font-bold">
                        Jenis Botol
                    </h1>

                </div>

        </div>           
        <button
            type="button"
            @click="toggleTheme()"
            class="flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-gray-50 text-gray-700 transition hover:bg-gray-100 dark:border-white/10 dark:bg-white/5 dark:text-gray-300 dark:hover:bg-white/10"
        >

            {{-- SUN --}}

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


            {{-- MOON --}}

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
                    Kelola Jenis Botol
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Atur jenis botol dan jumlah poin yang diberikan.
                </p>

            </div>


            {{-- TAMBAH --}}

            <button
                type="button"
                @click="bottleModal = true"
                class="rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
            >
                + Tambah Jenis Botol
            </button>

        </div>



        {{-- STATISTICS --}}

        <div class="mt-8 grid gap-4 sm:grid-cols-3">


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Total Jenis
                </p>

                <p class="mt-2 text-3xl font-black">
                    5
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Jenis Aktif
                </p>

                <p class="mt-2 text-3xl font-black text-green-500">
                    4
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Total Ditukar
                </p>

                <p class="mt-2 text-3xl font-black">
                    2.481
                </p>

            </div>

        </div>



        {{-- TABLE --}}

        <div
            class="mt-8 overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
        >

            {{-- TABLE HEADER --}}

            <div
                class="flex flex-col justify-between gap-4 border-b border-gray-200 px-6 py-5 sm:flex-row sm:items-center dark:border-white/10"
            >

                <div>

                    <h3 class="font-bold">
                        Daftar Jenis Botol
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Data jenis botol yang tersedia.
                    </p>

                </div>


                <div class="relative">

                    <input
                        type="text"
                        placeholder="Cari jenis botol..."
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

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead
                        class="border-b border-gray-200 text-xs uppercase text-gray-500 dark:border-white/10"
                    >

                        <tr>

                            <th class="px-6 py-4">
                                Jenis Botol
                            </th>

                            <th class="px-6 py-4">
                                Ukuran
                            </th>

                            <th class="px-6 py-4">
                                Poin
                            </th>

                            <th class="px-6 py-4">
                                Total Ditukar
                            </th>

                            <th class="px-6 py-4">
                                Status
                            </th>

                            <th class="px-6 py-4 text-right">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody
                        class="divide-y divide-gray-200 dark:divide-white/10"
                    >


                        {{-- ROW 1 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-xl"
                                    >
                                        ♻
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Botol Plastik
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            PET
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5 text-gray-500">
                                600 ml
                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="font-bold text-green-500"
                                >
                                    50 poin
                                </span>

                            </td>


                            <td class="px-6 py-5 font-semibold">
                                1.240
                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Aktif
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex justify-end gap-2">

                                    <button
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold transition hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                    >
                                        Edit
                                    </button>

                                    <button
                                        class="rounded-lg border border-red-500/20 px-3 py-2 text-xs font-semibold text-red-500 transition hover:bg-red-500/10"
                                    >
                                        Hapus
                                    </button>

                                </div>

                            </td>

                        </tr>



                        {{-- ROW 2 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-xl"
                                    >
                                        ♻
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Botol Plastik
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            PET
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5 text-gray-500">
                                1.5 Liter
                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="font-bold text-green-500"
                                >
                                    100 poin
                                </span>

                            </td>


                            <td class="px-6 py-5 font-semibold">
                                782
                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Aktif
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex justify-end gap-2">

                                    <button
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold transition hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                    >
                                        Edit
                                    </button>

                                    <button
                                        class="rounded-lg border border-red-500/20 px-3 py-2 text-xs font-semibold text-red-500 transition hover:bg-red-500/10"
                                    >
                                        Hapus
                                    </button>

                                </div>

                            </td>

                        </tr>



                        {{-- ROW 3 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-xl"
                                    >
                                        ♻
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Botol Plastik
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            PET
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5 text-gray-500">
                                2 Liter
                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="font-bold text-green-500"
                                >
                                    150 poin
                                </span>

                            </td>


                            <td class="px-6 py-5 font-semibold">
                                459
                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Aktif
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex justify-end gap-2">

                                    <button
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold transition hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                    >
                                        Edit
                                    </button>

                                    <button
                                        class="rounded-lg border border-red-500/20 px-3 py-2 text-xs font-semibold text-red-500 transition hover:bg-red-500/10"
                                    >
                                        Hapus
                                    </button>

                                </div>

                            </td>

                        </tr>



                        {{-- ROW 4 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-xl"
                                    >
                                        ♻
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Kaleng Aluminium
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            Aluminium
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5 text-gray-500">
                                330 ml
                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="font-bold text-green-500"
                                >
                                    75 poin
                                </span>

                            </td>


                            <td class="px-6 py-5 font-semibold">
                                316
                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Aktif
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex justify-end gap-2">

                                    <button
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold transition hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                    >
                                        Edit
                                    </button>

                                    <button
                                        class="rounded-lg border border-red-500/20 px-3 py-2 text-xs font-semibold text-red-500 transition hover:bg-red-500/10"
                                    >
                                        Hapus
                                    </button>

                                </div>

                            </td>

                        </tr>



                        {{-- ROW NONAKTIF --}}

                        <tr
                            class="opacity-60 transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100 text-xl dark:bg-white/5"
                                    >
                                        ♻
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Botol Kaca
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            Glass
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5 text-gray-500">
                                500 ml
                            </td>


                            <td class="px-6 py-5">

                                <span class="font-bold">
                                    100 poin
                                </span>

                            </td>


                            <td class="px-6 py-5 font-semibold">
                                84
                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-gray-500/10 px-3 py-1 text-xs font-semibold text-gray-500"
                                >
                                    Nonaktif
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex justify-end gap-2">

                                    <button
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold transition hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                    >
                                        Edit
                                    </button>

                                    <button
                                        class="rounded-lg border border-red-500/20 px-3 py-2 text-xs font-semibold text-red-500 transition hover:bg-red-500/10"
                                    >
                                        Hapus
                                    </button>

                                </div>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}

            <div
                class="flex items-center justify-between border-t border-gray-200 px-6 py-4 dark:border-white/10"
            >

                <p class="text-xs text-gray-500">
                    Menampilkan 1-5 dari 5 jenis botol
                </p>

                <div class="flex gap-2">

                    <button
                        disabled
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
                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs text-gray-500 dark:border-white/10"
                    >
                        Selanjutnya
                    </button>

                </div>

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

{{-- ========================================================= --}}
{{-- MODAL TAMBAH JENIS BOTOL --}}
{{-- ========================================================= --}}

<div
    x-show="bottleModal"
    x-transition.opacity
    class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
    style="display: none;"
>

    {{-- BACKDROP --}}

    <div
        class="absolute inset-0"
        @click="bottleModal = false"
    ></div>


    {{-- MODAL --}}

    <div
        x-show="bottleModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @click.stop
        class="relative w-full max-w-md rounded-2xl bg-white shadow-2xl dark:bg-gray-900"
    >

        {{-- HEADER --}}

        <div
            class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10"
        >

            <div>
                <h2 class="text-lg font-bold">
                    Tambah Jenis Botol
                </h2>

                <p class="mt-1 text-xs text-gray-500">
                    Masukkan informasi jenis botol baru.
                </p>
            </div>


            {{-- CLOSE --}}

            <button
                type="button"
                @click="bottleModal = false"
                class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/10 dark:hover:text-white"
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
                        d="M6 18 18 6M6 6l12 12"
                    />
                </svg>

            </button>

        </div>


        {{-- FORM --}}

        <form
            action="#"
            method="POST"
            class="p-6"
        >

            @csrf


            {{-- NAMA JENIS BOTOL --}}

            <div>

                <label
                    for="nama_botol"
                    class="mb-2 block text-sm font-semibold"
                >
                    Nama Jenis Botol
                </label>

                <input
                    type="text"
                    id="nama_botol"
                    name="nama_botol"
                    placeholder="Contoh: Botol Plastik 600ml"
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                >

            </div>


            {{-- UKURAN --}}

            <div class="mt-5">

                <label
                    for="ukuran"
                    class="mb-2 block text-sm font-semibold"
                >
                    Ukuran / Kapasitas
                </label>

                <input
                    type="text"
                    id="ukuran"
                    name="ukuran"
                    placeholder="Contoh: 600 ml"
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                >

            </div>


            {{-- POIN --}}

            <div class="mt-5">

                <label
                    for="poin"
                    class="mb-2 block text-sm font-semibold"
                >
                    Poin per Botol
                </label>

                <div class="relative">

                    <input
                        type="number"
                        id="poin"
                        name="poin"
                        min="0"
                        placeholder="50"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 pr-16 text-sm outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                    >

                    <span
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-semibold text-gray-400"
                    >
                        poin
                    </span>

                </div>

            </div>


            {{-- STATUS --}}

            <div class="mt-5">

                <label
                    for="status"
                    class="mb-2 block text-sm font-semibold"
                >
                    Status
                </label>

                <select
                    id="status"
                    name="status"
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                >

                    <option value="aktif">
                        Aktif
                    </option>

                    <option value="nonaktif">
                        Nonaktif
                    </option>

                </select>

            </div>


            {{-- BUTTON --}}

            <div
                class="mt-7 flex justify-end gap-3 border-t border-gray-200 pt-5 dark:border-white/10"
            >

                <button
                    type="button"
                    @click="bottleModal = false"
                    class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-100 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/5"
                >
                    Batal
                </button>


                <button
                    type="submit"
                    class="rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
                >
                    Simpan Jenis Botol
                </button>

            </div>

        </form>

    </div>

</div>
</body>
</html>