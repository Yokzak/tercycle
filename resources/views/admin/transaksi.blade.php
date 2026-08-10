
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

    <title>Transaksi - Admin Tercycle</title>

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


            <a
                href="/admin/dashboard"
                class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
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


            {{-- ACTIVE --}}

            <a
                href="/admin/transaksi"
                class="flex items-center gap-3 rounded-xl bg-green-500/10 px-3 py-3 text-sm font-semibold text-green-500"
            >
                <span class="text-lg">≡</span>
                Transaksi
            </a>

        </nav>



        {{-- ADMIN --}}

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
                Management
            </p>

            <h1 class="font-bold">
                Transaksi
            </h1>

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

        <div>

            <h2 class="text-2xl font-black">
                Riwayat Transaksi
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Pantau seluruh aktivitas poin dan pembelian siswa.
            </p>

        </div>



        {{-- STATISTICS --}}

        <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Total Transaksi
                </p>

                <p class="mt-2 text-3xl font-black">
                    1.284
                </p>

                <p class="mt-2 text-xs text-green-500">
                    +14,2% bulan ini
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Poin Masuk
                </p>

                <p class="mt-2 text-3xl font-black text-green-500">
                    +245.800
                </p>

                <p class="mt-2 text-xs text-gray-500">
                    Dari penukaran botol
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Poin Keluar
                </p>

                <p class="mt-2 text-3xl font-black">
                    -82.450
                </p>

                <p class="mt-2 text-xs text-gray-500">
                    Dari pembelian produk
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Transaksi Hari Ini
                </p>

                <p class="mt-2 text-3xl font-black">
                    47
                </p>

                <p class="mt-2 text-xs text-green-500">
                    Aktivitas normal
                </p>

            </div>

        </div>



        {{-- TRANSACTION TABLE --}}

        <div
            class="mt-8 overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
        >


            {{-- FILTER --}}

            <div
                class="flex flex-col gap-4 border-b border-gray-200 p-6 dark:border-white/10 lg:flex-row lg:items-center lg:justify-between"
            >

                <div>

                    <h3 class="font-bold">
                        Semua Transaksi
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Riwayat aktivitas terbaru.
                    </p>

                </div>


                <div class="flex flex-col gap-3 sm:flex-row">


                    {{-- SEARCH --}}

                    <div class="relative">

                        <input
                            type="text"
                            placeholder="Cari transaksi..."
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 pl-10 text-sm outline-none focus:border-green-500 sm:w-60 dark:border-white/10 dark:bg-gray-900"
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


                    {{-- TYPE --}}

                    <select
                        class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm outline-none focus:border-green-500 dark:border-white/10 dark:bg-gray-900"
                    >

                        <option>
                            Semua Transaksi
                        </option>

                        <option>
                            Penukaran Botol
                        </option>

                        <option>
                            Pembelian Produk
                        </option>

                    </select>


                    {{-- STATUS --}}

                    <select
                        class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm outline-none focus:border-green-500 dark:border-white/10 dark:bg-gray-900"
                    >

                        <option>
                            Semua Status
                        </option>

                        <option>
                            Berhasil
                        </option>

                        <option>
                            Menunggu
                        </option>

                        <option>
                            Dibatalkan
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
                                ID Transaksi
                            </th>

                            <th class="px-6 py-4">
                                Siswa
                            </th>

                            <th class="px-6 py-4">
                                Jenis
                            </th>

                            <th class="px-6 py-4">
                                Detail
                            </th>

                            <th class="px-6 py-4">
                                Poin
                            </th>

                            <th class="px-6 py-4">
                                Status
                            </th>

                            <th class="px-6 py-4">
                                Waktu
                            </th>

                        </tr>

                    </thead>



                    <tbody
                        class="divide-y divide-gray-200 dark:divide-white/10"
                    >


                        {{-- TRANSACTION 1 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <span class="font-mono text-xs font-semibold">
                                    TRX-001284
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-9 w-9 items-center justify-center rounded-full bg-green-500 font-bold text-gray-950"
                                    >
                                        K
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Kevin
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            ECO-2026-00125
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Penukaran
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <p class="font-medium">
                                    Botol Plastik
                                </p>

                                <p class="text-xs text-gray-500">
                                    25 botol
                                </p>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="font-bold text-green-500"
                                >
                                    +1.250
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Berhasil
                                </span>

                            </td>


                            <td class="whitespace-nowrap px-6 py-5">

                                <p class="text-xs font-medium">
                                    10 Agu 2026
                                </p>

                                <p class="text-xs text-gray-500">
                                    14:32
                                </p>

                            </td>

                        </tr>



                        {{-- TRANSACTION 2 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <span class="font-mono text-xs font-semibold">
                                    TRX-001283
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-900 font-bold text-white dark:bg-white dark:text-gray-950"
                                    >
                                        I
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Ilyas
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            ECO-2026-00118
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-blue-500/10 px-3 py-1 text-xs font-semibold text-blue-500"
                                >
                                    Pembelian
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <p class="font-medium">
                                    Tumbler Recycle
                                </p>

                                <p class="text-xs text-gray-500">
                                    1 produk
                                </p>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="font-bold text-red-500"
                                >
                                    -5.000
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Berhasil
                                </span>

                            </td>


                            <td class="whitespace-nowrap px-6 py-5">

                                <p class="text-xs font-medium">
                                    10 Agu 2026
                                </p>

                                <p class="text-xs text-gray-500">
                                    13:57
                                </p>

                            </td>

                        </tr>



                        {{-- TRANSACTION 3 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <span class="font-mono text-xs font-semibold">
                                    TRX-001282
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-9 w-9 items-center justify-center rounded-full bg-green-500 font-bold text-gray-950"
                                    >
                                        A
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Arya
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            ECO-2026-00109
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Penukaran
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <p class="font-medium">
                                    Botol Kaca
                                </p>

                                <p class="text-xs text-gray-500">
                                    10 botol
                                </p>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="font-bold text-green-500"
                                >
                                    +1.000
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold text-yellow-500"
                                >
                                    Menunggu
                                </span>

                            </td>


                            <td class="whitespace-nowrap px-6 py-5">

                                <p class="text-xs font-medium">
                                    10 Agu 2026
                                </p>

                                <p class="text-xs text-gray-500">
                                    13:21
                                </p>

                            </td>

                        </tr>



                        {{-- TRANSACTION 4 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <span class="font-mono text-xs font-semibold">
                                    TRX-001281
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-900 font-bold text-white dark:bg-white dark:text-gray-950"
                                    >
                                        W
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Wandi
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            ECO-2026-00097
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-blue-500/10 px-3 py-1 text-xs font-semibold text-blue-500"
                                >
                                    Pembelian
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <p class="font-medium">
                                    Tote Bag Recycle
                                </p>

                                <p class="text-xs text-gray-500">
                                    1 produk
                                </p>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="font-bold text-red-500"
                                >
                                    -3.500
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-500"
                                >
                                    Dibatalkan
                                </span>

                            </td>


                            <td class="whitespace-nowrap px-6 py-5">

                                <p class="text-xs font-medium">
                                    10 Agu 2026
                                </p>

                                <p class="text-xs text-gray-500">
                                    12:48
                                </p>

                            </td>

                        </tr>



                        {{-- TRANSACTION 5 --}}

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            <td class="px-6 py-5">

                                <span class="font-mono text-xs font-semibold">
                                    TRX-001280
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-900 font-bold text-white dark:bg-white dark:text-gray-950"
                                    >
                                        O
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            Omar
                                        </p>

                                        <p class="text-xs text-gray-500">
                                            ECO-2026-00081
                                        </p>

                                    </div>

                                </div>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Penukaran
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <p class="font-medium">
                                    Botol Plastik
                                </p>

                                <p class="text-xs text-gray-500">
                                    15 botol
                                </p>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="font-bold text-green-500"
                                >
                                    +750
                                </span>

                            </td>


                            <td class="px-6 py-5">

                                <span
                                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                >
                                    Berhasil
                                </span>

                            </td>


                            <td class="whitespace-nowrap px-6 py-5">

                                <p class="text-xs font-medium">
                                    10 Agu 2026
                                </p>

                                <p class="text-xs text-gray-500">
                                    11:26
                                </p>

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
                    Menampilkan 1-5 dari 1.284 transaksi
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

</div>


</body>
</html>