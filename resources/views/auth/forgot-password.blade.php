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
>
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Lupa Password - Tercycle</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>
</head>

<body
    class="flex min-h-screen items-center justify-center bg-gray-50 px-4 text-gray-900 transition-colors duration-300 dark:bg-gray-950 dark:text-white"
>

    <div class="w-full max-w-md">

        {{-- LOGO --}}
        <div class="mb-8 text-center">

            <a
                href="/"
                class="inline-flex items-center gap-3"
            >

                <div
                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500 font-black text-gray-950"
                >
                    T
                </div>

                <span class="text-2xl font-black">
                    Ter<span class="text-green-500">cycle</span>
                </span>

            </a>

        </div>


        {{-- CARD --}}
        <div
            class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-white/10 dark:bg-white/[0.03] sm:p-8"
        >

            {{-- HEADER --}}
            <div class="mb-6">

                <h1 class="text-xl font-black">
                    Lupa Password?
                </h1>

                <p class="mt-2 text-sm leading-6 text-gray-500">
                    Masukkan email yang terdaftar. Kami akan mengirimkan
                    link untuk mengatur ulang password.
                </p>

            </div>


            {{-- SUCCESS MESSAGE --}}
            @if (session('status'))
                <div
                    class="mb-5 rounded-xl border border-green-500/20 bg-green-500/10 px-4 py-3 text-sm text-green-600 dark:text-green-400"
                >
                    {{ session('status') }}
                </div>
            @endif


            {{-- ERROR --}}
            @if ($errors->any())
                <div
                    class="mb-5 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3 text-sm text-red-500"
                >
                    {{ $errors->first() }}
                </div>
            @endif


            {{-- FORM --}}
            <form
                method="POST"
                action="{{ route('password.request') }}"
            >

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
                        required
                        autofocus
                        placeholder="Masukkan email kamu"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-900"
                    >

                </div>


                {{-- BUTTON --}}
                <button
                    type="submit"
                    class="mt-5 w-full rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
                >
                    Kirim Link Reset Password
                </button>

            </form>


            {{-- BACK --}}
            <div class="mt-6 text-center">

                <a
                    href="/login"
                    class="text-sm font-semibold text-gray-500 transition hover:text-green-500"
                >
                    ← Kembali ke Login
                </a>

            </div>

        </div>

    </div>

</body>
</html>