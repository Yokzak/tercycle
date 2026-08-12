<!DOCTYPE html>
<html
    lang="id"
    x-data="{
        dark: localStorage.getItem('theme') !== 'light',
        sidebarOpen: false,
        studentModal: false,
        logoutModal: false,

        toggleTheme() {
            this.dark = !this.dark;
            localStorage.setItem('theme', this.dark ? 'dark' : 'light');
            document.documentElement.classList.toggle('dark', this.dark);
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

    <title>Siswa - Admin Tercycle</title>

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
    class="fixed inset-y-0 left-0 z-50 w-64 border-r border-gray-200 bg-white transition-transform duration-300 dark:border-white/10 dark:bg-gray-950 lg:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
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

        <nav class="flex-1 space-y-1 px-4 py-6">


            <p
                class="mb-3 px-3 text-[11px] font-bold uppercase tracking-wider text-gray-400"
            >
                Overview
            </p>


            <a
                href="/admin/dashboard"
                class="{{ request()->is('admin/dashboard')
                    ? 'flex items-center gap-3 rounded-xl bg-green-500/10 px-3 py-3 text-sm font-semibold text-green-500'
                    : 'flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white'
                }}"
            >
                <span class="text-lg">⌂</span>
                Dashboard
            </a>


            <a
                href="/admin/penukaran"
                class="{{ request()->is('admin/penukaran')
                    ? 'flex items-center gap-3 rounded-xl bg-green-500/10 px-3 py-3 text-sm font-semibold text-green-500'
                    : 'flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white'
                }}"
            >
                <span class="text-lg">♻</span>
                Penukaran Botol
            </a>


            <p
                class="mb-3 mt-8 px-3 text-[11px] font-bold uppercase tracking-wider text-gray-400"
            >
                Management
            </p>


            <a
                href="/admin/botol"
                class="{{ request()->is('admin/botol')
                    ? 'flex items-center gap-3 rounded-xl bg-green-500/10 px-3 py-3 text-sm font-semibold text-green-500'
                    : 'flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white'
                }}"
            >
                <span class="text-lg">♲</span>
                Jenis Botol
            </a>

            {{-- ACTIVE --}}

            <a
                href="/admin/siswa"
                class="{{ request()->is('admin/siswa')
                    ? 'flex items-center gap-3 rounded-xl bg-green-500/10 px-3 py-3 text-sm font-semibold text-green-500'
                    : 'flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white'
                }}"
            >
                <span class="text-lg">♙</span>
                Siswa
            </a>


            <a
                href="/admin/produk"
                class="{{ request()->is('admin/produk')
                    ? 'flex items-center gap-3 rounded-xl bg-green-500/10 px-3 py-3 text-sm font-semibold text-green-500'
                    : 'flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white'
                }}"
            >
                <span class="text-lg">□</span>
                Produk
            </a>


            <a
                href="/admin/transaksi"
                class="{{ request()->is('admin/transaksi')
                    ? 'flex items-center gap-3 rounded-xl bg-green-500/10 px-3 py-3 text-sm font-semibold text-green-500'
                    : 'flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white'
                }}"
            >
                <span class="text-lg">≡</span>
                Transaksi
            </a>

        </nav>


        {{-- ADMIN PROFILE --}}

        <div
            class="border-t border-gray-200 p-4 dark:border-white/10"
        >
            <div class="flex items-center gap-3">

                {{-- AVATAR --}}
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gray-900 font-bold text-white dark:bg-white dark:text-gray-950"
                >
                    A
                </div>

                {{-- NAMA --}}
                <div class="min-w-0 flex-1">

                    <p class="truncate text-sm font-semibold">
                        Administrator
                    </p>

                    <p class="text-xs text-gray-500">
                        Admin
                    </p>

                </div>

                {{-- LOGOUT ICON --}}
                <form
                    action="/logout"
                    method="POST"
                >
                    @csrf

                    <button
                        type="button"
                        title="Logout"
                        @click="logoutModal = true"
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-gray-400 transition hover:bg-red-500/10 hover:text-red-500"
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
                                d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m10 17 5-5-5-5m5 5H3"
                            />
                        </svg>

                    </button>

                </form>

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
                        Data Siswa
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
                    Kelola Siswa
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Kelola akun, poin, dan informasi siswa.
                </p>

            </div>


            <button
                type="button"
                @click="studentModal = true"
                class="rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
            >
                + Tambah Siswa
            </button>

        </div>



        {{-- STATISTICS --}}

        <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Total Siswa
                </p>

                <p class="mt-2 text-3xl font-black">
                    248
                </p>

                <p class="mt-2 text-xs text-green-500">
                    +12 bulan ini
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Siswa Aktif
                </p>

                <p class="mt-2 text-3xl font-black text-green-500">
                    231
                </p>

                <p class="mt-2 text-xs text-gray-500">
                    93,1% dari total
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Total Poin
                </p>

                <p class="mt-2 text-3xl font-black">
                    1,2M
                </p>

                <p class="mt-2 text-xs text-gray-500">
                    Poin beredar
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Penukaran Hari Ini
                </p>

                <p class="mt-2 text-3xl font-black">
                    37
                </p>

                <p class="mt-2 text-xs text-green-500">
                    +8,4% dari kemarin
                </p>

            </div>

        </div>



        {{-- TABLE --}}

        <div
            class="mt-8 overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
        >


            {{-- FILTER --}}

            <div
                class="flex flex-col gap-4 border-b border-gray-200 p-6 dark:border-white/10 lg:flex-row lg:items-center lg:justify-between"
            >

                <div>

                    <h3 class="font-bold">
                        Daftar Siswa
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Semua siswa yang terdaftar di Tercycle.
                    </p>

                </div>


                <div class="flex flex-col gap-3 sm:flex-row">


                    {{-- SEARCH --}}

                    <div class="relative">

                        <input
                            type="text"
                            placeholder="Cari nama / kode..."
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 pl-10 text-sm outline-none transition focus:border-green-500 sm:w-64 dark:border-white/10 dark:bg-gray-900"
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


                    {{-- FILTER STATUS --}}

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
                            Nonaktif
                        </option>

                    </select>

                </div>

            </div>



            {{-- TABLE --}}

            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead
                        class="border-b border-gray-200 text-xs uppercase text-gray-500 dark:border-white/10"
                    >

                        <tr>

                            <th class="px-6 py-4">
                                Siswa
                            </th>

                            <th class="px-6 py-4">
                                Kode
                            </th>

                            <th class="px-6 py-4">
                                Saldo Poin
                            </th>

                            <th class="px-6 py-4">
                                Botol Ditukar
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


                        {{-- SISWA 1 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-11 w-11 items-center justify-center rounded-full bg-green-500 font-bold text-gray-950"
                                    >
                                        K
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Kevin
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            XII RPL 1
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <span class="font-mono text-xs">
                                    ECO-2026-00125
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <p class="font-bold text-green-500">
                                    12.500
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    poin
                                </p>

                            </td>


                            <td class="px-6 py-5 font-semibold">
                                250
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
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                    >
                                        Detail
                                    </button>

                                    <button
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                    >
                                        Edit
                                    </button>

                                </div>

                            </td>

                        </tr>



                        {{-- SISWA 2 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-11 w-11 items-center justify-center rounded-full bg-gray-900 font-bold text-white dark:bg-white dark:text-gray-950"
                                    >
                                        I
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Ilyas
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            XII RPL 1
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <span class="font-mono text-xs">
                                    ECO-2026-00118
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <p class="font-bold text-green-500">
                                    8.750
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    poin
                                </p>

                            </td>


                            <td class="px-6 py-5 font-semibold">
                                174
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
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                    >
                                        Detail
                                    </button>

                                    <button
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                    >
                                        Edit
                                    </button>

                                </div>

                            </td>

                        </tr>



                        {{-- SISWA 3 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-11 w-11 items-center justify-center rounded-full bg-green-500 font-bold text-gray-950"
                                    >
                                        A
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Arya
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            XII RPL 2
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <span class="font-mono text-xs">
                                    ECO-2026-00109
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <p class="font-bold text-green-500">
                                    6.200
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    poin
                                </p>

                            </td>


                            <td class="px-6 py-5 font-semibold">
                                124
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
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                    >
                                        Detail
                                    </button>

                                    <button
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                    >
                                        Edit
                                    </button>

                                </div>

                            </td>

                        </tr>



                        {{-- SISWA 4 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-11 w-11 items-center justify-center rounded-full bg-gray-900 font-bold text-white dark:bg-white dark:text-gray-950"
                                    >
                                        W
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Wandi
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            XI RPL 1
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <span class="font-mono text-xs">
                                    ECO-2026-00097
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <p class="font-bold text-green-500">
                                    4.850
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    poin
                                </p>

                            </td>


                            <td class="px-6 py-5 font-semibold">
                                97
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
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                    >
                                        Detail
                                    </button>

                                    <button
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                    >
                                        Edit
                                    </button>

                                </div>

                            </td>

                        </tr>



                        {{-- SISWA NONAKTIF --}}

                        <tr
                            class="opacity-60 transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-11 w-11 items-center justify-center rounded-full bg-gray-200 font-bold text-gray-700 dark:bg-white/10 dark:text-gray-300"
                                    >
                                        O
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Omar
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            XI RPL 2
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <span class="font-mono text-xs">
                                    ECO-2026-00081
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <p class="font-bold">
                                    1.200
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    poin
                                </p>

                            </td>


                            <td class="px-6 py-5 font-semibold">
                                24
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
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                    >
                                        Detail
                                    </button>

                                    <button
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                    >
                                        Edit
                                    </button>

                                </div>

                            </td>

                        </tr>


                    </tbody>

                </table>

            </div>



            {{-- PAGINATION --}}

            <div
                class="flex flex-col gap-4 border-t border-gray-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between dark:border-white/10"
            >

                <p class="text-xs text-gray-500">
                    Menampilkan 1-5 dari 248 siswa
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

        </div>

    </main>

    {{-- ========================================================= --}}
    {{-- MODAL TAMBAH SISWA --}}
    {{-- ========================================================= --}}

    <div
        x-show="studentModal"
        x-transition.opacity
        x-effect="document.body.style.overflow = studentModal ? 'hidden' : ''"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
        style="display: none;"
    >
        {{-- BACKDROP --}}
        <div
            class="absolute inset-0 bg-black/50 backdrop-blur-md"
            @click="studentModal = false"
        ></div>


        {{-- MODAL --}}
        <div
            x-show="studentModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.stop
            class="no-scrollbar relative max-h-[85vh] w-full max-w-md overflow-y-auto overscroll-contain rounded-2xl bg-white shadow-2xl dark:bg-gray-900"
        >

            {{-- HEADER --}}
            <div
                class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10"
            >

                <div>
                    <h2 class="text-lg font-bold">
                        Tambah Siswa
                    </h2>

                    <p class="mt-1 text-xs text-gray-500">
                        Masukkan informasi siswa baru.
                    </p>
                </div>


                {{-- CLOSE --}}
                <button
                    type="button"
                    @click="studentModal = false"
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


                {{-- NAMA LENGKAP --}}
                <div>
                    <label
                        for="nama_lengkap"
                        class="mb-2 block text-sm font-semibold"
                    >
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        id="nama_lengkap"
                        name="nama_lengkap"
                        placeholder="Contoh: Kevin Agna Pratama"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                    >
                </div>


                {{-- NIS --}}
                <div class="mt-5">
                    <label
                        for="nis"
                        class="mb-2 block text-sm font-semibold"
                    >
                        NIS
                    </label>

                    <input
                        type="text"
                        id="nis"
                        name="nis"
                        placeholder="Contoh: 202600125"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                    >
                </div>


                {{-- KELAS + JURUSAN --}}
                <div class="mt-5 grid gap-4 sm:grid-cols-2">

                    {{-- KELAS --}}
                    <div>
                        <label
                            for="kelas"
                            class="mb-2 block text-sm font-semibold"
                        >
                            Kelas
                        </label>

                        <select
                            id="kelas"
                            name="kelas"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                        >
                            <option value="">
                                Pilih kelas
                            </option>

                            <option value="X">
                                X
                            </option>

                            <option value="XI">
                                XI
                            </option>

                            <option value="XII">
                                XII
                            </option>
                        </select>
                    </div>


                    {{-- JURUSAN --}}
                    <div>
                        <label
                            for="jurusan"
                            class="mb-2 block text-sm font-semibold"
                        >
                            Jurusan
                        </label>

                        <select
                            id="jurusan"
                            name="jurusan"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                        >
                            <option value="">
                                Pilih jurusan
                            </option>

                            <option value="RPL">
                                RPL
                            </option>

                            <option value="TKJ">
                                TKJ
                            </option>

                            <option value="DKV">
                                DKV
                            </option>

                            <option value="AKL">
                                AKL
                            </option>
                        </select>
                    </div>

                </div>


                {{-- BUTTON --}}
                <div
                    class="mt-7 flex justify-end gap-3 border-t border-gray-200 pt-5 dark:border-white/10"
                >

                    <button
                        type="button"
                        @click="studentModal = false"
                        class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-100 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/5"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
                    >
                        Simpan Siswa
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


</body>
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
</html>