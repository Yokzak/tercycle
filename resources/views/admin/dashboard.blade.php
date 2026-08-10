```blade
<!DOCTYPE html>
<html
    lang="id"
    x-data="{
        dark: localStorage.getItem('theme') !== 'light',

        toggleTheme() {
            this.dark = !this.dark;
            localStorage.setItem('theme', this.dark ? 'dark' : 'light');
            document.documentElement.classList.toggle('dark', this.dark);
        }
    }"
    x-init="document.documentElement.classList.toggle('dark', dark)"
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
    class="fixed inset-y-0 left-0 z-40 hidden w-64 border-r border-gray-200 bg-white dark:border-white/10 dark:bg-gray-950 lg:block"
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



        {{-- NAVIGATION --}}

        <nav class="flex-1 space-y-1 px-4 py-6">


            <p
                class="mb-3 px-3 text-[11px] font-bold uppercase tracking-wider text-gray-400"
            >
                Overview
            </p>


            {{-- ACTIVE DASHBOARD --}}

            <a
                href="/admin/dashboard"
                class="flex items-center gap-3 rounded-xl bg-green-500/10 px-3 py-3 text-sm font-semibold text-green-500"
            >

                <span class="text-lg">⌂</span>

                Dashboard

            </a>


            <a
                href="/admin/penukaran"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
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
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
            >

                <span class="text-lg">♲</span>

                Jenis Botol

            </a>


            <a
                href="/admin/siswa"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
            >

                <span class="text-lg">♙</span>

                Siswa

            </a>


            <a
                href="/admin/produk"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
            >

                <span class="text-lg">□</span>

                Produk

            </a>


            <a
                href="/admin/transaksi"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
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

                <div
                    class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-900 font-bold text-white dark:bg-white dark:text-gray-950"
                >
                    A
                </div>

                <div>

                    <p class="text-sm font-semibold">
                        Administrator
                    </p>

                    <p class="text-xs text-gray-500">
                        Admin Tercycle
                    </p>

                </div>

            </div>

        </div>

    </div>

</aside>



{{-- ========================================================= --}}
{{-- MAIN --}}
{{-- ========================================================= --}}

<div class="lg:pl-64">


    {{-- TOPBAR --}}

    <header
        class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-gray-200 bg-white/90 px-6 backdrop-blur-xl dark:border-white/10 dark:bg-gray-950/90 lg:px-8"
    >

        <div>

            <p class="text-sm font-medium text-gray-500">
                Admin Panel
            </p>

            <h1 class="font-bold">
                Dashboard
            </h1>

        </div>



        <div class="flex items-center gap-3">


            {{-- NOTIFICATION --}}

            <button
                class="relative flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-gray-50 text-gray-600 transition hover:bg-gray-100 dark:border-white/10 dark:bg-white/5 dark:text-gray-300 dark:hover:bg-white/10"
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
                        d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9a6 6 0 0 0-12 0v.75a8.967 8.967 0 0 1-2.31 6.022c1.735.613 3.576 1.077 5.454 1.31m5.713 0a24.255 24.255 0 0 1-5.713 0m5.713 0a3 3 0 1 1-5.713 0"
                    />

                </svg>


                <span
                    class="absolute right-2 top-2 h-2 w-2 rounded-full bg-green-500"
                ></span>

            </button>



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

        </div>

    </header>



    {{-- ========================================================= --}}
    {{-- CONTENT --}}
    {{-- ========================================================= --}}

    <main class="mx-auto max-w-7xl px-6 py-8 lg:px-8">


        {{-- WELCOME --}}

        <div class="mb-8">

            <h2 class="text-2xl font-black">
                Selamat datang, Admin.
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Berikut ringkasan aktivitas Tercycle hari ini.
            </p>

        </div>



        {{-- ================================================= --}}
        {{-- STATISTICS --}}
        {{-- ================================================= --}}

        <div
            class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4"
        >


            {{-- SISWA --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div class="flex items-center justify-between">

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
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.125-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.003a9.36 9.36 0 0 1-3.375.625 9.36 9.36 0 0 1-3.375-.625m6.75 0a24.255 24.255 0 0 0-1.688-3.073M9 19.128a9.38 9.38 0 0 1-2.625.372 9.337 9.337 0 0 1-4.125-.952 4.125 4.125 0 0 1 7.533-2.493M9 19.128v-.003c0-1.113.285-2.16.786-3.07M9 19.128v.003a9.36 9.36 0 0 0 3.375.625M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                            />

                        </svg>

                    </div>


                    <span
                        class="text-xs font-semibold text-green-500"
                    >
                        +12.5%
                    </span>

                </div>


                <p class="mt-5 text-sm text-gray-500">
                    Total Siswa
                </p>

                <p class="mt-1 text-3xl font-black">
                    428
                </p>

                <p class="mt-2 text-xs text-gray-500">
                    Siswa terdaftar
                </p>

            </div>



            {{-- BOTOL --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div class="flex items-center justify-between">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500"
                    >

                        <span class="text-xl">
                            ♻
                        </span>

                    </div>


                    <span
                        class="text-xs font-semibold text-green-500"
                    >
                        +18.4%
                    </span>

                </div>


                <p class="mt-5 text-sm text-gray-500">
                    Botol Terkumpul
                </p>

                <p class="mt-1 text-3xl font-black">
                    12.840
                </p>

                <p class="mt-2 text-xs text-gray-500">
                    Total botol didaur ulang
                </p>

            </div>



            {{-- POIN --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div class="flex items-center justify-between">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500"
                    >

                        <span class="text-xl">
                            ◉
                        </span>

                    </div>


                    <span
                        class="text-xs font-semibold text-green-500"
                    >
                        +9.8%
                    </span>

                </div>


                <p class="mt-5 text-sm text-gray-500">
                    Poin Beredar
                </p>

                <p class="mt-1 text-3xl font-black">
                    163.350
                </p>

                <p class="mt-2 text-xs text-gray-500">
                    Total poin siswa
                </p>

            </div>



            {{-- TRANSAKSI --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div class="flex items-center justify-between">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500"
                    >

                        <span class="text-xl">
                            ≡
                        </span>

                    </div>


                    <span
                        class="text-xs font-semibold text-green-500"
                    >
                        +14.2%
                    </span>

                </div>


                <p class="mt-5 text-sm text-gray-500">
                    Transaksi Bulan Ini
                </p>

                <p class="mt-1 text-3xl font-black">
                    1.284
                </p>

                <p class="mt-2 text-xs text-gray-500">
                    Semua jenis transaksi
                </p>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- CHART + QUICK ACTION --}}
        {{-- ================================================= --}}

        <div
            class="mt-6 grid gap-6 xl:grid-cols-3"
        >


            {{-- ACTIVITY CHART --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-6 xl:col-span-2 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center"
                >

                    <div>

                        <h3 class="font-bold">
                            Aktivitas Penukaran
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            Jumlah botol yang dikumpulkan minggu ini.
                        </p>

                    </div>


                    <select
                        class="rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-xs outline-none dark:border-white/10 dark:bg-gray-900"
                    >

                        <option>
                            7 Hari Terakhir
                        </option>

                        <option>
                            30 Hari Terakhir
                        </option>

                    </select>

                </div>



                {{-- SIMPLE BAR CHART --}}

                <div
                    class="mt-8 flex h-64 items-end justify-between gap-3"
                >


                    {{-- SENIN --}}

                    <div class="flex flex-1 flex-col items-center gap-2">

                        <div
                            class="w-full rounded-t-lg bg-green-500"
                            style="height: 45%"
                        ></div>

                        <span class="text-xs text-gray-500">
                            Sen
                        </span>

                    </div>


                    {{-- SELASA --}}

                    <div class="flex flex-1 flex-col items-center gap-2">

                        <div
                            class="w-full rounded-t-lg bg-green-500"
                            style="height: 68%"
                        ></div>

                        <span class="text-xs text-gray-500">
                            Sel
                        </span>

                    </div>


                    {{-- RABU --}}

                    <div class="flex flex-1 flex-col items-center gap-2">

                        <div
                            class="w-full rounded-t-lg bg-green-500"
                            style="height: 55%"
                        ></div>

                        <span class="text-xs text-gray-500">
                            Rab
                        </span>

                    </div>


                    {{-- KAMIS --}}

                    <div class="flex flex-1 flex-col items-center gap-2">

                        <div
                            class="w-full rounded-t-lg bg-green-500"
                            style="height: 82%"
                        ></div>

                        <span class="text-xs text-gray-500">
                            Kam
                        </span>

                    </div>


                    {{-- JUMAT --}}

                    <div class="flex flex-1 flex-col items-center gap-2">

                        <div
                            class="w-full rounded-t-lg bg-green-500"
                            style="height: 72%"
                        ></div>

                        <span class="text-xs text-gray-500">
                            Jum
                        </span>

                    </div>


                    {{-- SABTU --}}

                    <div class="flex flex-1 flex-col items-center gap-2">

                        <div
                            class="w-full rounded-t-lg bg-green-500"
                            style="height: 92%"
                        ></div>

                        <span class="text-xs text-gray-500">
                            Sab
                        </span>

                    </div>


                    {{-- MINGGU --}}

                    <div class="flex flex-1 flex-col items-center gap-2">

                        <div
                            class="w-full rounded-t-lg bg-green-500"
                            style="height: 62%"
                        ></div>

                        <span class="text-xs text-gray-500">
                            Min
                        </span>

                    </div>

                </div>

            </div>



            {{-- QUICK ACTION --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <h3 class="font-bold">
                    Aksi Cepat
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Kelola sistem dengan cepat.
                </p>


                <div class="mt-6 space-y-3">


                    <a
                        href="/admin/penukaran"
                        class="flex items-center gap-4 rounded-xl border border-gray-200 p-4 transition hover:border-green-500/30 hover:bg-green-500/5 dark:border-white/10"
                    >

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-500/10 text-green-500"
                        >
                            ♻
                        </div>

                        <div>

                            <p class="text-sm font-semibold">
                                Penukaran Botol
                            </p>

                            <p class="text-xs text-gray-500">
                                7 menunggu konfirmasi
                            </p>

                        </div>

                    </a>


                    <a
                        href="/admin/siswa"
                        class="flex items-center gap-4 rounded-xl border border-gray-200 p-4 transition hover:border-green-500/30 hover:bg-green-500/5 dark:border-white/10"
                    >

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-500/10 text-green-500"
                        >
                            ♙
                        </div>

                        <div>

                            <p class="text-sm font-semibold">
                                Kelola Siswa
                            </p>

                            <p class="text-xs text-gray-500">
                                428 siswa terdaftar
                            </p>

                        </div>

                    </a>


                    <a
                        href="/admin/produk"
                        class="flex items-center gap-4 rounded-xl border border-gray-200 p-4 transition hover:border-green-500/30 hover:bg-green-500/5 dark:border-white/10"
                    >

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-500/10 text-green-500"
                        >
                            □
                        </div>

                        <div>

                            <p class="text-sm font-semibold">
                                Kelola Produk
                            </p>

                            <p class="text-xs text-gray-500">
                                24 produk tersedia
                            </p>

                        </div>

                    </a>


                    <a
                        href="/admin/transaksi"
                        class="flex items-center gap-4 rounded-xl border border-gray-200 p-4 transition hover:border-green-500/30 hover:bg-green-500/5 dark:border-white/10"
                    >

                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-500/10 text-green-500"
                        >
                            ≡
                        </div>

                        <div>

                            <p class="text-sm font-semibold">
                                Lihat Transaksi
                            </p>

                            <p class="text-xs text-gray-500">
                                1.284 transaksi bulan ini
                            </p>

                        </div>

                    </a>

                </div>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- BOTTOM SECTION --}}
        {{-- ================================================= --}}

        <div
            class="mt-6 grid gap-6 lg:grid-cols-2"
        >


            {{-- RECENT TRANSACTIONS --}}

            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10"
                >

                    <div>

                        <h3 class="font-bold">
                            Transaksi Terbaru
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            Aktivitas transaksi terakhir.
                        </p>

                    </div>


                    <a
                        href="/admin/transaksi"
                        class="text-xs font-semibold text-green-500 hover:text-green-400"
                    >
                        Lihat semua
                    </a>

                </div>



                <div
                    class="divide-y divide-gray-200 dark:divide-white/10"
                >


                    {{-- ITEM --}}

                    <div class="flex items-center justify-between px-6 py-4">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-full bg-green-500/10 font-bold text-green-500"
                            >
                                K
                            </div>

                            <div>

                                <p class="text-sm font-semibold">
                                    Kevin
                                </p>

                                <p class="text-xs text-gray-500">
                                    Penukaran Botol
                                </p>

                            </div>

                        </div>


                        <div class="text-right">

                            <p class="text-sm font-bold text-green-500">
                                +1.250
                            </p>

                            <p class="text-xs text-gray-500">
                                14:32
                            </p>

                        </div>

                    </div>



                    <div class="flex items-center justify-between px-6 py-4">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-900 font-bold text-white dark:bg-white dark:text-gray-950"
                            >
                                I
                            </div>

                            <div>

                                <p class="text-sm font-semibold">
                                    Ilyas
                                </p>

                                <p class="text-xs text-gray-500">
                                    Pembelian Tumbler
                                </p>

                            </div>

                        </div>


                        <div class="text-right">

                            <p class="text-sm font-bold text-red-500">
                                -5.000
                            </p>

                            <p class="text-xs text-gray-500">
                                13:57
                            </p>

                        </div>

                    </div>



                    <div class="flex items-center justify-between px-6 py-4">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-full bg-green-500/10 font-bold text-green-500"
                            >
                                A
                            </div>

                            <div>

                                <p class="text-sm font-semibold">
                                    Arya
                                </p>

                                <p class="text-xs text-gray-500">
                                    Penukaran Botol Kaca
                                </p>

                            </div>

                        </div>


                        <div class="text-right">

                            <p class="text-sm font-bold text-yellow-500">
                                +1.000
                            </p>

                            <p class="text-xs text-gray-500">
                                13:21
                            </p>

                        </div>

                    </div>



                    <div class="flex items-center justify-between px-6 py-4">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-900 font-bold text-white dark:bg-white dark:text-gray-950"
                            >
                                W
                            </div>

                            <div>

                                <p class="text-sm font-semibold">
                                    Wandi
                                </p>

                                <p class="text-xs text-gray-500">
                                    Pembelian Tote Bag
                                </p>

                            </div>

                        </div>


                        <div class="text-right">

                            <p class="text-sm font-bold text-red-500">
                                -3.500
                            </p>

                            <p class="text-xs text-gray-500">
                                12:48
                            </p>

                        </div>

                    </div>

                </div>

            </div>



            {{-- TOP STUDENTS --}}

            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="border-b border-gray-200 px-6 py-5 dark:border-white/10"
                >

                    <h3 class="font-bold">
                        Siswa Teraktif
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Siswa dengan kontribusi botol terbanyak.
                    </p>

                </div>



                <div class="divide-y divide-gray-200 dark:divide-white/10">


                    {{-- STUDENT 1 --}}

                    <div
                        class="flex items-center justify-between px-6 py-4"
                    >

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-full bg-green-500 font-black text-gray-950"
                            >
                                1
                            </div>

                            <div>

                                <p class="text-sm font-semibold">
                                    Kevin
                                </p>

                                <p class="text-xs text-gray-500">
                                    1.240 botol
                                </p>

                            </div>

                        </div>


                        <span
                            class="text-sm font-bold text-green-500"
                        >
                            12.400 poin
                        </span>

                    </div>



                    {{-- STUDENT 2 --}}

                    <div
                        class="flex items-center justify-between px-6 py-4"
                    >

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-200 font-black text-gray-700 dark:bg-white/10 dark:text-white"
                            >
                                2
                            </div>

                            <div>

                                <p class="text-sm font-semibold">
                                    Ilyas
                                </p>

                                <p class="text-xs text-gray-500">
                                    980 botol
                                </p>

                            </div>

                        </div>


                        <span
                            class="text-sm font-bold text-green-500"
                        >
                            9.800 poin
                        </span>

                    </div>



                    {{-- STUDENT 3 --}}

                    <div
                        class="flex items-center justify-between px-6 py-4"
                    >

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-200 font-black text-gray-700 dark:bg-white/10 dark:text-white"
                            >
                                3
                            </div>

                            <div>

                                <p class="text-sm font-semibold">
                                    Arya
                                </p>

                                <p class="text-xs text-gray-500">
                                    865 botol
                                </p>

                            </div>

                        </div>


                        <span
                            class="text-sm font-bold text-green-500"
                        >
                            8.650 poin
                        </span>

                    </div>



                    {{-- STUDENT 4 --}}

                    <div
                        class="flex items-center justify-between px-6 py-4"
                    >

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-200 font-black text-gray-700 dark:bg-white/10 dark:text-white"
                            >
                                4
                            </div>

                            <div>

                                <p class="text-sm font-semibold">
                                    Wandi
                                </p>

                                <p class="text-xs text-gray-500">
                                    742 botol
                                </p>

                            </div>

                        </div>


                        <span
                            class="text-sm font-bold text-green-500"
                        >
                            7.420 poin
                        </span>

                    </div>

                </div>

            </div>

        </div>



        {{-- FOOTER --}}

        <div
            class="mt-8 border-t border-gray-200 pt-6 text-center text-xs text-gray-500 dark:border-white/10"
        >

            Tercycle Admin Panel • Sistem Pengelolaan Daur Ulang Sekolah

        </div>

    </main>

</div>


</body>
</html>