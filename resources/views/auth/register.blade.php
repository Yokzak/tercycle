<!DOCTYPE html>
<html
    lang="id"
    x-data="registerPage()"
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

    <title>Daftar - Tercycle</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>
</head>


<body
    class="min-h-screen bg-gray-50 text-gray-900 transition-colors duration-300 dark:bg-gray-950 dark:text-white"
>

<nav
    class="border-b border-gray-200 bg-white/90 backdrop-blur-xl
           dark:border-white/10 dark:bg-gray-950/90"
>
    <div
        class="mx-auto flex h-20 max-w-7xl items-center justify-between px-6 lg:px-8"
    >
        <a
            href="/"
            class="flex items-center gap-3"
        >
            <div
                class="flex h-10 w-10 items-center justify-center
                       rounded-xl bg-green-500 font-black text-gray-950"
            >
                T
            </div>

            <span class="text-xl font-bold">
                Ter<span class="text-green-500">cycle</span>
            </span>
        </a>

        <button
            type="button"
            @click="toggleTheme()"
            class="flex h-10 w-10 items-center justify-center
                   rounded-xl border border-gray-200 bg-gray-50
                   text-gray-700 transition hover:bg-gray-100
                   dark:border-white/10 dark:bg-white/5
                   dark:text-gray-300 dark:hover:bg-white/10"
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
                    d="M12 3v2m0 14v2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M3 12h2m14 0h2M4.93 19.07l1.42-1.42m11.3-11.3 1.42-1.42M16 12a4 4 0 1 1-8 0Z"
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
                    d="M21 12.79A9 9 0 1 1 11.21 3
                       7 7 0 0 0 21 12.79Z"
                />
            </svg>

        </button>

    </div>
</nav>

<main
    class="flex min-h-[calc(100vh-5rem)]
           items-center justify-center
           px-6 py-12"
