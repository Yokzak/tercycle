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
        document.documentElement.classList.toggle(
            'dark',
            dark
        )
    "
    :class="{ 'dark': dark }"
>

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tercycle - Bank Sampah Digital</title>

    {{-- Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine.js --}}
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>

</head>


<body
    class="bg-white text-gray-900 antialiased transition-colors duration-300 dark:bg-gray-950 dark:text-white"
>


{{-- ========================================================= --}}
{{-- NAVBAR --}}
{{-- ========================================================= --}}

<nav
    class="fixed inset-x-0 top-0 z-50 border-b border-gray-200/80 bg-white/90 backdrop-blur-xl transition-colors duration-300 dark:border-white/10 dark:bg-gray-950/90"
>

    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-6 lg:px-8">


        {{-- LOGO --}}
        <a
            href="/"
            class="flex items-center gap-3"
        >

            <div
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-500 font-black text-gray-950"
            >
                T
            </div>

            <span class="text-xl font-bold tracking-tight">
                Ter<span class="text-green-500">cycle</span>
            </span>

        </a>


        {{-- DESKTOP MENU --}}
        <div class="hidden items-center gap-8 md:flex">

            <a
                href="#beranda"
                class="text-sm font-medium text-gray-600 transition hover:text-green-500 dark:text-gray-300"
            >
                Beranda
            </a>

            <a
                href="#tentang"
                class="text-sm font-medium text-gray-600 transition hover:text-green-500 dark:text-gray-300"
            >
                Tentang
            </a>

            <a
                href="#cara-kerja"
                class="text-sm font-medium text-gray-600 transition hover:text-green-500 dark:text-gray-300"
            >
                Cara Kerja
            </a>

            <a
                href="#fitur"
                class="text-sm font-medium text-gray-600 transition hover:text-green-500 dark:text-gray-300"
            >
                Fitur
            </a>

        </div>


        {{-- RIGHT --}}
        <div class="flex items-center gap-3">


            {{-- THEME BUTTON --}}
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


            @guest
                {{-- LOGIN --}}
                <a
                    href="/login"
                    class="hidden rounded-xl px-4 py-2.5 text-sm font-semibold text-gray-600 transition hover:text-gray-950 dark:text-gray-300 dark:hover:text-white sm:block"
                >
                    Masuk
                </a>

            @endguest

            @auth
                <a
                    href="{{ Auth::user()->role === 'admin' ? '/admin/dashboard' : '/siswa/dashboard' }}"
                    class="hidden rounded-xl px-4 py-2.5 text-sm font-semibold text-gray-600 transition hover:text-gray-950 dark:text-gray-300 dark:hover:text-white sm:block"
                >
                    Dashboard
                </a>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button
                        type="submit"
                        class="rounded-xl bg-red-500 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-red-400"
                    >
                        Keluar
                    </button>
                </form>
            @endauth


            {{-- MOBILE MENU --}}
            <button
                type="button"
                onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                class="flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 text-gray-700 dark:border-white/10 dark:text-gray-300 md:hidden"
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

        </div>

    </div>


    {{-- MOBILE NAV --}}
    <div
        id="mobile-menu"
        class="hidden border-t border-gray-200 bg-white dark:border-white/10 dark:bg-gray-950 md:hidden"
    >

        <div class="space-y-1 px-6 py-5">

            <a
                href="#beranda"
                class="block rounded-lg px-3 py-2.5 text-sm text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-white/5"
            >
                Beranda
            </a>

            <a
                href="#tentang"
                class="block rounded-lg px-3 py-2.5 text-sm text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-white/5"
            >
                Tentang
            </a>

            <a
                href="#cara-kerja"
                class="block rounded-lg px-3 py-2.5 text-sm text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-white/5"
            >
                Cara Kerja
            </a>

            <a
                href="#fitur"
                class="block rounded-lg px-3 py-2.5 text-sm text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-white/5"
            >
                Fitur
            </a>

            @guest
                <a
                    href="/login"
                    class="block rounded-lg px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-white/5"
                >
                    Masuk
                </a>
            @endguest

            @auth
                <a
                    href="{{ Auth::user()->role === 'admin' ? '/admin/dashboard' : '/siswa/dashboard' }}"
                    class="block rounded-lg px-3 py-2.5 text-sm font-semibold text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-white/5"
                >
                    Dashboard
                </a>

                <form action="{{ route('logout') }}" method="POST" class="block">
                    @csrf
                    <button
                        type="submit"
                        class="w-full text-left rounded-lg px-3 py-2.5 text-sm font-semibold text-red-500 hover:bg-gray-100 dark:hover:bg-white/5"
                    >
                        Keluar
                    </button>
                </form>
            @endauth

        </div>

    </div>

