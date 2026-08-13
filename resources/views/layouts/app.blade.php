<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Tercycle' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50 text-gray-800">

    {{-- Navbar --}}
    <nav class="border-b border-gray-200 bg-white">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-2">
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-green-600 text-white font-bold">
                    T
                </div>

                <span class="text-xl font-bold text-gray-900">
                    Ter<span class="text-green-600">cycle</span>
                </span>
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden items-center gap-6 md:flex">

                <a href="#"
                   class="text-sm font-medium text-gray-600 hover:text-green-600">
                    Beranda
                </a>

                <a href="#"
                   class="text-sm font-medium text-gray-600 hover:text-green-600">
                    Produk
                </a>

                <a href="#"
                   class="text-sm font-medium text-gray-600 hover:text-green-600">
                    Pesanan
                </a>

                <a href="#"
                   class="rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700">
                    Masuk
                </a>

            </div>

            {{-- Mobile Button --}}
            <button
                class="rounded-lg p-2 text-gray-600 hover:bg-gray-100 md:hidden"
                onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
            >
                ☰
            </button>

        </div>

        {{-- Mobile Navigation --}}
        <div id="mobile-menu" class="hidden border-t border-gray-100 px-4 pb-4 md:hidden">

            <div class="flex flex-col gap-2 pt-3">

                <a href="#"
                   class="rounded-lg px-3 py-2 text-sm font-medium hover:bg-gray-100">
                    Beranda
                </a>

                <a href="#"
                   class="rounded-lg px-3 py-2 text-sm font-medium hover:bg-gray-100">
                    Produk
                </a>

                <a href="#"
                   class="rounded-lg px-3 py-2 text-sm font-medium hover:bg-gray-100">
                    Pesanan
                </a>

                <a href="#"
                   class="mt-2 rounded-lg bg-green-600 px-3 py-2 text-center text-sm font-semibold text-white">
                    Masuk
                </a>

            </div>

        </div>
    </nav>


    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>


    {{-- Footer --}}
    <footer class="mt-16 border-t border-gray-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-8 text-center text-sm text-gray-500 sm:px-6 lg:px-8">
            © {{ date('Y') }} Tercycle. Semua hak dilindungi.
        </div>
    </footer>

</body>
</html>