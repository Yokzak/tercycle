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

    <title>Dashboard Admin - Tercycle</title>

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

            {{-- ACTIVE --}}

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


    {{-- ===================================================== --}}
    {{-- TOPBAR --}}
    {{-- ===================================================== --}}

    <header
        class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-gray-200 bg-white/90 px-4 backdrop-blur-xl dark:border-white/10 dark:bg-gray-950/90 sm:px-6 lg:px-8"
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
                    Overview
                </p>

                <h1 class="font-bold">
                    Dashboard Admin
                </h1>

            </div>

        </div>


        {{-- THEME BUTTON --}}

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



    {{-- ===================================================== --}}
    {{-- CONTENT --}}
    {{-- ===================================================== --}}

    <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 lg:py-8">


        {{-- HEADER --}}

        <div class="mb-8">

            <p class="text-sm font-medium text-green-500">
                Tercycle Admin
            </p>

            <h2 class="mt-1 text-2xl font-black sm:text-3xl">
                Selamat datang, Administrator
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                Pantau aktivitas bank sampah dan sistem Tercycle.
            </p>

        </div>



        {{-- ================================================= --}}
        {{-- STATISTICS --}}
        {{-- ================================================= --}}

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">


            {{-- TOTAL SISWA --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm text-gray-500">
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
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500"
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
                                d="M15 19a6 6 0 0 0-12 0m6-8a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm6-4h3m-1.5-1.5v3"
                            />
                        </svg>
                    </div>

                </div>

            </div>


            {{-- TOTAL BOTOL --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm text-gray-500">
                            Botol Terkumpul
                        </p>

                        <p class="mt-2 text-3xl font-black">
                            8.420
                        </p>

                        <p class="mt-2 text-xs text-green-500">
                            +1.240 bulan ini
                        </p>

                    </div>

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500"
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
                                d="M9 3h6m-5 0v4.5L6.5 12v5.5A3.5 3.5 0 0 0 10 21h4a3.5 3.5 0 0 0 3.5-3.5V12L14 7.5V3"
                            />
                        </svg>
                    </div>

                </div>

            </div>


            {{-- POIN BEREDAR --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm text-gray-500">
                            Poin Beredar
                        </p>

                        <p class="mt-2 text-3xl font-black">
                            124K
                        </p>

                        <p class="mt-2 text-xs text-green-500">
                            +8,4% bulan ini
                        </p>

                    </div>

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500"
                    >
                        <span class="text-lg font-black">
                            P
                        </span>
                    </div>

                </div>

            </div>


            {{-- TRANSAKSI --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm text-gray-500">
                            Transaksi
                        </p>

                        <p class="mt-2 text-3xl font-black">
                            1.284
                        </p>

                        <p class="mt-2 text-xs text-green-500">
                            +156 bulan ini
                        </p>

                    </div>

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500"
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
                    </div>

                </div>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- QUICK ACTION --}}
        {{-- ================================================= --}}

        <div class="mt-8">

            <div class="mb-4">

                <h3 class="font-bold">
                    Aksi Cepat
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Akses fitur administrasi yang sering digunakan.
                </p>

            </div>


            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">


                <a
                    href="/admin/penukaran"
                    class="group rounded-2xl border border-gray-200 bg-white p-5 transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
                >

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500 transition group-hover:bg-green-500 group-hover:text-gray-950"
                    >
                        +
                    </div>

                    <h4 class="mt-4 font-bold">
                        Penukaran Botol
                    </h4>

                    <p class="mt-1 text-xs text-gray-500">
                        Input penukaran botol siswa.
                    </p>

                </a>


                <a
                    href="/admin/siswa"
                    class="group rounded-2xl border border-gray-200 bg-white p-5 transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
                >

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500 transition group-hover:bg-green-500 group-hover:text-gray-950"
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
                                d="M15 19a6 6 0 0 0-12 0m6-8a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm6-4h3m-1.5-1.5v3"
                            />
                        </svg>
                    </div>

                    <h4 class="mt-4 font-bold">
                        Kelola Siswa
                    </h4>

                    <p class="mt-1 text-xs text-gray-500">
                        Lihat dan kelola data siswa.
                    </p>

                </a>


                <a
                    href="/admin/produk"
                    class="group rounded-2xl border border-gray-200 bg-white p-5 transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
                >

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500 transition group-hover:bg-green-500 group-hover:text-gray-950"
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
                    </div>

                    <h4 class="mt-4 font-bold">
                        Kelola Produk
                    </h4>

                    <p class="mt-1 text-xs text-gray-500">
                        Tambah dan kelola produk.
                    </p>

                </a>


                <a
                    href="/admin/transaksi"
                    class="group rounded-2xl border border-gray-200 bg-white p-5 transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
                >

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500 transition group-hover:bg-green-500 group-hover:text-gray-950"
                    >
                        ≡
                    </div>

                    <h4 class="mt-4 font-bold">
                        Lihat Transaksi
                    </h4>

                    <p class="mt-1 text-xs text-gray-500">
                        Pantau seluruh transaksi.
                    </p>

                </a>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- CONTENT GRID --}}
        {{-- ================================================= --}}

        <div class="mt-8 grid gap-8 lg:grid-cols-3">


            {{-- TRANSAKSI TERBARU --}}

            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white lg:col-span-2 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10"
                >

                    <div>

                        <h3 class="font-bold">
                            Transaksi Terbaru
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            Aktivitas terbaru di Tercycle.
                        </p>

                    </div>

                    <a
                        href="/admin/transaksi"
                        class="text-sm font-semibold text-green-500 hover:text-green-400"
                    >
                        Lihat semua
                    </a>

                </div>


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
                                    Aktivitas
                                </th>

                                <th class="px-6 py-4">
                                    Poin
                                </th>

                                <th class="px-6 py-4">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody
                            class="divide-y divide-gray-200 dark:divide-white/10"
                        >

                            <tr>

                                <td class="px-6 py-5">

                                    <p class="font-semibold">
                                        Kevin
                                    </p>

                                    <p class="mt-1 text-xs text-gray-500">
                                        ECO-2026-00125
                                    </p>

                                </td>

                                <td class="px-6 py-5 text-gray-500">
                                    Penukaran botol
                                </td>

                                <td class="px-6 py-5 font-bold text-green-500">
                                    +500
                                </td>

                                <td class="px-6 py-5">

                                    <span
                                        class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                    >
                                        Berhasil
                                    </span>

                                </td>

                            </tr>


                            <tr>

                                <td class="px-6 py-5">

                                    <p class="font-semibold">
                                        Ilyas
                                    </p>

                                    <p class="mt-1 text-xs text-gray-500">
                                        ECO-2026-00118
                                    </p>

                                </td>

                                <td class="px-6 py-5 text-gray-500">
                                    Penukaran botol
                                </td>

                                <td class="px-6 py-5 font-bold text-green-500">
                                    +800
                                </td>

                                <td class="px-6 py-5">

                                    <span
                                        class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold text-yellow-600 dark:text-yellow-400"
                                    >
                                        Menunggu
                                    </span>

                                </td>

                            </tr>


                            <tr>

                                <td class="px-6 py-5">

                                    <p class="font-semibold">
                                        Arya
                                    </p>

                                    <p class="mt-1 text-xs text-gray-500">
                                        ECO-2026-00112
                                    </p>

                                </td>

                                <td class="px-6 py-5 text-gray-500">
                                    Pembelian produk
                                </td>

                                <td class="px-6 py-5 font-bold text-red-500">
                                    -1.000
                                </td>

                                <td class="px-6 py-5">

                                    <span
                                        class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                    >
                                        Berhasil
                                    </span>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>



            {{-- RINGKASAN --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <h3 class="font-bold">
                    Ringkasan Hari Ini
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Statistik aktivitas hari ini.
                </p>


                <div class="mt-6 space-y-5">


                    <div>

                        <div class="flex items-center justify-between">

                            <p class="text-sm text-gray-500">
                                Penukaran Botol
                            </p>

                            <p class="font-bold">
                                42
                            </p>

                        </div>

                        <div class="mt-2 h-2 overflow-hidden rounded-full bg-gray-100 dark:bg-white/10">

                            <div
                                class="h-full w-[75%] rounded-full bg-green-500"
                            ></div>

                        </div>

                    </div>


                    <div>

                        <div class="flex items-center justify-between">

                            <p class="text-sm text-gray-500">
                                Poin Diberikan
                            </p>

                            <p class="font-bold">
                                8.450
                            </p>

                        </div>

                        <div class="mt-2 h-2 overflow-hidden rounded-full bg-gray-100 dark:bg-white/10">

                            <div
                                class="h-full w-[65%] rounded-full bg-green-500"
                            ></div>

                        </div>

                    </div>


                    <div>

                        <div class="flex items-center justify-between">

                            <p class="text-sm text-gray-500">
                                Produk Terjual
                            </p>

                            <p class="font-bold">
                                18
                            </p>

                        </div>

                        <div class="mt-2 h-2 overflow-hidden rounded-full bg-gray-100 dark:bg-white/10">

                            <div
                                class="h-full w-[45%] rounded-full bg-green-500"
                            ></div>

                        </div>

                    </div>


                    <div>

                        <div class="flex items-center justify-between">

                            <p class="text-sm text-gray-500">
                                Siswa Aktif
                            </p>

                            <p class="font-bold">
                                67
                            </p>

                        </div>

                        <div class="mt-2 h-2 overflow-hidden rounded-full bg-gray-100 dark:bg-white/10">

                            <div
                                class="h-full w-[55%] rounded-full bg-green-500"
                            ></div>

                        </div>

                    </div>

                </div>


                <a
                    href="/admin/transaksi"
                    class="mt-7 block rounded-xl border border-gray-200 px-4 py-3 text-center text-sm font-semibold transition hover:border-green-500 hover:text-green-500 dark:border-white/10"
                >
                    Lihat Semua Aktivitas
                </a>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- FOOTER --}}
        {{-- ================================================= --}}

        <footer
            class="mt-10 border-t border-gray-200 py-6 dark:border-white/10"
        >

            <div class="flex flex-col justify-between gap-2 text-xs text-gray-500 sm:flex-row">

                <p>
                    © {{ date('Y') }} Tercycle
                </p>

                <p>
                    Admin Panel · Bank Sampah Digital
                </p>

            </div>

        </footer>


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