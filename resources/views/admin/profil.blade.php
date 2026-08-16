@extends('layouts.admin.app')

@section('title', 'Profil Admin')

@section('topbar-subtitle', 'Profil Admin')

@section('topbar-title', 'Profil')

@section('content')


        {{-- HEADER --}}

        <div class="mb-6">

            <h2 class="text-2xl font-black">
                Profil Admin
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Kelola informasi akun administrator Tercycle.
            </p>

        </div>


        {{-- PROFILE HEADER --}}

        <div
            class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
        >

            <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

                {{-- AVATAR --}}

                <div
                    class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl bg-gray-900 text-2xl font-black text-white dark:bg-white dark:text-gray-950"
                >
                    A
                </div>


                <div class="flex-1">

                    <div class="flex flex-wrap items-center gap-3">

                        <h3 class="text-xl font-black">
                            Administrator
                        </h3>

                        <span
                            class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                        >
                            Aktif
                        </span>

                    </div>

                    <p class="mt-1 text-sm text-gray-500">
                        Administrator Tercycle
                    </p>

                </div>

            </div>

        </div>


        {{-- DATA PROFIL --}}

        <div
            class="mt-6 rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
        >

            <div
                class="border-b border-gray-200 px-6 py-5 dark:border-white/10"
            >

                <h3 class="font-bold">
                    Informasi Akun
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Informasi dasar akun administrator.
                </p>

            </div>

            <form action="{{ route('admin.profil.password') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-5 p-6 sm:grid-cols-2">

                    {{-- USERNAME --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Username</label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $admin->name) }}"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                        >
                    </div>


                    {{-- EMAIL --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Email</label>

                        <input
                            type="email"
                            name="email"
                            disabled
                            value="{{ old('email', $admin->email) }}"
                            class="w-full cursor-not-allowed rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                        >
                    </div>


                    {{-- ROLE --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Role</label>
                        <input
                            type="text"
                            value="{{ ucfirst($admin->role) }}"
                            disabled
                            class="w-full cursor-not-allowed rounded-xl border border-gray-200 bg-gray-100 px-4 py-3 text-sm text-gray-500 outline-none dark:border-white/10 dark:bg-white/5"
                        >
                    </div>
                </div>

                {{-- BUTTON --}}
                <div class="flex justify-end border-t border-gray-200 px-6 py-5 dark:border-white/10">
                    <button type="button" class="rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400">
                        Simpan Perubahan
                    </button>
                </div>  
            </form>
        </div>


        {{-- SECURITY --}}

        <div
            class="mt-6 rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
        >

            <div
                class="border-b border-gray-200 px-6 py-5 dark:border-white/10"
            >

                <h3 class="font-bold">
                    Keamanan
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Ubah password akun administrator.
                </p>

            </div>

            <form action="{{ route('admin.profil.password') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-5 p-6 sm:grid-cols-2">

                    {{-- PASSWORD LAMA --}}
                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-semibold">Password Saat Ini</label>
                        <input
                            type="password"
                            placeholder="Masukkan password saat ini"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                        >
                    </div>

                    {{-- PASSWORD BARU --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Password Baru</label>
                        <input
                            type="password"
                            placeholder="Password baru"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                        >
                    </div>

                    {{-- KONFIRMASI --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Konfirmasi Password</label>
                        <input
                            type="password"
                            placeholder="Ulangi password baru"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                        >
                    </div>
                </div>

                <div class="flex justify-end border-t border-gray-200 px-6 py-5 dark:border-white/10">
                    <button type="button" class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-100 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/5">
                        Ubah Password
                    </button>
                </div>
            </form>

        </div>

    @endsection