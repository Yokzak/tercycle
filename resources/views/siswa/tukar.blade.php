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
    x-init="document.documentElement.classList.toggle('dark', dark)"
    :class="{ 'dark': dark }"
>

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Setor Botol - Tercycle</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body
    class="min-h-screen bg-gray-50 text-gray-900 transition-colors duration-300 dark:bg-gray-950 dark:text-white"
>


{{-- ========================================================= --}}
{{-- SIDEBAR --}}
{{-- ========================================================= --}}

<aside
    class="fixed inset-y-0 left-0 z-50 w-64 border-r border-gray-200 bg-white transition-transform duration-300 dark:border-white/10 dark:bg-gray-950 lg:block"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
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


            {{-- SETOR BOTOL ACTIVE --}}

            <a
                href="/siswa/tukar"
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

                {{-- AVATAR --}}
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-green-500 font-bold text-gray-950"
                >
                    K
                </div>

                {{-- NAMA --}}
                <div class="min-w-0 flex-1">

                    <p class="truncate text-sm font-semibold">
                        Kevin
                    </p>

                    <p class="text-xs text-gray-500">
                        Siswa
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



<!-- MOBILE HEADER -->
<header
    class="flex h-16 items-center justify-between border-b border-gray-200 bg-white px-5 dark:border-white/10 dark:bg-gray-950 lg:hidden"
>

    <!-- HAMBURGER -->
    <button
        type="button"
        @click="sidebarOpen = true"
        class="flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-gray-50 text-gray-700 transition hover:border-green-500 hover:text-green-500 dark:border-white/10 dark:bg-white/5 dark:text-gray-300"
        aria-label="Buka menu"
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

    </button>


    <!-- LOGO -->

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


    <!-- THEME -->

    <button
        type="button"
        @click="toggleTheme()"
        class="flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-gray-50 text-gray-700 transition dark:border-white/10 dark:bg-white/5 dark:text-gray-300"
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

</header>



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
                Setor Sampah
            </p>

            <h1 class="font-bold">
                Tukar Botol
            </h1>

        </div>


        <div class="flex items-center gap-2">

            {{-- KERANJANG --}}
            <a
                href="/siswa/keranjang"
                class="relative flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-gray-50 text-gray-700 transition hover:bg-gray-100 dark:border-white/10 dark:bg-white/5 dark:text-gray-300 dark:hover:bg-white/10"
                title="Keranjang"
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
                        d="M2.25 3h1.386a1.5 1.5 0 0 1 1.46 1.15L5.42 6m0 0h14.33a1.5 1.5 0 0 1 1.46 1.85l-1.05 4.5a1.5 1.5 0 0 1-1.46 1.15H8.25a1.5 1.5 0 0 1-1.46-1.15L5.42 6Z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M8.25 18.75a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Zm9 0a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Z"
                    />
                </svg>

                {{-- BADGE JUMLAH --}}
                <span
                    class="absolute -right-1 -top-1 flex h-5 min-w-5 items-center justify-center rounded-full bg-red-500 px-1 text-[10px] font-bold text-white"
                >
                    0
                </span>
            </a>

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

        </div>

    </header>



    {{-- CONTENT --}}

        <main
            class="mx-auto max-w-6xl px-6 py-8 lg:px-8"
        >

        {{-- HEADER --}}

        <div class="mb-8">

            <p class="text-sm font-medium text-green-500">
                Setor Sampah
            </p>

            <h2 class="mt-2 text-3xl font-black">
                Tukarkan Botolmu
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Masukkan jumlah sampah yang ingin kamu setorkan.
            </p>

        </div>



        {{-- ================================================= --}}
        {{-- INFO --}}
        {{-- ================================================= --}}

        <div
            class="mb-6 flex gap-4 rounded-2xl border border-green-500/20 bg-green-500/5 p-5"
        >

            <div
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green-500/10 font-bold text-green-500"
            >
                i
            </div>

            <div>

                <p class="text-sm font-semibold">
                    Bagaimana cara setor?
                </p>

                <p class="mt-1 text-xs leading-5 text-gray-500">
                    Pilih jenis botol, masukkan jumlahnya, lalu ajukan
                    penukaran. Bawa sampah tersebut ke admin untuk
                    diverifikasi.
                </p>

            </div>

        </div>



       <div
    x-data="{
        items: [
            @foreach ($kategoriBotol as $kategori)
                {
                    id: {{ $kategori->id }},
                    nama: @js($kategori->nama_kategori),
                    poin: {{ $kategori->poin_satuan }},
                    jumlah: 0
                },
            @endforeach
        ],

        catatan: '',

        get totalBotol() {
            return this.items.reduce(
                (total, item) => total + Number(item.jumlah),
                0
            );
        },

        get totalPoin() {
            return this.items.reduce(
                (total, item) =>
                    total + (Number(item.jumlah) * Number(item.poin)),
                0
            );
        },

        tambah(index) {
            this.items[index].jumlah++;
        },

        kurang(index) {
            if (this.items[index].jumlah > 0) {
                this.items[index].jumlah--;
            }
        }
    }"
