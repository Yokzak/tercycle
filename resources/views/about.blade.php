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

    <title>Tentang Kami - Tercycle</title>

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
                href="/about"
                class="text-sm font-medium text-gray-600 transition hover:text-green-500 dark:text-gray-300"
            >
                Tentang
            </a>

            <a
                href="/#cara-kerja"
                class="text-sm font-medium text-gray-600 transition hover:text-green-500 dark:text-gray-300"
            >
                Cara Kerja
            </a>

            <a
                href="/#fitur"
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
                href="/"
                class="block rounded-lg px-3 py-2.5 text-sm text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-white/5"
            >
                Beranda
            </a>

            <a
                href="/about"
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

<section class="relative overflow-hidden">

    {{-- BACKGROUND DECORATION --}}

    <div
        class="absolute left-1/2 top-0 -z-10 h-96 w-96 -translate-x-1/2 rounded-full bg-green-500/10 blur-3xl"
    ></div>


    <div
        class="mx-auto max-w-5xl px-6 pb-20 pt-20 text-center lg:px-8 lg:pt-28"
    >

        <span
            class="inline-flex rounded-full bg-green-500/10 px-4 py-2 text-xs font-bold uppercase tracking-wider text-green-500"
        >
            Tentang Tercycle
        </span>


        <h1
            class="mx-auto mt-6 max-w-4xl text-4xl font-black tracking-tight sm:text-5xl lg:text-6xl"
        >
            Mengubah sampah menjadi
            <span class="text-green-500">
                sesuatu yang bernilai.
            </span>
        </h1>


        <p
            class="mx-auto mt-6 max-w-2xl text-base leading-7 text-gray-500 sm:text-lg"
        >
            Tercycle adalah platform yang membantu siswa mengelola
            sampah botol plastik menjadi poin yang dapat digunakan
            untuk mendapatkan berbagai produk menarik.
        </p>

    </div>

</section>



{{-- ========================================================= --}}
{{-- TENTANG TER CYCLE --}}
{{-- ========================================================= --}}

<section class="border-y border-gray-200 dark:border-white/10">

    <div
        class="mx-auto grid max-w-7xl gap-12 px-6 py-20 lg:grid-cols-2 lg:px-8"
    >

        {{-- TEXT --}}

        <div>

            <p
                class="text-sm font-bold uppercase tracking-wider text-green-500"
            >
                Apa itu Tercycle?
            </p>


            <h2
                class="mt-3 text-3xl font-black tracking-tight"
            >
                Dari botol bekas menjadi kesempatan baru.
            </h2>


            <p class="mt-5 leading-7 text-gray-500">
                Tercycle dibuat sebagai sebuah sistem yang menghubungkan
                kegiatan daur ulang dengan sistem poin. Siswa dapat
                mengumpulkan botol plastik, menukarkannya menjadi poin,
                kemudian menggunakan poin tersebut untuk mendapatkan
                produk.
            </p>


            <p class="mt-4 leading-7 text-gray-500">
                Dengan pendekatan tersebut, kegiatan menjaga lingkungan
                tidak hanya menjadi kewajiban, tetapi juga menjadi
                aktivitas yang memberikan manfaat langsung bagi siswa.
            </p>

        </div>


        {{-- STATISTIC --}}

        <div class="grid grid-cols-2 gap-4">

            <div
                class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-xl"
                >
                    ♻
                </div>

                <p class="mt-5 text-3xl font-black text-green-500">
                    100%
                </p>

                <p class="mt-1 text-sm text-gray-500">
                    Fokus pada daur ulang
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-xl"
                >
                    🎓
                </div>

                <p class="mt-5 text-3xl font-black text-green-500">
                    Siswa
                </p>

                <p class="mt-1 text-sm text-gray-500">
                    Sebagai pengguna utama
                </p>

            </div>


            <div
                class="col-span-2 rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-sm font-bold">
                    Misi Kami
                </p>

                <p class="mt-2 leading-6 text-gray-500">
                    Mendorong kebiasaan peduli lingkungan melalui sistem
                    yang sederhana, menarik, dan memberikan manfaat
                    nyata bagi siswa.
                </p>

            </div>

        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- CARA KERJA --}}
{{-- ========================================================= --}}