</nav>



{{-- ========================================================= --}}
{{-- HERO --}}
{{-- ========================================================= --}}

<section
    id="beranda"
    class="relative overflow-hidden pt-20"
>


    {{-- BACKGROUND GLOW --}}
    <div
        class="pointer-events-none absolute left-1/2 top-0 -z-10 h-[600px] w-[800px] -translate-x-1/2 rounded-full bg-green-400/10 blur-3xl dark:bg-green-500/10"
    ></div>


    <div
        class="mx-auto max-w-7xl px-6 py-28 lg:px-8 lg:py-36"
    >

        <div class="mx-auto max-w-4xl text-center">


            {{-- BADGE --}}
            <div
                class="mb-7 inline-flex items-center gap-2 rounded-full border border-green-500/20 bg-green-500/10 px-4 py-2 text-sm font-medium text-green-600 dark:text-green-400"
            >

                <span
                    class="h-2 w-2 rounded-full bg-green-500"
                ></span>

                Bank Sampah Digital

            </div>


            {{-- TITLE --}}
            <h1
                class="text-5xl font-black tracking-tight text-gray-950 sm:text-6xl lg:text-7xl dark:text-white"
            >

                Ubah Sampah Menjadi

                <span class="text-green-500">
                    Poin Berharga
                </span>

            </h1>


            {{-- DESCRIPTION --}}
            <p
                class="mx-auto mt-7 max-w-2xl text-lg leading-8 text-gray-600 dark:text-gray-400"
            >

                Kumpulkan botol bekas, tukarkan menjadi poin,
                lalu gunakan poin tersebut untuk membeli berbagai
                produk yang tersedia di Tercycle.

            </p>


            {{-- BUTTON --}}
            <div
                class="mt-10 flex flex-col justify-center gap-4 sm:flex-row"
            >

                <a
                    href="/register"
                    class="rounded-xl bg-green-500 px-7 py-4 text-sm font-bold text-gray-950 shadow-lg shadow-green-500/20 transition hover:bg-green-400"
                >
                    Mulai Sekarang
                </a>
                

                <a
                    href="#cara-kerja"
                    class="rounded-xl border border-gray-200 bg-white px-7 py-4 text-sm font-semibold text-gray-800 transition hover:bg-gray-100 dark:border-white/10 dark:bg-white/5 dark:text-white dark:hover:bg-white/10"
                >
                    Pelajari Cara Kerja
                </a>

            </div>

        </div>


        {{-- STATISTICS --}}
        <div
            class="mx-auto mt-20 grid max-w-5xl grid-cols-2 gap-4 md:grid-cols-4"
        >

            <div
                class="rounded-2xl border border-gray-200 bg-white p-6 text-center shadow-sm dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none"
            >
                <p class="text-3xl font-black">
                    1K+
                </p>

                <p class="mt-1 text-sm text-gray-500">
                    Siswa
                </p>
            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-6 text-center shadow-sm dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none"
            >
                <p class="text-3xl font-black">
                    10K+
                </p>

                <p class="mt-1 text-sm text-gray-500">
                    Botol
                </p>
            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-6 text-center shadow-sm dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none"
            >
                <p class="text-3xl font-black">
                    50K+
                </p>

                <p class="mt-1 text-sm text-gray-500">
                    Poin
                </p>
            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-6 text-center shadow-sm dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none"
            >
                <p class="text-3xl font-black">
                    100+
                </p>

                <p class="mt-1 text-sm text-gray-500">
                    Produk
                </p>
            </div>

        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- TENTANG --}}
{{-- ========================================================= --}}

<section
    id="tentang"
    class="border-t border-gray-200 bg-gray-50 dark:border-white/10 dark:bg-gray-900"