>

    <form
        action="{{ route('siswa.tukar.store') }}"
        method="POST"
    >
        @csrf

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- ============================================= --}}
            {{-- JENIS BOTOL --}}
            {{-- ============================================= --}}

            <div class="space-y-4 lg:col-span-2">

                <div
                    class="rounded-2xl border border-gray-200 bg-white p-6
                    dark:border-white/10 dark:bg-white/[0.03]"
                >

                    <div class="mb-6">

                        <h3 class="font-bold">
                            Jenis Botol
                        </h3>

                       
                    </div>


                    {{-- LOOP KATEGORI BOTOL --}}

                    <template
    x-for="(item, index) in items"
    :key="item.id"
>
    <div
        class="flex flex-col gap-4 border-b
        border-gray-200 py-5 last:border-0
        dark:border-white/10
        sm:flex-row sm:items-center
        sm:justify-between"
    >

        {{-- ID KATEGORI --}}
        <input
            type="hidden"
            :name="'botol[' + index + '][kategori_botol_id]'"
            :value="item.id"
        >

        {{-- INFO BOTOL --}}
        <div class="flex items-center gap-4">

            <div
                class="flex h-12 w-12 shrink-0
                items-center justify-center
                rounded-xl bg-green-500/10
                text-green-500"
            >
                ♻
            </div>

            <div>

                <p
                    class="font-semibold"
                    x-text="item.nama"
                ></p>

                <p class="mt-1 text-xs text-gray-500">

                    <span
                        x-text="Number(item.poin).toLocaleString('id-ID')"
                    ></span>

                    poin / botol

                </p>

            </div>

        </div>


        {{-- JUMLAH --}}
        <div class="flex items-center gap-3">

            {{-- MINUS --}}
            <button
                type="button"
                @click="kurang(index)"
                class="flex h-9 w-9 items-center
                justify-center rounded-lg
                border border-gray-200
                text-lg text-gray-500
                transition hover:border-green-500
                hover:text-green-500
                dark:border-white/10"
            >
                -
            </button>


            {{-- JUMLAH BOTOL --}}
            <input
                type="number"
                min="0"
                :name="'botol[' + index + '][jumlah_botol]'"
                x-model.number="item.jumlah"
                :disabled="item.jumlah === 0"
                class="w-16 rounded-lg border
                border-gray-200 bg-white px-2 py-2
                text-center font-bold outline-none
                focus:border-green-500
                dark:border-white/10
                dark:bg-white/5"
            >


            {{-- PLUS --}}
            <button
                type="button"
                @click="tambah(index)"
                class="flex h-9 w-9 items-center
                justify-center rounded-lg
                bg-green-500 text-lg font-bold
                text-gray-950 transition
                hover:bg-green-400"
            >
                +
            </button>

        </div>

    </div>