<section>

    <div
        class="mx-auto max-w-7xl px-6 py-20 lg:px-8"
    >

        <div class="text-center">

            <p
                class="text-sm font-bold uppercase tracking-wider text-green-500"
            >
                Cara Kerja
            </p>

            <h2 class="mt-3 text-3xl font-black">
                Sederhana. Tukarkan. Dapatkan.
            </h2>

        </div>


        <div
            class="mt-12 grid gap-5 md:grid-cols-3"
        >

            {{-- STEP 1 --}}

            <div
                class="relative rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <span
                    class="text-sm font-black text-green-500"
                >
                    01
                </span>

                <h3 class="mt-5 font-bold">
                    Kumpulkan Botol
                </h3>

                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Siswa mengumpulkan botol plastik yang sudah tidak
                    digunakan.
                </p>

            </div>


            {{-- STEP 2 --}}

            <div
                class="relative rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <span
                    class="text-sm font-black text-green-500"
                >
                    02
                </span>

                <h3 class="mt-5 font-bold">
                    Dapatkan Poin
                </h3>

                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Botol yang dikumpulkan ditukarkan dan dikonversi
                    menjadi poin.
                </p>

            </div>


            {{-- STEP 3 --}}

            <div
                class="relative rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <span
                    class="text-sm font-black text-green-500"
                >
                    03
                </span>

                <h3 class="mt-5 font-bold">
                    Tukarkan Poin
                </h3>

                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Gunakan poin untuk mendapatkan produk yang tersedia
                    di Tercycle.
                </p>

            </div>

        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- PENDIRI --}}
{{-- ========================================================= --}}

<section
    class="border-t border-gray-200 dark:border-white/10"
