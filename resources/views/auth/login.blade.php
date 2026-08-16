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

    <title>Login - Tercycle</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>

</head>


<body
    class="min-h-screen bg-gray-50 text-gray-900 transition-colors duration-300 dark:bg-gray-950 dark:text-white"
>


{{-- NAVBAR SIMPLE --}}

<nav
    class="border-b border-gray-200 bg-white/90 backdrop-blur-xl dark:border-white/10 dark:bg-gray-950/90"
>

    <div
        class="mx-auto flex h-20 max-w-7xl items-center justify-between px-6 lg:px-8"
    >

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

            <span class="text-xl font-bold">
                Ter<span class="text-green-500">cycle</span>
            </span>

        </a>


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

    </div>

</nav>


{{-- LOGIN --}}

<main
    class="flex min-h-[calc(100vh-5rem)] items-center justify-center px-6 py-12"
>

    <div class="w-full max-w-md">


        {{-- HEADER --}}

        <div class="mb-8 text-center">

            <div
                class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-green-500 text-xl font-black text-gray-950"
            >
                E
            </div>

            <h1 class="text-3xl font-black">
                Selamat Datang
            </h1>

            <p class="mt-2 text-gray-500">
                Masuk ke akun Tercycle kamu
            </p>

        </div>


        {{-- CARD --}}

        <div
            class="rounded-2xl border border-gray-200 bg-white p-7 shadow-sm dark:border-white/10 dark:bg-white/[0.03] dark:shadow-none sm:p-8"
        >

            <form action="{{ route('login') }}" method="POST">

                @csrf


                {{-- EMAIL --}}

                <div>

                    <label
                        for="email"
                        class="mb-2 block text-sm font-semibold"
                    >
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-600 @error('email') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror"
                    >

                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror

                </div>


                {{-- PASSWORD --}}

                <div class="mt-5">

                    <div x-data="{ showPassword: false }" class="relative">

                        <label
                            for="password"
                            class="mb-2 block text-sm font-semibold"
                        >
                            Password
                        </label>

                        <input
                            :type="showPassword ? 'text' : 'password'"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 pr-12 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-900 dark:text-white dark:placeholder:text-gray-600 @error('password') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror"
                        >

                        <button
                            type="button"
                            @click="showPassword = !showPassword"
                            class="absolute right-3 top-[67%] -translate-y-1/2 text-gray-400 transition hover:text-gray-700 dark:hover:text-white"
                            :title="showPassword ? 'Sembunyikan password' : 'Lihat password'"
                        >

                            {{-- ICON MATA TERBUKA --}}
                            <svg
                                x-show="!showPassword"
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
                                    d="M2.25 12s3.5-6 9.75-6 9.75 6 9.75 6-3.5 6-9.75 6S2.25 12 2.25 12Z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                />
                            </svg>

                            {{-- ICON MATA DICORET --}}
                            <svg
                                x-show="showPassword"
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
                                    d="M3 3l18 18"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M10.58 10.58a2 2 0 0 0 2.83 2.83"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9.88 5.09A9.86 9.86 0 0 1 12 4.85c6.25 0 9.75 6 9.75 6a17.38 17.38 0 0 1-3.04 3.82M6.23 6.23C3.75 8.02 2.25 10.85 2.25 10.85s3.5 6 9.75 6c1.17 0 2.25-.21 3.24-.58"
                                />
                            </svg>

                        </button>

                    </div>

                    @error('password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror

                </div>


                {{-- REMEMBER --}}

                <div class="mt-5 flex items-center gap-2">

                    <input
                        type="checkbox"
                        id="remember"
                        name="remember"
                        class="h-4 w-4 rounded border-gray-300 text-green-500 focus:ring-green-500"
                    >

                    <label
                        for="remember"
                        class="text-sm text-gray-500"
                    >
                        Ingat saya
                    </label>

                </div>


                {{-- BUTTON --}}

                <button
                    type="submit"
                    class="mt-7 w-full rounded-xl bg-green-500 px-5 py-3.5 text-sm font-bold text-gray-950 transition hover:bg-green-400"
                >
                    Masuk
                </button>

            </form>
            
        </div>


        <p class="mt-6 text-center text-xs text-gray-400">
            © {{ date('Y') }} Tercycle
        </p>

    </div>

</main>


</body>
</html>