>

    <div
        class="mx-auto max-w-7xl px-6 py-24 lg:px-8"
    >

        <div
            class="grid gap-16 lg:grid-cols-2 lg:items-center"
        >


            {{-- TEXT --}}
            <div>

                <p
                    class="text-sm font-bold uppercase tracking-widest text-green-500"
                >
                    Tentang Tercycle
                </p>


                <h2
                    class="mt-4 text-4xl font-black tracking-tight text-gray-950 dark:text-white"
                >
                    Satu sistem untuk lingkungan yang lebih baik.
                </h2>


                <p
                    class="mt-6 leading-7 text-gray-600 dark:text-gray-400"
                >

                    Tercycle adalah platform digital yang membantu
                    sekolah mengelola program pengumpulan botol
                    dengan sistem poin.

                </p>


                <p
                    class="mt-4 leading-7 text-gray-600 dark:text-gray-400"
                >

                    Siswa dapat mengumpulkan botol, mendapatkan poin,
                    dan menggunakan poin tersebut untuk membeli
                    produk di marketplace Tercycle.

                </p>

            </div>


            {{-- CARDS --}}
            <div
                class="grid grid-cols-2 gap-4"
            >

                <div
                    class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none"
                >

                    <div class="mb-5 text-3xl">
                        ♻
                    </div>

                    <h3 class="font-bold">
                        Ramah Lingkungan
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Membantu mengurangi sampah plastik.
                    </p>

                </div>


                <div
                    class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none"
                >

                    <div class="mb-5 text-3xl">
                        ★
                    </div>

                    <h3 class="font-bold">
                        Sistem Poin
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Botol dapat ditukar menjadi poin.
                    </p>

                </div>


                <div
                    class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none"
                >

                    <div class="mb-5 text-3xl">
                        QR
                    </div>

                    <h3 class="font-bold">
                        QR Unik
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Setiap siswa memiliki kode unik.
                    </p>

                </div>


                <div
                    class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none"
                >

                    <div class="mb-5 text-3xl">
                        $
                    </div>

                    <h3 class="font-bold">
                        Marketplace
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Gunakan poin untuk membeli produk.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- CARA KERJA --}}
{{-- ========================================================= --}}

<section
    id="cara-kerja"
    class="border-t border-gray-200 bg-white dark:border-white/10 dark:bg-gray-950"
>

    <div
        class="mx-auto max-w-7xl px-6 py-24 lg:px-8"
    >

        <div class="mx-auto max-w-2xl text-center">

            <p
                class="text-sm font-bold uppercase tracking-widest text-green-500"
            >
                Cara Kerja
            </p>

            <h2
                class="mt-4 text-4xl font-black"
            >
                Semudah tiga langkah
            </h2>

            <p
                class="mt-5 text-gray-600 dark:text-gray-400"
            >
                Kumpulkan, tukarkan, dan gunakan poinmu.
            </p>

        </div>


        <div
            class="mt-16 grid gap-6 md:grid-cols-3"
        >


            {{-- STEP 1 --}}
            <div
                class="rounded-2xl border border-gray-200 bg-gray-50 p-8 transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-500 font-black text-gray-950"
                >
                    01
                </div>

                <h3 class="mt-6 text-xl font-bold">
                    Kumpulkan
                </h3>

                <p
                    class="mt-3 leading-7 text-gray-600 dark:text-gray-500"
                >
                    Kumpulkan botol bekas sesuai jenis yang
                    diterima oleh sekolah.
                </p>

            </div>


            {{-- STEP 2 --}}
            <div
                class="rounded-2xl border border-gray-200 bg-gray-50 p-8 transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-500 font-black text-gray-950"
                >
                    02
                </div>

                <h3 class="mt-6 text-xl font-bold">
                    Tukarkan
                </h3>

                <p
                    class="mt-3 leading-7 text-gray-600 dark:text-gray-500"
                >
                    Tunjukkan QR atau kode unik kepada admin
                    untuk mencatat penukaran.
                </p>

            </div>


            {{-- STEP 3 --}}
            <div
                class="rounded-2xl border border-gray-200 bg-gray-50 p-8 transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-500 font-black text-gray-950"
                >
                    03
                </div>

                <h3 class="mt-6 text-xl font-bold">
                    Dapatkan Poin
                </h3>

                <p
                    class="mt-3 leading-7 text-gray-600 dark:text-gray-500"
                >
                    Setelah dikonfirmasi admin, poin masuk
                    ke saldo akunmu.
                </p>

            </div>

        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- FITUR --}}
{{-- ========================================================= --}}