>

    <div
        class="mx-auto max-w-7xl px-6 py-20 lg:px-8"
    >

        <div class="text-center">

            <p
                class="text-sm font-bold uppercase tracking-wider text-green-500"
            >
                The Founders
            </p>

            <h2
                class="mt-3 text-3xl font-black"
            >
                Dibangun oleh tiga orang.
            </h2>

            <p
                class="mx-auto mt-3 max-w-2xl text-sm leading-6 text-gray-500"
            >
                Tercycle dikembangkan oleh tiga pendiri dengan satu
                tujuan: membuat kegiatan daur ulang lebih menarik
                dan bermanfaat bagi siswa.
            </p>

        </div>


        {{-- FOUNDERS --}}

        <div
            class="mx-auto mt-12 grid max-w-5xl gap-5 md:grid-cols-3"
        >

            {{-- FOUNDER 1 --}}

            <div
                class="group rounded-2xl border border-gray-200 bg-white p-6 text-center transition duration-300 hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-green-500 text-3xl font-black text-gray-950"
                >
                    A
                </div>


                <h3 class="mt-5 text-lg font-bold">
                    Ahmad Faisal Alby
                </h3>


                <p class="mt-1 text-sm text-green-500">
                    Back-End Developer
                </p>


                <p class="mt-4 text-sm leading-6 text-gray-500">
                    Mengembangkan sistem di balik Tercycle, mulai dari logika aplikasi, autentikasi, hingga pengelolaan proses dan fitur utama.
                </p>


                {{-- INSTAGRAM --}}

                <a
                    href="https://instagram.com/faislbyy"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="mt-5 inline-flex items-center gap-2 rounded-xl border border-gray-200 px-4 py-2 text-xs font-semibold text-gray-600 transition hover:border-green-500/30 hover:bg-green-500/10 hover:text-green-500 dark:border-white/10 dark:text-gray-300"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-4 w-4"
                    >
                        <rect
                            width="20"
                            height="20"
                            x="2"
                            y="2"
                            rx="5"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16 11.37a4 4 0 1 1-7.75 1.3A4 4 0 0 1 16 11.37Zm1.5-4.87h.01"
                        />
                    </svg>

                    @faislbyy

                </a>

            </div>



            {{-- FOUNDER 2 --}}

            <div
                class="group rounded-2xl border border-gray-200 bg-white p-6 text-center transition duration-300 hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-gray-900 text-3xl font-black text-white dark:bg-white dark:text-gray-950"
                >
                    H
                </div>


                <h3 class="mt-5 text-lg font-bold">
                    Hilman Zaky Maulana
                </h3>


                <p class="mt-1 text-sm text-green-500">
                    Database & Back-End Developer
                </p>


                <p class="mt-4 text-sm leading-6 text-gray-500">
                    Mengelola struktur dan penyimpanan data Tercycle sekaligus mengembangkan sistem backend agar data dapat diproses dengan aman dan terorganisir.
                </p>


                <a
                    href="https://instagram.com/hilman_zm1"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="mt-5 inline-flex items-center gap-2 rounded-xl border border-gray-200 px-4 py-2 text-xs font-semibold text-gray-600 transition hover:border-green-500/30 hover:bg-green-500/10 hover:text-green-500 dark:border-white/10 dark:text-gray-300"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-4 w-4"
                    >
                        <rect
                            width="20"
                            height="20"
                            x="2"
                            y="2"
                            rx="5"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16 11.37a4 4 0 1 1-7.75 1.3A4 4 0 0 1 16 11.37Zm1.5-4.87h.01"
                        />
                    </svg>

                    @hilman_zm1

                </a>

            </div>



            {{-- FOUNDER 3 --}}

            <div
                class="group rounded-2xl border border-gray-200 bg-white p-6 text-center transition duration-300 hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div
                    class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-green-500 text-3xl font-black text-gray-950"
                >
                    K
                </div>


                <h3 class="mt-5 text-lg font-bold">
                    Kevin Agna Pratama
                </h3>


                <p class="mt-1 text-sm text-green-500">
                    Front-End Developer
                </p>


                <p class="mt-4 text-sm leading-6 text-gray-500">
                    Bertanggung jawab merancang tampilan dan pengalaman pengguna Tercycle agar nyaman, responsif, dan mudah digunakan.
                </p>


                <a
                    href="https://instagram.com/pinpinpinkepin_"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="mt-5 inline-flex items-center gap-2 rounded-xl border border-gray-200 px-4 py-2 text-xs font-semibold text-gray-600 transition hover:border-green-500/30 hover:bg-green-500/10 hover:text-green-500 dark:border-white/10 dark:text-gray-300"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-4 w-4"
                    >
                        <rect
                            width="20"
                            height="20"
                            x="2"
                            y="2"
                            rx="5"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16 11.37a4 4 0 1 1-7.75 1.3A4 4 0 0 1 16 11.37Zm1.5-4.87h.01"
                        />
                    </svg>

                    @pinpinpinkepin_

                </a>

            </div>

        </div>

    </div>

</section>



{{-- ========================================================= --}}
{{-- FOOTER --}}
{{-- ========================================================= --}}

<footer
    class="border-t border-gray-200 dark:border-white/10"
>

    <div
        class="mx-auto flex max-w-7xl flex-col gap-3 px-6 py-8 text-center sm:flex-row sm:items-center sm:justify-between sm:text-left lg:px-8"
    >

        <div>

            <p class="font-bold">
                Ter<span class="text-green-500">cycle</span>
            </p>

            <p class="mt-1 text-xs text-gray-500">
                Daur ulang hari ini, manfaatkan untuk esok.
            </p>

        </div>


        <p class="text-xs text-gray-500">
            © {{ date('Y') }} Tercycle. All rights reserved.
        </p>

    </div>

</footer>


</body>
</html>