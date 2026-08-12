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

    <title>Penukaran Botol - Admin Tercycle</title>

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

            {{-- ACTIVE --}}
            
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
                    Penukaran Botol
                </h1>
            </div>
        </div>


        <div class="flex items-center gap-3">


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



    {{-- CONTENT --}}

    <main class="mx-auto max-w-7xl px-6 py-8 lg:px-8">


        {{-- HEADER --}}

        <div class="mb-8">

            <h2 class="text-2xl font-black">
                Input Penukaran
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Cari siswa dan masukkan jumlah botol yang ditukarkan.
            </p>

        </div>



        {{-- SEARCH SISWA --}}

        <div
            class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
        >

            <div class="flex items-center justify-between">

                <div>

                    <h3 class="font-bold">
                        Cari Siswa
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Gunakan kode siswa atau nama.
                    </p>

                </div>

                <span
                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                >
                    Langkah 1
                </span>

            </div>


            <div class="mt-5 flex flex-col gap-3 sm:flex-row">

                <div class="relative flex-1">

                    <input
                        type="text"
                        placeholder="Masukkan kode siswa atau nama..."
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 pl-11 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-900"
                    >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="absolute left-4 top-3.5 h-5 w-5 text-gray-400"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                        />
                    </svg>

                </div>

                <button
                    class="rounded-xl bg-gray-900 px-6 py-3 text-sm font-bold text-white transition hover:bg-gray-700 dark:bg-white dark:text-gray-950 dark:hover:bg-gray-200"
                >
                    Cari Siswa
                </button>

            </div>

        </div>



        {{-- DATA SISWA --}}

        <div
            class="mt-6 rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
        >

            <div class="flex items-center gap-4">

                <div
                    class="flex h-14 w-14 items-center justify-center rounded-2xl bg-green-500 font-black text-gray-950"
                >
                    K
                </div>

                <div class="flex-1">

                    <div class="flex items-center gap-3">

                        <h3 class="font-bold">
                            Kevin
                        </h3>

                        <span
                            class="rounded-full bg-green-500/10 px-2.5 py-1 text-[11px] font-semibold text-green-500"
                        >
                            Aktif
                        </span>

                    </div>

                    <p class="mt-1 text-sm text-gray-500">
                        ECO-2026-00125
                    </p>

                </div>

                <div class="hidden text-right sm:block">

                    <p class="text-xs text-gray-500">
                        Saldo saat ini
                    </p>

                    <p class="mt-1 font-black text-green-500">
                        12.500 poin
                    </p>

                </div>

            </div>

        </div>



        {{-- INPUT BOTOL --}}

        <div
            class="mt-6 rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
        >

            <div class="flex items-center justify-between">

                <div>

                    <h3 class="font-bold">
                        Detail Penukaran
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Masukkan jenis dan jumlah botol.
                    </p>

                </div>

                <span
                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                >
                    Langkah 2
                </span>

            </div>


            <div class="mt-6 grid gap-5 md:grid-cols-3">


                {{-- JENIS BOTOL --}}

                <div>

                    <label class="mb-2 block text-sm font-semibold">
                        Jenis Botol
                    </label>

                    <select
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none focus:border-green-500 dark:border-white/10 dark:bg-gray-900"
                    >

                        <option>
                            Botol Plastik 600ml
                        </option>

                        <option>
                            Botol Plastik 1.5L
                        </option>

                        <option>
                            Botol Plastik 2L
                        </option>

                    </select>

                </div>


                {{-- JUMLAH --}}

                <div>

                    <label class="mb-2 block text-sm font-semibold">
                        Jumlah Botol
                    </label>

                    <input
                        type="number"
                        min="1"
                        value="10"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none focus:border-green-500 dark:border-white/10 dark:bg-gray-900"
                    >

                </div>


                {{-- POIN --}}

                <div>

                    <label class="mb-2 block text-sm font-semibold">
                        Poin Diperoleh
                    </label>

                    <div
                        class="rounded-xl border border-green-500/20 bg-green-500/10 px-4 py-3 text-sm font-black text-green-500"
                    >
                        +500 Poin
                    </div>

                </div>

            </div>


            {{-- SUMMARY --}}

            <div
                class="mt-6 rounded-xl bg-gray-50 p-5 dark:bg-white/5"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-semibold">
                            Total Penukaran
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            10 botol × 50 poin
                        </p>

                    </div>

                    <p class="text-xl font-black text-green-500">
                        +500
                    </p>

                </div>

            </div>


            {{-- BUTTON --}}

            <div class="mt-6 flex justify-end">

                <button
                    class="rounded-xl bg-green-500 px-6 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
                >
                    Konfirmasi Penukaran
                </button>

            </div>

        </div>



        {{-- RIWAYAT TERBARU --}}

        <div
            class="mt-8 rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
        >

            <div
                class="border-b border-gray-200 px-6 py-5 dark:border-white/10"
            >

                <h3 class="font-bold">
                    Penukaran Terbaru
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Riwayat penukaran botol terbaru.
                </p>

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
                                Jenis Botol
                            </th>

                            <th class="px-6 py-4">
                                Jumlah
                            </th>

                            <th class="px-6 py-4">
                                Poin
                            </th>

                            <th class="px-6 py-4">
                                Waktu
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
                                Plastik 600ml
                            </td>

                            <td class="px-6 py-5 font-semibold">
                                10
                            </td>

                            <td class="px-6 py-5 font-bold text-green-500">
                                +500
                            </td>

                            <td class="px-6 py-5 text-gray-500">
                                10:24
                            </td>

                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Dikonfirmasi
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
                                Plastik 1.5L
                            </td>

                            <td class="px-6 py-5 font-semibold">
                                8
                            </td>

                            <td class="px-6 py-5 font-bold text-green-500">
                                +800
                            </td>

                            <td class="px-6 py-5 text-gray-500">
                                09:51
                            </td>

                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold text-yellow-600 dark:text-yellow-400"
                                >
                                    Menunggu
                                </span>

                            </td>

                        </tr>

                    </tbody>

                </table>

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