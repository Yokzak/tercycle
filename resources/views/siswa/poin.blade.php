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

    <title>Riwayat Poin - Tercycle</title>

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


            {{-- RIWAYAT POIN ACTIVE --}}

            <a
                href="/siswa/poin"
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
                        d="M12 6v6l4 2"
                    />

                    <circle
                        cx="12"
                        cy="12"
                        r="9"
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
                        d="M7 3h10M8 3v4l-2 3v8a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3v-8l-2-3V3M7 10h10"
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
                        d="M15 19a6 6 0 0 0-12 0m6-8a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm9-4v6m3-3h-6"
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

                <div class="min-w-0">

                    <p class="truncate text-sm font-semibold">
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
                Poin
            </p>

            <h1 class="font-bold">
                Riwayat Poin
            </h1>

        </div>


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

    <main class="mx-auto max-w-6xl px-6 py-8 lg:px-8">


        {{-- PAGE HEADER --}}

        <div class="mb-8">

            <p class="text-sm font-medium text-green-500">
                Poin Saya
            </p>

            <h2 class="mt-2 text-3xl font-black">
                Riwayat Poin
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Lihat seluruh pemasukan dan penggunaan poin kamu.
            </p>

        </div>



        {{-- ================================================= --}}
        {{-- SALDO + STAT --}}
        {{-- ================================================= --}}

        <div class="grid gap-4 md:grid-cols-3">


            {{-- SALDO --}}

            <div
                class="relative overflow-hidden rounded-2xl bg-green-500 p-6 text-gray-950 md:col-span-2"
            >

                <div
                    class="absolute -right-12 -top-12 h-40 w-40 rounded-full bg-white/10"
                ></div>

                <p class="relative text-sm font-semibold text-gray-950/70">
                    Saldo Poin Saat Ini
                </p>

                <div class="relative mt-2 flex items-end gap-2">

                    <span class="text-4xl font-black">
                        12.500
                    </span>

                    <span class="mb-1 font-semibold">
                        poin
                    </span>

                </div>

                <p class="relative mt-3 text-xs text-gray-950/70">
                    Bisa digunakan untuk membeli produk.
                </p>

            </div>



            {{-- TOTAL DIDAPAT --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-semibold text-gray-500">
                    Total Poin Didapat
                </p>

                <p class="mt-2 text-2xl font-black">
                    15.500
                </p>

                <p class="mt-2 text-xs text-green-500">
                    +500 poin bulan ini
                </p>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- FILTER --}}
        {{-- ================================================= --}}

        <div
            class="mt-8 flex flex-col gap-4 rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03] sm:flex-row sm:items-center sm:justify-between"
        >

            <div>

                <h3 class="font-bold">
                    Aktivitas Poin
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Riwayat transaksi poin kamu.
                </p>

            </div>


            <div class="flex gap-2">

                <button
                    class="rounded-xl bg-green-500 px-4 py-2 text-xs font-semibold text-gray-950"
                >
                    Semua
                </button>

                <button
                    class="rounded-xl border border-gray-200 px-4 py-2 text-xs font-semibold text-gray-500 transition hover:border-green-500 hover:text-green-500 dark:border-white/10"
                >
                    Masuk
                </button>

                <button
                    class="rounded-xl border border-gray-200 px-4 py-2 text-xs font-semibold text-gray-500 transition hover:border-green-500 hover:text-green-500 dark:border-white/10"
                >
                    Keluar
                </button>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- RIWAYAT --}}
        {{-- ================================================= --}}

        <div
            class="mt-4 overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
        >

            {{-- HEADER --}}

            <div
                class="hidden border-b border-gray-200 px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:border-white/10 sm:grid sm:grid-cols-12"
            >

                <div class="col-span-5">
                    Aktivitas
                </div>

                <div class="col-span-3">
                    Tanggal
                </div>

                <div class="col-span-2">
                    Status
                </div>

                <div class="col-span-2 text-right">
                    Poin
                </div>

            </div>



            {{-- ITEM 1 --}}

            <div
                class="grid gap-3 border-b border-gray-200 px-6 py-5 dark:border-white/10 sm:grid-cols-12 sm:items-center"
            >

                <div class="flex items-center gap-4 sm:col-span-5">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green-500/10 font-bold text-green-500"
                    >
                        +
                    </div>

                    <div>

                        <p class="text-sm font-semibold">
                            Penukaran Botol
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            10 botol plastik
                        </p>

                    </div>

                </div>


                <div class="text-xs text-gray-500 sm:col-span-3">
                    10 Agustus 2026
                </div>


                <div class="sm:col-span-2">

                    <span
                        class="rounded-full bg-green-500/10 px-3 py-1 text-[11px] font-semibold text-green-500"
                    >
                        Berhasil
                    </span>

                </div>


                <div
                    class="text-sm font-bold text-green-500 sm:col-span-2 sm:text-right"
                >
                    +500
                </div>

            </div>



            {{-- ITEM 2 --}}

            <div
                class="grid gap-3 border-b border-gray-200 px-6 py-5 dark:border-white/10 sm:grid-cols-12 sm:items-center"
            >

                <div class="flex items-center gap-4 sm:col-span-5">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-500/10 font-bold text-red-500"
                    >
                        -
                    </div>

                    <div>

                        <p class="text-sm font-semibold">
                            Pembelian Produk
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            Pulpen Eco
                        </p>

                    </div>

                </div>


                <div class="text-xs text-gray-500 sm:col-span-3">
                    9 Agustus 2026
                </div>


                <div class="sm:col-span-2">

                    <span
                        class="rounded-full bg-green-500/10 px-3 py-1 text-[11px] font-semibold text-green-500"
                    >
                        Berhasil
                    </span>

                </div>


                <div
                    class="text-sm font-bold text-red-500 sm:col-span-2 sm:text-right"
                >
                    -1.000
                </div>

            </div>



            {{-- ITEM 3 --}}

            <div
                class="grid gap-3 border-b border-gray-200 px-6 py-5 dark:border-white/10 sm:grid-cols-12 sm:items-center"
            >

                <div class="flex items-center gap-4 sm:col-span-5">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green-500/10 font-bold text-green-500"
                    >
                        +
                    </div>

                    <div>

                        <p class="text-sm font-semibold">
                            Penukaran Botol
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            20 botol plastik
                        </p>

                    </div>

                </div>


                <div class="text-xs text-gray-500 sm:col-span-3">
                    8 Agustus 2026
                </div>


                <div class="sm:col-span-2">

                    <span
                        class="rounded-full bg-green-500/10 px-3 py-1 text-[11px] font-semibold text-green-500"
                    >
                        Berhasil
                    </span>

                </div>


                <div
                    class="text-sm font-bold text-green-500 sm:col-span-2 sm:text-right"
                >
                    +1.000
                </div>

            </div>



            {{-- ITEM 4 --}}

            <div
                class="grid gap-3 border-b border-gray-200 px-6 py-5 dark:border-white/10 sm:grid-cols-12 sm:items-center"
            >

                <div class="flex items-center gap-4 sm:col-span-5">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-500/10 font-bold text-red-500"
                    >
                        -
                    </div>

                    <div>

                        <p class="text-sm font-semibold">
                            Pembelian Produk
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            Tumbler Eco
                        </p>

                    </div>

                </div>


                <div class="text-xs text-gray-500 sm:col-span-3">
                    5 Agustus 2026
                </div>


                <div class="sm:col-span-2">

                    <span
                        class="rounded-full bg-green-500/10 px-3 py-1 text-[11px] font-semibold text-green-500"
                    >
                        Berhasil
                    </span>

                </div>


                <div
                    class="text-sm font-bold text-red-500 sm:col-span-2 sm:text-right"
                >
                    -5.000
                </div>

            </div>



            {{-- ITEM 5 --}}

            <div
                class="grid gap-3 px-6 py-5 sm:grid-cols-12 sm:items-center"
            >

                <div class="flex items-center gap-4 sm:col-span-5">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green-500/10 font-bold text-green-500"
                    >
                        +
                    </div>

                    <div>

                        <p class="text-sm font-semibold">
                            Penukaran Botol
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            15 botol plastik
                        </p>

                    </div>

                </div>


                <div class="text-xs text-gray-500 sm:col-span-3">
                    2 Agustus 2026
                </div>


                <div class="sm:col-span-2">

                    <span
                        class="rounded-full bg-green-500/10 px-3 py-1 text-[11px] font-semibold text-green-500"
                    >
                        Berhasil
                    </span>

                </div>


                <div
                    class="text-sm font-bold text-green-500 sm:col-span-2 sm:text-right"
                >
                    +750
                </div>

            </div>

        </div>



        {{-- INFO --}}

        <div
            class="mt-5 rounded-2xl border border-green-500/20 bg-green-500/5 p-5"
        >

            <div class="flex gap-3">

                <div
                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-green-500/10 font-bold text-green-500"
                >
                    i
                </div>

                <div>

                    <p class="text-sm font-semibold">
                        Cara mendapatkan poin
                    </p>

                    <p class="mt-1 text-xs leading-5 text-gray-500">
                        Setorkan botol melalui admin Tercycle.
                        Setelah penukaran dikonfirmasi, poin akan
                        otomatis masuk ke saldo akun kamu.
                    </p>

                </div>

            </div>

        </div>


    </main>



    {{-- FOOTER --}}

    <footer
        class="mt-8 border-t border-gray-200 dark:border-white/10"
    >

        <div
            class="mx-auto flex max-w-6xl items-center justify-between px-6 py-6 lg:px-8"
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