<section
    id="fitur"
    class="border-t border-gray-200 bg-gray-50 dark:border-white/10 dark:bg-gray-900"
>

    <div
        class="mx-auto max-w-7xl px-6 py-24 lg:px-8"
    >

        <div class="mx-auto max-w-2xl text-center">

            <p
                class="text-sm font-bold uppercase tracking-widest text-green-500"
            >
                Fitur
            </p>

            <h2
                class="mt-4 text-4xl font-black"
            >
                Semua yang dibutuhkan
            </h2>

            <p
                class="mt-5 text-gray-600 dark:text-gray-400"
            >
                Satu platform untuk mengelola poin,
                produk, dan transaksi.
            </p>

        </div>


        <div
            class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-3"
        >


            {{-- FEATURE --}}
            @php
                $features = [
                    [
                        'title' => 'Saldo Poin',
                        'description' => 'Pantau jumlah poin yang kamu miliki secara langsung.',
                    ],
                    [
                        'title' => 'Riwayat Poin',
                        'description' => 'Lihat seluruh aktivitas penambahan dan penggunaan poin.',
                    ],
                    [
                        'title' => 'Marketplace',
                        'description' => 'Gunakan poin untuk membeli produk yang tersedia.',
                    ],
                    [
                        'title' => 'Jual Produk',
                        'description' => 'Siswa dapat menjual produk melalui marketplace.',
                    ],
                    [
                        'title' => 'QR Siswa',
                        'description' => 'Setiap siswa memiliki QR atau kode unik.',
                    ],
                    [
                        'title' => 'Pesanan',
                        'description' => 'Pantau status pesanan dari produk yang dibeli.',
                    ],
                ];
            @endphp


            @foreach ($features as $feature)

                <div
                    class="group rounded-2xl border border-gray-200 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none"
                >

                    <div
                        class="mb-6 flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-green-500 transition group-hover:bg-green-500 group-hover:text-gray-950"
                    >
                        ✓
                    </div>

                    <h3 class="text-lg font-bold">
                        {{ $feature['title'] }}
                    </h3>

                    <p
                        class="mt-3 text-sm leading-6 text-gray-500"
                    >
                        {{ $feature['description'] }}
                    </p>

                </div>

            @endforeach

        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- CTA --}}
{{-- ========================================================= --}}

<section
    class="border-t border-gray-200 bg-white dark:border-white/10 dark:bg-gray-950"
>

    <div
        class="mx-auto max-w-4xl px-6 py-28 text-center"
    >

        <div
            class="mx-auto mb-8 flex h-16 w-16 items-center justify-center rounded-2xl bg-green-500 font-black text-2xl text-gray-950"
        >
            T
        </div>


        <h2
            class="text-4xl font-black tracking-tight sm:text-5xl"
        >
            Mulai ubah sampah menjadi nilai.
        </h2>


        <p
            class="mx-auto mt-5 max-w-xl text-gray-600 dark:text-gray-400"
        >
            Daftar sekarang dan mulai kumpulkan poin
            dari botol yang kamu tukarkan.
        </p>


        <a
            href="/register"
            class="mt-9 inline-flex rounded-xl bg-green-500 px-7 py-4 font-bold text-gray-950 shadow-lg shadow-green-500/20 transition hover:bg-green-400"
        >
            Daftar Sekarang
        </a>

    </div>

</section>



{{-- ========================================================= --}}
{{-- FOOTER --}}
{{-- ========================================================= --}}

<footer
    class="border-t border-gray-200 bg-gray-50 dark:border-white/10 dark:bg-gray-950"
>

    <div
        class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-5 px-6 py-8 md:flex-row"
    >

        <div class="flex items-center gap-3">

            <div
                class="flex h-9 w-9 items-center justify-center rounded-lg bg-green-500 font-black text-gray-950"
            >
                T
            </div>

            <span class="font-bold">
                Ter<span class="text-green-500">cycle</span>
            </span>

        </div>


        <p class="text-sm text-gray-500">
            © {{ date('Y') }} Tercycle. All rights reserved.
        </p>

    </div>

</footer>


</body>
</html>