</template>
                </div>


                {{-- ============================================= --}}
                {{-- CATATAN --}}
                {{-- ============================================= --}}

                <div
                    class="rounded-2xl border border-gray-200
                    bg-white p-6
                    dark:border-white/10
                    dark:bg-white/[0.03]"
                    hidden
                >

                    <h3 class="font-bold" hidden>
                        Catatan
                    </h3>

                    <p class="mt-1 text-xs text-gray-500" hidden>
                        Tambahkan catatan jika diperlukan.
                    </p>

                    <textarea hidden
                        name="catatan"
                        x-model="catatan"
                        rows="4"
                        placeholder="Contoh: Botol sudah dipisahkan berdasarkan ukuran..."
                        class="mt-5 w-full resize-none rounded-xl
                        border border-gray-200 bg-gray-50 px-4 py-3
                        text-sm outline-none transition
                        placeholder:text-gray-400
                        focus:border-green-500
                        focus:ring-2 focus:ring-green-500/10
                        dark:border-white/10
                        dark:bg-white/5"
                    ></textarea>

                </div>

            </div>


            {{-- ============================================= --}}
            {{-- RINGKASAN --}}
            {{-- ============================================= --}}

            <div class="lg:col-span-1">

                <div
                    class="sticky top-28 rounded-2xl
                    border border-gray-200 bg-white p-6
                    dark:border-white/10
                    dark:bg-white/[0.03]"
                >

                    <h3 class="font-bold">
                        Ringkasan Pengajuan
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Periksa kembali sebelum mengajukan.
                    </p>


                    <div class="mt-6 space-y-4">


                        {{-- TOTAL BOTOL --}}

                        <div class="space-y-3">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                                Detail setoran
                            </p>
                            <template x-for="item in items" :key="item.id">
                                <div x-show="Number(item.jumlah) > 0" class="flex justify-between text-sm">
                                    <span class="text-gray-500"><span x-text="item.nama"></span></span>
                                    <span class="font-semibold">
                                        <span x-text="item.jumlah"></span>
                                        x 
                                        <span x-text="Number(item.poin).toLocaleString('id-ID')"></span>
                                </span>
                                </div>
                            </template>
                            <p x-show="totalBotol === 0" class="text-xs text-gray-400">Belum ada botol yang dipilih</p>
                        </div>


                        {{-- TOTAL POIN --}}

                        <div
                            class="border-t border-gray-200 pt-4
                            dark:border-white/10"
                        >

                            <div
                                class="rounded-xl bg-green-500/10 p-4"
                            >

                                <p class="text-xs text-gray-500">
                                    Estimasi poin
                                </p>

                                <div
                                    class="mt-1 flex items-end gap-2"
                                >

                                    <span
                                        class="text-3xl font-black
                                        text-green-500"
                                        x-text="
                                            totalPoin.toLocaleString('id-ID')
                                        "
                                    >
                                        0
                                    </span>

                                    <span
                                        class="mb-1 text-sm font-semibold
                                        text-green-500"
                                    >
                                        poin
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- INFORMASI WORKFLOW --}}

                        <div
                            class="rounded-xl border
                            border-yellow-200 bg-yellow-50 p-4
                            dark:border-yellow-500/20
                            dark:bg-yellow-500/5"
                        >

                            <p class="text-xs leading-5 text-gray-600
                                dark:text-gray-300"
                            >
                                Setelah mengajukan, silakan serahkan
                                botol kepada admin. Poin akan masuk
                                setelah botol diverifikasi dan
                                pengajuan dikonfirmasi.
                            </p>

                        </div>


                        {{-- SUBMIT --}}

                        <button
                            type="submit"
                            :disabled="totalBotol === 0"
                            class="w-full rounded-xl
                            bg-green-500 px-5 py-3
                            text-sm font-bold text-gray-950
                            transition hover:bg-green-400
                            disabled:cursor-not-allowed
                            disabled:opacity-50"
                        >
                            Ajukan Penukaran
                        </button>


                        <p
                            class="text-center text-[11px]
                            leading-4 text-gray-400"
                        >
                            Pengajuan akan berstatus
                            <strong>menunggu</strong>
                            sampai diverifikasi admin.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>


        {{-- ================================================= --}}
        {{-- RIWAYAT PENGAJUAN --}}
        {{-- ================================================= --}}

        <div class="mt-8">

            <div class="mb-4">

                <h3 class="font-bold">
                    Pengajuan Terakhir
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Status penukaran sampah kamu.
                </p>

            </div>


            

                <div
                    class="hidden border-b border-gray-200 px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:border-white/10 sm:grid sm:grid-cols-12"
                >

                    <div class="col-span-4">
                        Pengajuan
                    </div>

                    <div class="col-span-3">
                        Tanggal
                    </div>

                    <div class="col-span-2">
                        Jumlah
                    </div>

                    <div class="col-span-3 text-right">
                        Status
                    </div>

                </div>


                {{-- ITEM --}}
                @if ($pengajuan->count()) 
                    @foreach ($pengajuan as $item) 
                        <div class="grid gap-3 border-b border-gray-200 px-6 py-5 dark:border-white/10 sm:grid-cols-12 sm:items-center">

                            <div class="sm:col-span-4"> 
                                <p class="text-sm font-semibold">
                                    #SETOR-{{ str_pad($item->id, 5,'0', STR_PAD_LEFT) }}
                                </p>
                                <p class="mt-1 text-xs text-gray-500">
                                    @foreach ($item->detailPenukaran as $detail )
                                    {{ $detail->kategoriBotol->nama_kategori }}

                                    @if(!$loop->last),
                                    @endif
                                        
                                    @endforeach
                                </p>
                            </div>

                            <div class="text-xs text-gray-500 sm:col-span-3">

                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}

                            </div>

                            <div class="text-sm font-semibold sm:col-span-2">
                                {{ $item->detailPenukaran->sum('jumlah_botol') }} 
                                item
                            </div>
                            
                            <div class="sm:col-span-3 sm:text-right">
                                @if($item->status === 'menunggu')

                                <span class="rounded-full bg-yellow-500/10 px-3 py-1 text-[11px] font-semibold text-yellow-600 dark:text-yellow-400">
                                Menunggu Verifikasi
                            </span>
                            @elseif($item->status === 'disetujui')
                            <span class="rounded-full bg-green-500/10 px-3 py-1 text-[11px] font-semibold text-green-500">
                                Berhasil
                            </span>
                            @elseif($item->status === "ditolak")
                            <span class="rounded-full bg-red-500/10 px-3 py-1 text-[11px] font-semibold text-red-500">
                            Ditolak
                            </span>

                            @endif

                            </div>

                        </div>
                    
                        
                        
                    @endforeach
                @else
                    <div class="px-6 py-10 text-center">
                        <p class="text-sm text-gray-500">
                            Belum ada pengajuan penukaran
                        </p>
                    </div>
                @endif
                
                    

                
        


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