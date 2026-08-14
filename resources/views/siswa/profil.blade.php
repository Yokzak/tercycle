<!DOCTYPE html>
<html
    lang="id"
    x-data="{
        dark: localStorage.getItem('theme') !== 'light',
        sidebarOpen: false,
        logoutModal: false,
        editProfileModal: false,

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

    <title>Profil Siswa - Tercycle</title>

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


            {{-- PROFIL ACTIVE --}}

            <a
                href="/siswa/profil"
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

                {{-- AVATAR --}}
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-green-500 font-bold text-gray-950"
                >
                    K
                </div>

                {{-- NAMA --}}
                <div class="min-w-0 flex-1">

                    <p class="truncate text-sm font-semibold">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Siswa • {{ Auth::user()->siswa->kelas }} {{ Auth::user()->siswa->jurusan->kode_jurusan ?? '-' }}
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
        class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-gray-200 bg-white/90 px-6 backdrop-blur-xl dark:border-white/10 dark:bg-gray-950/90 lg:px-8"
    >

        <div>

            <p class="text-sm font-medium text-gray-500">
                Account
            </p>

            <h1 class="font-bold">
                Profil Saya
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

    <main class="mx-auto max-w-6xl px-6 py-8 lg:px-8">


        <div class="mb-8">

            <h2 class="text-2xl font-black">
                Profil Siswa
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Kelola informasi akun dan kode unik Tercycle kamu.
            </p>

        </div>



        {{-- PROFILE HEADER --}}

        <div
            class="overflow-hidden rounded-3xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
        >

            <div
                class="h-32 bg-gradient-to-r from-green-500/30 via-green-400/10 to-transparent"
            ></div>


            <div class="px-6 pb-6 lg:px-8">

                <div
                    class="-mt-12 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between"
                >

                    <div class="flex items-end gap-4">

                        <div
                            class="flex h-24 w-24 items-center justify-center rounded-3xl border-4 border-white bg-green-500 text-3xl font-black text-gray-950 dark:border-gray-950"
                        >
                            K
                        </div>


                        <div class="pb-1">

                            <h3 class="text-xl font-black">
                                {{ Auth::user()->name }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                Siswa • {{ Auth::user()->siswa->kelas }} {{ Auth::user()->siswa->jurusan->kode_jurusan ?? '-' }}
                            </p>

                        </div>

                    </div>

                    <button
                        type="button"
                        @click="editProfileModal = true"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-4 py-2 font-semibold text-gray-700 transition hover:bg-gray-50 dark:border-white/10 dark:bg-white/[0.03] dark:text-gray-300 dark:hover:bg-white/10"
                    >
                        Edit Profil
                    </button>

                </div>

            </div>

        </div>



        {{-- GRID --}}

        <div class="mt-6 grid gap-6 lg:grid-cols-3">


            {{-- PERSONAL INFORMATION --}}

            <div class="rounded-2xl border border-gray-200 bg-white p-6 lg:col-span-2 dark:border-white/10 dark:bg-white/[0.03]">
                <div class="mb-6">
                    <h3 class="font-bold">Informasi Akun</h3>

                    <p class="mt-1 text-xs text-gray-500">Informasi dasar akun siswa.</p>

                </div>


                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label class="text-xs font-semibold text-gray-500">Nama Lengkap</label>
                        <div class="mt-2 rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm dark:border-white/10 dark:bg-gray-900">
                            {{ $user->siswa->nama_lengkap }} 
                        </div>
                    </div>


                    <div>
                        <label class="text-xs font-semibold text-gray-500">NIS</label>

                        <div class="mt-2 rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm dark:border-white/10 dark:bg-gray-900">
                            {{ $user->siswa->nis }} 
                        </div>
                    </div>


                    <div>
                        <label class="text-xs font-semibold text-gray-500">Kelas</label>

                        <div class="mt-2 rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm dark:border-white/10 dark:bg-gray-900">
                            {{ $user->siswa->kelas }}
                        </div>

                    </div>


                    <div>
                        <label class="text-xs font-semibold text-gray-500">Email</label>

                        <div class="mt-2 rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm dark:border-white/10 dark:bg-gray-900">
                            {{ $user->email }}
                        </div>

                    </div>

                    <div>
                        <label class="text-xs font-semibold text-gray-500">Jurusan</label>

                        <div class="mt-2 rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm dark:border-white/10 dark:bg-gray-900">
                            {{ $user->siswa->jurusan->kode_jurusan  ?? '-'}} - {{ $user->siswa->jurusan->nama_jurusan ?? '-' }}
                        </div>
                    </div>

                    <div>

                        <label class="text-xs font-semibold text-gray-500">Bergabung Sejak</label>

                        <div class="mt-2 rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm dark:border-white/10 dark:bg-gray-900">
                            {{ $user->created_at->format('d F Y') }}
                        </div>

                    </div>

                </div>

            </div>



            {{-- QR / UNIQUE CODE --}}

            <div
                class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div>

                    <h3 class="font-bold">
                        Kode Tercycle
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Gunakan kode ini saat setor botol.
                    </p>

                </div>


                {{-- QR PLACEHOLDER --}}

                <div class="mx-auto mt-6 flex h-44 w-44 items-center justify-center rounded-2xl border-4 border-gray-900 bg-white p-4 dark:border-white">
                    {!! $qr !!}
                </div>


                <div class="mt-5 text-center">

                    <p class="text-xs text-gray-500">
                        Kode unik
                    </p>

                    <p class="mt-1 font-mono text-lg font-black tracking-widest text-green-500">
                        {{ $user->siswa->kode_siswa }}
                    </p>

                </div>


                <button
                    type="button"
                    @click="navigator.clipboard.writeText('{{ $user->siswa->kode_siswa }}')"
                    class="mt-5 w-full rounded-xl border border-gray-200 px-4 py-3 text-sm font-semibold transition hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                >
                    Salin Kode
                </button>

            </div>

        </div>



        {{-- ACCOUNT STATUS --}}

        <div
            class="mt-6 rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
        >

            <div
                class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between"
            >

                <div>

                    <h3 class="font-bold">
                        Status Akun
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Status akun siswa saat ini.
                    </p>

                </div>


                <span
                    class="inline-flex w-fit items-center gap-2 rounded-full bg-green-500/10 px-4 py-2 text-xs font-bold text-green-500"
                >

                    <span
                        class="h-2 w-2 rounded-full bg-green-500"
                    ></span>

                    Akun Aktif

                </span>

            </div>

        </div>



        {{-- FOOTER --}}

        <div
            class="mt-8 border-t border-gray-200 pt-6 text-center text-xs text-gray-500 dark:border-white/10"
        >
            Tercycle • Sistem Pengelolaan Daur Ulang Sekolah
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
{{-- MODAL EDIT PROFIL --}}
<div
    x-show="editProfileModal"
    x-transition.opacity
    x-effect="document.body.style.overflow = editProfileModal ? 'hidden' : ''"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
    style="display: none;"
>
    {{-- BACKDROP --}}
    <div
        class="absolute inset-0 bg-black/50 backdrop-blur-md"
        @click="editProfileModal = false"
    ></div>

    {{-- MODAL --}}
    <div
        x-show="editProfileModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @click.stop
        class="relative max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-2xl bg-white shadow-2xl dark:bg-gray-900"
    >

        {{-- HEADER --}}
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10">
            <div>
                <h2 class="text-lg font-bold">
                    Edit Profil
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Perbarui informasi profil kamu.
                </p>
            </div>

            <button
                type="button"
                @click="editProfileModal = false"
                class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/10 dark:hover:text-white"
            >
                ✕
            </button>
        </div>

        {{-- FORM --}}
        <form
            action="{{ route('siswa.profil.update') }}"
            method="POST"
            class="p-6"
        >
            @csrf
            @method('PUT')

            {{-- NAMA LENGKAP --}}
            <div>
                <label
                    for="edit_nama_lengkap"
                    class="mb-2 block text-sm font-semibold"
                >
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    id="edit_nama_lengkap"
                    value="{{ $user->siswa->nama_lengkap }}"
                    readonly
                    class="w-full cursor-not-allowed rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 text-sm text-gray-500 dark:border-white/10 dark:bg-gray-800 dark:text-gray-400"
                >
            </div>

            {{-- NIS --}}
            <div class="mt-5">
                <label
                    for="edit_nis"
                    class="mb-2 block text-sm font-semibold"
                >
                    NIS
                </label>

                <input
                    type="text"
                    id="edit_nis"
                    value="{{ $user->siswa->nis }}"
                    readonly
                    class="w-full cursor-not-allowed rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 text-sm text-gray-500 dark:border-white/10 dark:bg-gray-800 dark:text-gray-400"
                >

                <p class="mt-1 text-xs text-gray-400">
                    NIS tidak dapat diubah.
                </p>
            </div>

            {{-- KELAS --}}
            <div class="mt-5">
                <label
                    for="edit_kelas"
                    class="mb-2 block text-sm font-semibold"
                >
                    Kelas
                </label>

                <select
                    id="edit_kelas"
                    name="kelas"
                    required
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                >
                    <option value="X" @selected($user->siswa->kelas === 'X')>
                        X
                    </option>

                    <option value="XI" @selected($user->siswa->kelas === 'XI')>
                        XI
                    </option>

                    <option value="XII" @selected($user->siswa->kelas === 'XII')>
                        XII
                    </option>
                </select>
            </div>

            {{-- EMAIL --}}
            <div class="mt-5">
                <label
                    for="edit_email"
                    class="mb-2 block text-sm font-semibold"
                >
                    Email
                </label>

                <input
                    type="email"
                    id="edit_email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    readonly
                    class="w-full cursor-not-allowed rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 text-sm text-gray-500 dark:border-white/10 dark:bg-gray-800 dark:text-gray-400"
                >
            </div>

            {{-- JURUSAN --}}
            <div class="mt-5">
                <label
                    for="edit_jurusan"
                    class="mb-2 block text-sm font-semibold"
                >
                    Jurusan
                </label>

                <select
                    id="edit_jurusan"
                    name="jurusan_id"
                    required
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                >
                    @foreach ($jurusans as $jurusan)
                        <option
                            value="{{ $jurusan->id }}"
                            @selected($user->siswa->jurusan_id == $jurusan->id)
                        >
                            {{ $jurusan->kode_jurusan }} - {{ $jurusan->nama_jurusan }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- BUTTON --}}
            <div class="mt-7 flex justify-end gap-3 border-t border-gray-200 pt-5 dark:border-white/10">

                <button
                    type="button"
                    @click="editProfileModal = false"
                    class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-100 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/5"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
                >
                    Simpan
                </button>

            </div>
        </form>
    </div>
</div>
</body>
</html>