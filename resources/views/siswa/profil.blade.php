@extends('layouts.siswa.app')

@section('title', 'Profil - Tercycle')

@section('topbar-subtitle', 'Profil')

@section('topbar-title', 'Profil Saya')

@section('content')

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



@endsection

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