>

    <div class="w-full max-w-lg">

        <div class="mb-8 text-center">

            <div
                class="mx-auto mb-5 flex h-14 w-14
                       items-center justify-center
                       rounded-2xl bg-green-500
                       text-xl font-black text-gray-950"
            >
                T
            </div>

            <h1 class="text-3xl font-black">
                Buat Akun
            </h1>

            <p class="mx-auto mt-2 max-w-md text-sm text-gray-500">
                Ayo buat akun Tercycle kamu sekarang!
            </p>

        </div>

        <div
            class="rounded-2xl border border-gray-200
                   bg-white p-7 shadow-sm
                   dark:border-white/10
                   dark:bg-white/[0.03]
                   dark:shadow-none sm:p-8"
        >

            <div x-show="studentStep" x-transition>

                <div class="mb-6">

                    <h2 class="text-xl font-bold">
                        Identitas Siswa
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Masukkan identitas kamu.
                    </p>

                </div>

                <div
                    x-show="error"
                    x-transition
                    class="mb-5 rounded-xl border border-red-200
                           bg-red-50 px-4 py-3
                           text-sm text-red-600
                           dark:border-red-500/20
                           dark:bg-red-500/10
                           dark:text-red-400"
                >
                    <span x-text="error"></span>
                </div>

                <div>

                    <label
                        for="nama_lengkap"
                        class="mb-2 block text-sm font-semibold"
                    >
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        id="nama_lengkap"
                        x-model="student.nama_lengkap"
                        placeholder="Contoh: Kevin Agna Pratama"
                        class="w-full rounded-xl border
                               border-gray-200 bg-gray-50
                               px-4 py-3 text-sm
                               outline-none transition
                               placeholder:text-gray-400
                               focus:border-green-500
                               focus:ring-2
                               focus:ring-green-500/20
                               dark:border-white/10
                               dark:bg-gray-950"
                    >

                </div>

                <div class="mt-5">

                    <label
                        for="nis"
                        class="mb-2 block text-sm font-semibold"
                    >
                        NIS
                    </label>

                    <input
                        type="text"
                        id="nis"
                        x-model="student.nis"
                        placeholder="Contoh: 202600125"
                        class="w-full rounded-xl border
                               border-gray-200 bg-gray-50
                               px-4 py-3 text-sm
                               outline-none transition
                               placeholder:text-gray-400
                               focus:border-green-500
                               focus:ring-2
                               focus:ring-green-500/20
                               dark:border-white/10
                               dark:bg-gray-950"
                    >

                </div>

                <div class="mt-5">

                    <label
                        for="no_telepon"
                        class="mb-2 block text-sm font-semibold"
                    >
                        No Telepon
                    </label>

                    <input
                        type="text"
                        id="no_telepon"
                        x-model="student.no_telepon"
                        placeholder="Contoh: 202600125"
                        class="w-full rounded-xl border
                               border-gray-200 bg-gray-50
                               px-4 py-3 text-sm
                               outline-none transition
                               placeholder:text-gray-400
                               focus:border-green-500
                               focus:ring-2
                               focus:ring-green-500/20
                               dark:border-white/10
                               dark:bg-gray-950"
                    >

                </div>

                <div class="mt-5 grid gap-4 sm:grid-cols-2">

                    <div>

                        <label
                            for="kelas"
                            class="mb-2 block text-sm font-semibold"
                        >
                            Kelas
                        </label>

                        <select
                            id="kelas"
                            x-model="student.kelas"
                            class="w-full rounded-xl border
                                   border-gray-200 bg-gray-50
                                   px-4 py-3 text-sm
                                   outline-none
                                   focus:border-green-500
                                   focus:ring-2
                                   focus:ring-green-500/20
                                   dark:border-white/10
                                   dark:bg-gray-950"
                        >

                            <option value="">
                                Pilih kelas
                            </option>

                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>

                        </select>

                    </div>

                    <div>

                        <label
                            for="jurusan"
                            class="mb-2 block text-sm font-semibold"
                        >
                            Jurusan
                        </label>

                        <select
                            id="jurusan_id"
                            x-model="student.jurusan"
                            required
                            class="w-full rounded-xl border
                                   border-gray-200 bg-gray-50
                                   px-4 py-3 text-sm
                                   outline-none
                                   focus:border-green-500
                                   focus:ring-2
                                   focus:ring-green-500/20
                                   dark:border-white/10
                                   dark:bg-gray-950"
                        >

                            <option value="">
                                Pilih jurusan
                            </option>

                            @foreach ($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}">
                                    {{ $jurusan->kode_jurusan }} - {{ $jurusan->nama_jurusan }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                </div>

                <button
                    type="button"
                    @click="checkStudent()"
                    :disabled="loading"
                    class="mt-7 w-full rounded-xl
                           bg-green-500 px-5 py-3.5
                           text-sm font-bold text-gray-950
                           transition hover:bg-green-400
                           disabled:cursor-not-allowed
                           disabled:opacity-60"
                >

                    <span x-show="!loading">
                        Lanjut
                    </span>

                    <span x-show="loading">
                        Memeriksa data...
                    </span>

                </button>

            </div>

            <div x-show="!studentStep" x-transition>

                <div class="mb-6">

                    <h2 class="text-xl font-bold">
                        Buat Akun
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Data siswa berhasil ditemukan.
                        Silakan buat akun Tercycle kamu.
                    </p>

                </div>

                @if ($errors->any() && old('register_account'))

                    <div class="mb-5 rounded-xl border border-red-500/20 bg-red-500/10 p-4">

                        <div class="flex gap-3">

                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-500/10 text-red-500">
                                !
                            </div>

                            <div>
                                <p class="text-sm font-semibold text-red-500">
                                    Gagal membuat akun
                                </p>

                                <ul class="mt-1 space-y-1 text-xs text-red-500">
                                    @foreach ($errors->all() as $error)
                                        <li>• {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>

                    </div>

                @endif

                <form
                    action="{{ route('register.store') }}"
                    method="POST"
                >

                    @csrf

                    <input type="hidden" name="register_account" value="1">

                    <input
                        type="hidden"
                        name="siswa_id"
                        :value="siswaId"
                    >

                    <div>

                        <label
                            for="name"
                            class="mb-2 block text-sm font-semibold"
                        >
                            Username
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Contoh: kevinagna"
                            required
                            class="w-full rounded-xl border
                                   border-gray-200 bg-gray-50
                                   px-4 py-3 text-sm
                                   outline-none transition
                                   placeholder:text-gray-400
                                   focus:border-green-500
                                   focus:ring-2
                                   focus:ring-green-500/20
                                   dark:border-white/10
                                   dark:bg-gray-950"
                        >

                        @error('name')
                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div class="mt-5">

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
                            required
                            class="w-full rounded-xl border
                                   border-gray-200 bg-gray-50
                                   px-4 py-3 text-sm
                                   outline-none transition
                                   placeholder:text-gray-400
                                   focus:border-green-500
                                   focus:ring-2
                                   focus:ring-green-500/20
                                   dark:border-white/10
                                   dark:bg-gray-950"
                        >

                        @error('email')
                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div class="mt-5">

                        <label
                            for="password"
                            class="mb-2 block text-sm font-semibold"
                        >
                            Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Minimal 8 karakter"
                            required
                            class="w-full rounded-xl border
                                   border-gray-200 bg-gray-50
                                   px-4 py-3 text-sm
                                   outline-none transition
                                   placeholder:text-gray-400
                                   focus:border-green-500
                                   focus:ring-2
                                   focus:ring-green-500/20
                                   dark:border-white/10
                                   dark:bg-gray-950"
                        >

                        @error('password')
                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div class="mt-5">

                        <label
                            for="password_confirmation"
                            class="mb-2 block text-sm font-semibold"
                        >
                            Konfirmasi Password
                        </label>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Ulangi password"
                            required
                            class="w-full rounded-xl border
                                   border-gray-200 bg-gray-50
                                   px-4 py-3 text-sm
                                   outline-none transition
                                   placeholder:text-gray-400
                                   focus:border-green-500
                                   focus:ring-2
                                   focus:ring-green-500/20
                                   dark:border-white/10
                                   dark:bg-gray-950"
                        >

                    </div>


                    {{-- BUTTON --}}
                    <div class="mt-7 flex gap-3">

                        <button
                            type="button"
                            @click="studentStep = true"
                            class="w-full rounded-xl
                                   border border-gray-200
                                   px-5 py-3
                                   text-sm font-semibold
                                   text-gray-600
                                   transition hover:bg-gray-100
                                   dark:border-white/10
                                   dark:text-gray-300
                                   dark:hover:bg-white/5"
                        >
                            Kembali
                        </button>

                        <button
                            type="submit"
                            class="w-full rounded-xl
                                   bg-green-500 px-5 py-3
                                   text-sm font-bold
                                   text-gray-950
                                   transition hover:bg-green-400"
                        >
                            Daftar
                        </button>

                    </div>

                </form>

            </div>

        </div>

        <p class="mt-6 text-center text-xs text-gray-400">
            © {{ date('Y') }} Tercycle
        </p>

    </div>

</main>
<script>

function registerPage() {

    return {

        dark: localStorage.getItem('theme') !== 'light',
        loading: false,
        error: '',
        studentStep: {{ old('register_account') ? 'false' : 'true' }},
        siswaId: {{ old('siswa_id', 'null') }},

        student: {
            nama_lengkap: '',
            nis: '',
            no_telepon: '',
            kelas: '',
            jurusan: ''
        },


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

        },


        async checkStudent() {

            this.loading = true;
            this.error = '';


            try {

                const response = await fetch(
                    '{{ route('register.check-student') }}',
                    {
                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },

                        body: JSON.stringify({
                            nis: this.student.nis,
                            nama_lengkap: this.student.nama_lengkap,
                            no_telepon: this.student.no_telepon,
                            kelas: this.student.kelas,
                            jurusan_id: this.student.jurusan
                        })
                    }
                );


                const data = await response.json();


                if (response.ok) {
                    this.siswaId = data.siswa.id;
                    this.studentStep = false;

                } else {
                    this.error =
                        data.message ??
                        'Datamu tidak ditemukan.';
                }

            } catch (error) {
                console.error(error);
                this.error =
                    'Terjadi kesalahan. Silakan coba lagi.';

            } finally {
                this.loading = false;
            }
        }
    }
}

</script>

</body>
</html>