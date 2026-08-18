@extends('layouts.admin.app')

@section('title', 'Kelola Siswa')

@section('topbar-subtitle', 'Siswa')

@section('topbar-title', 'Kelola Siswa')

@section('content')
    <div
        x-data="adminSiswa()"
        x-init="siswas = @js($siswas)"
    >

        {{-- HEADER --}}

        <div
            class="flex flex-col justify-between gap-5 sm:flex-row sm:items-center"
        >

            <div>

                <h2 class="text-2xl font-black">
                    Kelola Siswa
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Kelola akun, poin, dan informasi siswa.
                </p>

            </div>


            <button
                type="button"
                @click="studentModal = true"
                class="rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
            >
                + Tambah Siswa
            </button>

        </div>



        {{-- STATISTICS --}}

        <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Total Siswa
                </p>

                <p class="mt-2 text-3xl font-black">
                    {{ $totalSiswa }}
                </p>

                <p class="mt-2 text-xs text-green-500">
                    +{{ $siswaBulanIni }} bulan ini
                </p>

            </div>

            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Total Poin
                </p>

                <p class="mt-2 text-3xl font-black">
                    {{ $totalPoin }}
                </p>

                <p class="mt-2 text-xs text-gray-500">
                    Poin beredar
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Penukaran Hari Ini
                </p>

                <p class="mt-2 text-3xl font-black">
                    {{ number_format($penukaranHariIni, 0, ',', '.') }}
                </p>

                <p class="mt-2 text-xs text-green-500">
                    {{ $persentasePenukaran >= 0 ? '+' : '' }}{{ number_format($persentasePenukaran, 1, ',', '.') }}% dari kemarin
                </p>

            </div>

        </div>



        {{-- TABLE --}}

        <div
            class="mt-8 overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
        >


            {{-- FILTER --}}

            <div
                class="flex flex-col gap-4 border-b border-gray-200 p-6 dark:border-white/10 lg:flex-row lg:items-center lg:justify-between"
            >

                <div>

                    <h3 class="font-bold">
                        Daftar Siswa
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Semua siswa yang terdaftar di Tercycle.
                    </p>

                </div>


                <div class="flex flex-col gap-3 sm:flex-row">


                    {{-- SEARCH --}}

                    <div class="relative">

                        <form
                            method="GET"
                            action="{{ route('admin.siswa.index') }}"
                            class="relative"
                        >
                            <input
                                type="text"
                                x-model="search"
                                @input.debounce.300ms="searchStudents()"
                                placeholder="Cari nama / kode..."
                                class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 pl-10 text-sm outline-none transition focus:border-green-500 sm:w-64 dark:border-white/10 dark:bg-gray-900"
                            >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="absolute left-3 top-3 h-4 w-4 text-gray-400"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                                />
                            </svg>
                        </form>

                    </div>
                </div>
            </div>

            {{-- TABLE --}}
            
            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead
                        class="border-b border-gray-200 text-xs uppercase text-gray-500 dark:border-white/10"
                    >

                        <tr>

                            <th class="px-6 py-4">
                                Siswa
                            </th>

                            <th class="px-6 py-4">
                                Kode
                            </th>

                            <th class="px-6 py-4">
                                Saldo Poin
                            </th>

                            <th class="px-6 py-4 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200 dark:divide-white/10">
                        <template x-for="siswa in paginatedSiswas" :key="siswa.id">
                        <tr class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex h-11 w-11 items-center justify-center rounded-full bg-green-500 font-bold text-gray-950" x-text="siswa.nama_lengkap.charAt(0).toUpperCase()"
                                    >
                                    </div>

                                    <div>
                                        <p class="font-semibold" x-text="siswa.nama_lengkap"></p>
                                        <p class="mt-1 text-xs text-gray-500" x-text="siswa.kelas + ' ' + siswa.jurusan.kode_jurusan"></p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-5">
                                <span class="font-mono text-xs" x-text="siswa.kode_siswa"></span>
                            </td>

                            <td class="px-6 py-5">
                                <p class="font-bold text-green-500" x-text="Number(siswa.saldo_poin).toLocaleString('id-ID')"></p>
                                <p class="mt-1 text-xs text-gray-500">poin</p>
                            </td>   


                            <td class="px-6 py-5 ">

                                <div class="flex justify-center items-center gap-2">

                                    <button
                                    type="button"
                                    @click="openDetail(siswa)"
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                    >
                                        Detail
                                    </button>

                                    <button
                                        type="button"
                                        @click="openEdit(siswa)"
                                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                    >
                                        Edit
                                    </button>

                                </div>

                            </td>

                        </tr>

                        </template>

                        <template x-if="siswas.length === 0">

                        <tr>
                            <td
                                colspan="6"
                                class="px-6 py-10 text-center text-sm text-gray-500"
                            >
                                Siswa tidak ditemukan.
                            </td>
                        </tr>
                        </template>
                    </tbody>

                </table>

            </div>



            {{-- PAGINATION --}}

            <div
                class="flex flex-col gap-4 border-t border-gray-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between dark:border-white/10"
            >

                {{-- INFO --}}
                <p class="text-xs text-gray-500">

                    Menampilkan
                    <span x-text="startItem"></span>
                    -
                    <span x-text="endItem"></span>
                    dari
                    <span x-text="siswas.length"></span>
                    siswa

                </p>


                {{-- BUTTON PAGINATION --}}
                <div class="flex items-center gap-2">

                    {{-- SEBELUMNYA --}}
                    <button
                        type="button"
                        @click="prevPage()"
                        :disabled="currentPage === 1"
                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold transition
                            hover:bg-gray-100
                            disabled:cursor-not-allowed
                            disabled:opacity-40
                            dark:border-white/10
                            dark:hover:bg-white/5"
                    >
                        Sebelumnya
                    </button>


                    {{-- NOMOR HALAMAN --}}
                    <template x-for="page in totalPages" :key="page">

                        <button
                            type="button"
                            @click="goToPage(page)"
                            x-text="page"
                            :class="
                                currentPage === page
                                    ? 'bg-green-500 text-gray-950'
                                    : 'border border-gray-200 dark:border-white/10 hover:bg-gray-100 dark:hover:bg-white/5'
                            "
                            class="rounded-lg px-3 py-2 text-xs font-semibold transition"
                        ></button>

                    </template>


                    {{-- SELANJUTNYA --}}
                    <button
                        type="button"
                        @click="nextPage()"
                        :disabled="currentPage === totalPages || totalPages === 0"
                        class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold transition
                            hover:bg-gray-100
                            disabled:cursor-not-allowed
                            disabled:opacity-40
                            dark:border-white/10
                            dark:hover:bg-white/5"
                    >
                        Selanjutnya
                    </button>

                </div>

            </div>
        </div>
    

        {{-- ========================================================= --}}
        {{-- MODAL TAMBAH SISWA --}}
        {{-- ========================================================= --}}

        <div
            x-show="studentModal"
            x-transition.opacity
            x-effect="document.body.style.overflow = studentModal ? 'hidden' : ''"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
            style="display: none;"
        >
            {{-- BACKDROP --}}
            <div
                class="absolute inset-0 bg-black/50 backdrop-blur-md"
                @click="studentModal = false"
            ></div>


            {{-- MODAL --}}
            <div
                x-show="studentModal"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                @click.stop
                class="no-scrollbar relative max-h-[85vh] w-full max-w-md overflow-y-auto overscroll-contain rounded-2xl bg-white shadow-2xl dark:bg-gray-900"
            >

                {{-- HEADER --}}
                <div
                    class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10"
                >

                    <div>
                        <h2 class="text-lg font-bold">
                            Tambah Siswa
                        </h2>

                        <p class="mt-1 text-xs text-gray-500">
                            Masukkan informasi siswa baru.
                        </p>
                    </div>


                    {{-- CLOSE --}}
                    <button
                        type="button"
                        @click="studentModal = false"
                        class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/10 dark:hover:text-white"
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
                                d="M6 18 18 6M6 6l12 12"
                            />
                        </svg>
                    </button>

                </div>


                {{-- FORM --}}
                <form action="{{ route('admin.siswa.store') }}" method="POST" class="p-6">

                    @csrf


                    {{-- NAMA LENGKAP --}}
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
                            name="nama_lengkap"
                            placeholder="Contoh: Kevin Agna Pratama"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                            x-model="student.nama_lengkap"
                        >
                    </div>


                    {{-- NIS --}}
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
                            name="nis"
                            placeholder="Contoh: 202600125"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                            x-model="student.nis"
                        >
                    </div>

                    {{-- NO. TELEPON --}}
                    <div class="mt-5">
                        <label
                            for="no_telepon"
                            class="mb-2 block text-sm font-semibold"
                        >
                            No. Telepon
                        </label>

                        <input
                            type="text"
                            id="no_telepon"
                            name="no_telepon"
                            value="{{ old('no_telepon') }}"
                            placeholder="Contoh: 081234567890"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                            x-model="student.no_telepon"
                        >
                    </div>


                    {{-- KELAS + JURUSAN --}}
                    <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2">

                        {{-- KELAS --}}
                        <div>
                            <label
                                for="kelas"
                                class="mb-2 block text-sm font-semibold"
                            >
                                Kelas
                            </label>

                            <select
                                id="kelas"
                                name="kelas"
                                required
                                x-model="student.kelas"
                                class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                            >
                                <option value="">
                                    Pilih kelas
                                </option>

                                <option value="X">
                                    X
                                </option>

                                <option value="XI">
                                    XI
                                </option>

                                <option value="XII">
                                    XII
                                </option>
                            </select>
                        </div>


                        {{-- JURUSAN --}}
                        <div>
                            <div class="mb-2 flex items-center justify-between">
                                <label
                                    for="jurusan_id"
                                    class="block text-sm font-semibold"
                                >
                                    Jurusan
                                </label>

                                {{-- ATUR JURUSAN --}}
                                <div class="relative">
                                    <button
                                        type="button"
                                        @click="showJurusanOptions = !showJurusanOptions"
                                        class="rounded-lg border border-gray-200 px-2.5 py-1 text-[11px] font-semibold text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:border-white/10 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-white"
                                    >
                                        Atur
                                    </button>

                                    {{-- DROPDOWN --}}
                                    <div
                                        x-show="showJurusanOptions"
                                        x-transition
                                        @click.outside="showJurusanOptions = false"
                                        class="absolute right-0 top-full z-50 mt-2 w-44 rounded-xl border border-gray-200 bg-white p-2 shadow-xl dark:border-white/10 dark:bg-gray-900"
                                        style="display: none;"
                                    >
                                        <button
                                            type="button"
                                            @click="
                                                showJurusanOptions = false;
                                                showAddJurusanModal = true;
                                            "
                                            class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-sm font-medium transition hover:bg-gray-100 dark:hover:bg-white/5"
                                        >
                                            <span class="text-lg leading-none text-green-500">
                                                +
                                            </span>

                                            <span>
                                                Tambah Jurusan
                                            </span>
                                        </button>

                                        <button
                                            type="button"
                                            @click="
                                                showJurusanOptions = false;
                                                showDeleteJurusanModal = true;
                                            "
                                            class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-sm font-medium text-red-500 transition hover:bg-red-500/10"
                                        >
                                            <span class="text-base leading-none">
                                                🗑
                                            </span>

                                            <span>
                                                Hapus Jurusan
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <select
                                id="jurusan_id"
                                name="jurusan_id"
                                required
                                x-model="student.jurusan_id"
                                class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                            >
                                <option value="">
                                    Pilih jurusan
                                </option>

                                @foreach ($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}">
                                        {{ $jurusan->kode_jurusan }} -
                                        {{ $jurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>


                    {{-- BUTTON --}}
                    <div
                        class="mt-7 flex justify-end gap-3 border-t border-gray-200 pt-5 dark:border-white/10"
                    >

                        <button
                            type="button"
                            @click="studentModal = false"
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

        {{-- MODAL TAMBAH JURUSAN --}}
        <div
            x-show="showAddJurusanModal"
            x-transition.opacity
            class="fixed inset-0 z-[80] flex items-center justify-center bg-black/50 p-4"
            style="display: none;"
        >
            <div
                class="absolute inset-0 bg-black/50 backdrop-blur-md"
                @click="showAddJurusanModal = false"
            ></div>

            <div
                @click.stop
                class="relative w-full max-w-md rounded-2xl bg-white shadow-2xl dark:bg-gray-900"
            >
                <div class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10">
                    <div>
                        <h2 class="text-lg font-bold">
                            Tambah Jurusan
                        </h2>

                        <p class="mt-1 text-xs text-gray-500">
                            Tambahkan jurusan baru.
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="showAddJurusanModal = false"
                        class="text-gray-400 hover:text-gray-900 dark:hover:text-white"
                    >
                        ✕
                    </button>
                </div>

                <form
                    action="{{ route('admin.jurusan.store') }}"
                    method="POST"
                    class="p-6"
                >
                    @csrf

                    <div>
                        <label
                            for="kode_jurusan"
                            class="mb-2 block text-sm font-semibold"
                        >
                            Kode Jurusan
                        </label>

                        <input
                            type="text"
                            id="kode_jurusan"
                            name="kode_jurusan"
                            x-model="newJurusan.kode_jurusan"
                            placeholder="Contoh: RPL"
                            required
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm uppercase outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                        >
                    </div>

                    <div class="mt-5">
                        <label
                            for="nama_jurusan"
                            class="mb-2 block text-sm font-semibold"
                        >
                            Nama Jurusan
                        </label>

                        <input
                            type="text"
                            id="nama_jurusan"
                            name="nama_jurusan"
                            x-model="newJurusan.nama_jurusan"
                            placeholder="Contoh: Rekayasa Perangkat Lunak"
                            required
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                        >
                    </div>

                    <div class="mt-6 flex justify-end gap-3 border-t border-gray-200 pt-5 dark:border-white/10">
                        <button
                            type="button"
                            @click="showAddJurusanModal = false"
                            class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-semibold dark:border-white/10"
                        >
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950"
                        >
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- MODAL HAPUS JURUSAN --}}
        <div
            x-show="showDeleteJurusanModal"
            x-transition.opacity
            class="fixed inset-0 z-[80] flex items-center justify-center bg-black/50 p-4"
            style="display: none;"
        >
            <div
                class="absolute inset-0 bg-black/50 backdrop-blur-md"
                @click="showDeleteJurusanModal = false"
            ></div>

            <div
                @click.stop
                class="relative w-full max-w-md rounded-2xl bg-white shadow-2xl dark:bg-gray-900"
            >
                <div class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10">
                    <div>
                        <h2 class="text-lg font-bold">
                            Hapus Jurusan
                        </h2>

                        <p class="mt-1 text-xs text-gray-500">
                            Pilih satu atau lebih jurusan.
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="showDeleteJurusanModal = false"
                        class="text-gray-400 hover:text-gray-900 dark:hover:text-white"
                    >
                        ✕
                    </button>
                </div>

                <form
                    action="{{ route('admin.jurusan.destroy') }}"
                    method="POST"
                    class="p-6"
                >
                    @csrf
                    @method('DELETE')

                    <div class="max-h-72 space-y-3 overflow-y-auto">

                        @foreach ($jurusans as $jurusan)
                            <label
                                class="flex cursor-pointer items-center gap-3 rounded-xl border border-gray-200 px-4 py-3 transition hover:bg-gray-50 dark:border-white/10 dark:hover:bg-white/5"
                            >
                                <input
                                    type="checkbox"
                                    name="jurusan_ids[]"
                                    value="{{ $jurusan->id }}"
                                    x-model="selectedJurusan"
                                    class="h-4 w-4 rounded border-gray-300 text-green-500 focus:ring-green-500"
                                >

                                <div>
                                    <p class="text-sm font-semibold">
                                        {{ $jurusan->kode_jurusan }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $jurusan->nama_jurusan }}
                                    </p>
                                </div>
                            </label>
                        @endforeach

                    </div>

                    <div class="mt-6 flex justify-end border-t border-gray-200 pt-5 dark:border-white/10">
                        <button
                            type="submit"
                            :disabled="selectedJurusan.length === 0"
                            class="rounded-xl bg-red-500 px-5 py-3 text-sm font-bold text-white transition hover:bg-red-600 disabled:cursor-not-allowed disabled:opacity-50"
                        >
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- MODAL DETAIL SISWA --}}
        <div
            x-show="detailModal"
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
            style="display: none;"
        >
            {{-- BACKDROP --}}
            <div
                class="absolute inset-0 bg-black/50 backdrop-blur-sm"
                @click="closeDetail()"
            ></div>

            {{-- MODAL --}}
            <div
                x-show="detailModal"
                x-transition
                @click.stop
                class="relative w-full max-w-lg rounded-2xl bg-white shadow-2xl dark:bg-gray-900"
            >

                {{-- HEADER --}}
                <div class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10">
                    <div>
                        <h2 class="text-lg font-bold">
                            Detail Siswa
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Informasi lengkap siswa.
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="closeDetail()"
                        class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/10 dark:hover:text-white"
                    >
                        ✕
                    </button>
                </div>

                {{-- CONTENT --}}
                <div class="space-y-4 p-6">

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        {{-- NAMA --}}
                        <div >
                            <p class="text-xs text-gray-500">Nama Lengkap</p>
                            <p
                                class="mt-1 font-semibold"
                                x-text="selectedSiswa?.nama_lengkap ?? '-'"
                            ></p>
                        </div>

                        {{-- NIS --}}
                        <div>
                            <p class="text-xs text-gray-500">NIS</p>
                            <p
                                class="mt-1 font-semibold"
                                x-text="selectedSiswa?.nis ?? '-'"
                            ></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        {{-- KODE SISWA --}}
                        <div>
                            <p class="text-xs text-gray-500">Kode Siswa</p>
                            <p
                                class="mt-1 font-mono font-semibold"
                                x-text="selectedSiswa?.kode_siswa ?? '-'"
                            ></p>
                        </div>

                        {{-- KELAS --}}
                        <div>
                            <p class="text-xs text-gray-500">Kelas</p>
                            <p
                                class="mt-1 font-semibold"
                                x-text="selectedSiswa?.kelas ?? '-'"
                            ></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        {{-- JURUSAN --}}
                        <div>
                            <p class="text-xs text-gray-500">Jurusan</p>
                            <p
                                class="mt-1 font-semibold"
                                x-text="
                                    selectedSiswa?.jurusan
                                        ? selectedSiswa.jurusan.kode_jurusan + ' - ' + selectedSiswa.jurusan.nama_jurusan
                                        : '-'
                                "
                            ></p>
                        </div>

                        {{-- NO TELEPON --}}
                        <div>
                            <p class="text-xs text-gray-500">No. Telepon</p>
                            <p
                                class="mt-1 font-semibold"
                                x-text="selectedSiswa?.no_telepon ?? '-'"
                            ></p>
                        </div>
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="flex justify-end border-t border-gray-200 px-6 py-4 dark:border-white/10">
                    <button
                        type="button"
                        @click="closeDetail()"
                        class="rounded-xl bg-gray-100 px-5 py-2.5 text-sm font-semibold hover:bg-gray-200 dark:bg-white/10 dark:hover:bg-white/20"
                    >
                        Tutup
                    </button>
                </div>
            </div>
        </div>

        {{-- MODAL EDIT SISWA --}}
        <div
            x-show="editModal"
            x-transition.opacity
            x-effect="document.body.style.overflow = editModal ? 'hidden' : ''"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
            style="display: none;"
        >
            {{-- BACKDROP --}}
            <div
                class="absolute inset-0 bg-black/50 backdrop-blur-sm"
                @click="closeEdit()"
            ></div>

            {{-- MODAL --}}
            <div
                x-show="editModal"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                @click.stop
                class="relative w-full max-w-lg rounded-2xl bg-white shadow-2xl dark:bg-gray-900"
            >

                {{-- HEADER --}}
                <div
                    class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10"
                >
                    <div>
                        <h2 class="text-lg font-bold">
                            Edit Siswa
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Edit informasi siswa.
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="closeEdit()"
                        class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/10 dark:hover:text-white"
                    >
                        ✕
                    </button>
                </div>


                {{-- FORM --}}
                <form
                    method="POST"
                    :action="'{{ url('/admin/siswa') }}/' + editSiswa.id"
                    class="p-6"
                >

                    @csrf
                    @method('PUT')


                    {{-- NAMA --}}
                    <div>
                        <label class="mb-2 block text-sm font-semibold">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="nama_lengkap"
                            x-model="editSiswa.nama_lengkap"
                            required
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                        >
                    </div>


                    {{-- NIS --}}
                    <div class="mt-5">
                        <label class="mb-2 block text-sm font-semibold">
                            NIS
                        </label>

                        <input
                            type="text"
                            name="nis"
                            x-model="editSiswa.nis"
                            required
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                        >
                    </div>


                    {{-- NO TELEPON --}}
                    <div class="mt-5">
                        <label class="mb-2 block text-sm font-semibold">
                            No. Telepon
                        </label>

                        <input
                            type="text"
                            name="no_telepon"
                            x-model="editSiswa.no_telepon"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                        >
                    </div>


                    {{-- KELAS + JURUSAN --}}
                    <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2">

                        {{-- KELAS --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold">
                                Kelas
                            </label>

                            <select
                                name="kelas"
                                x-model="editSiswa.kelas"
                                required
                                class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                            >
                                <option value="">Pilih kelas</option>

                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                            </select>
                        </div>


                        {{-- JURUSAN --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold">
                                Jurusan
                            </label>

                            <select
                                name="jurusan_id"
                                x-model="editSiswa.jurusan_id"
                                required
                                class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                            >
                                <option value="">Pilih jurusan</option>

                                @foreach ($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}">
                                        {{ $jurusan->kode_jurusan }} -
                                        {{ $jurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>


                    {{-- FOOTER --}}
                    <div
                        class="mt-7 flex justify-end gap-3 border-t border-gray-200 pt-5 dark:border-white/10"
                    >

                        <button
                            type="button"
                            @click="closeEdit()"
                            class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-600 hover:bg-gray-100 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/5"
                        >
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 hover:bg-green-400"
                        >
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        {{-- MODAL EDIT SISWA --}}
        <div
            x-show="editModal"
            ...
        >
            ...
        </div>


        {{-- POPUP SUCCESS --}}
        @if (session('success'))
            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                x-init="setTimeout(() => show = false, 3000)"
                class="fixed right-6 top-6 z-[9999] w-full max-w-sm"
            >
                <div
                    class="flex items-start gap-4 rounded-2xl border border-green-200 bg-white p-4 shadow-2xl dark:border-green-500/20 dark:bg-gray-900"
                >
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-green-500/10"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="h-5 w-5 text-green-500"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m4.5 12.75 6 6 9-13.5"
                            />
                        </svg>
                    </div>

                    <div class="flex-1">
                        <p class="font-bold text-gray-900 dark:text-white">
                            Berhasil
                        </p>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ session('success') }}
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="show = false"
                        class="text-gray-400 transition hover:text-gray-700 dark:hover:text-white"
                    >
                        ✕
                    </button>
                </div>
            </div>
        @endif

    </div>

@endsection