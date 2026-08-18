@php
    $jumlahKeranjang = 0;

    if (auth()->check()) {
        $user = auth()->user();
        $siswa = $user->siswa;

        if ($siswa) {
            $keranjang = \App\Models\Keranjang::where(
                'siswa_id',
                $siswa->id
            )->first();

            if ($keranjang) {
                $jumlahKeranjang = \App\Models\DetailKeranjang::where(
                    'keranjang_id',
                    $keranjang->id
                )->sum('jumlah_produk');
            }
        }
    }
@endphp

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

    <title>@yield('title', 'Tercycle')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>
</head>

<body class="min-h-screen bg-gray-50 text-gray-900 transition-colors duration-300 dark:bg-gray-950 dark:text-white">

    {{-- SIDEBAR --}}
    @include('layouts.siswa.sidebar')

    {{-- MOBILE HEADER --}}
    @include('layouts.siswa.mobile-header')

{{-- MAIN --}}
<div class="lg:pl-64">

    {{-- TOPBAR --}}
    @include('layouts.siswa.topbar')

    {{-- CONTENT --}}
    <main class="mx-auto max-w-6xl px-6 py-8 lg:px-8">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('layouts.siswa.footer')

</div>

{{-- LOGOUT MODAL --}}
<x-logoutpopup />

@stack('scripts')

</body>
</html>