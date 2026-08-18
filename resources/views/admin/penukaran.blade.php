@extends('layouts.admin.app')

@section('title', 'Penukaran Botol')

@section('topbar-subtitle', 'Penukaran Botol')

@section('topbar-title', 'Penukaran Botol')

@section('content')

<main
    x-data="{
        confirmModal: false,
        confirmAction: '',
        confirmName: '',
        confirmForm: null,

        successModal: false,
        errorModal: false,

        successMessage: '',
        errorMessage: '',

        openConfirm(action, name, form) {
            this.confirmAction = action;
            this.confirmName = name;
            this.confirmForm = form;
            this.confirmModal = true;
        },

        closeConfirm() {
            this.confirmModal = false;
            this.confirmAction = '';
            this.confirmName = '';
            this.confirmForm = null;
        },

        submitConfirm() {
            if (this.confirmForm) {
                this.confirmForm.submit();
            }
        },

        showSuccess(message) {
            this.successMessage = message;
            this.successModal = true;

            setTimeout(() => {
                this.successModal = false;
            }, 3000);
        },

        showError(message) {
            this.errorMessage = message;
            this.errorModal = true;

            setTimeout(() => {
                this.errorModal = false;
            }, 4000);
        }
    }"
    class="relative"
>

    {{-- ================================================= --}}
    {{-- ALERT SESSION --}}
    {{-- ================================================= --}}

    @if(session('success'))

        <div
            x-init="showSuccess(@js(session('success')))"
        ></div>

    @endif


    @if(session('error'))

        <div
            x-init="showError(@js(session('error')))"
        ></div>

    @endif


    @if($errors->any())

        <div
            x-init="showError(@js($errors->first()))"
        ></div>

    @endif


    {{-- ================================================= --}}
    {{-- HEADER --}}
    {{-- ================================================= --}}

    <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">

        <div>

            <h2 class="text-2xl font-black">
                Penukaran Botol
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Kelola pengajuan penukaran botol yang dikirim oleh siswa.
            </p>

        </div>


        <div
            class="rounded-full bg-yellow-500/10 px-4 py-2 text-xs font-bold text-yellow-600 dark:text-yellow-400"
        >
            {{ $pengajuan->total() }} Pengajuan Menunggu
        </div>

    </div>


    {{-- ================================================= --}}
    {{-- PANEL PENGAJUAN --}}
    {{-- ================================================= --}}

    <div
        class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
    >

        {{-- HEADER PANEL --}}

        <div
            class="border-b border-gray-200 px-6 py-5 dark:border-white/10"
        >

            <div class="flex flex-col justify-between gap-5 lg:flex-row lg:items-center">

                <div>

                    <h3 class="font-bold">
                        Pengajuan Penukaran
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Cari siswa berdasarkan nama atau kode siswa untuk memproses pengajuan.
                    </p>

                </div>


                {{-- PENCARIAN --}}

                <form
                    action="{{ route('admin.penukaran') }}"
                    method="GET"
                    class="w-full lg:w-auto"
                >

                    <div class="flex gap-2">

                        <div class="relative flex-1 lg:w-80">

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari nama atau kode siswa..."
                                class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 pl-10 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-900"
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

                        </div>


                        <button
                            type="submit"
                            class="rounded-xl bg-gray-900 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-gray-700 dark:bg-white dark:text-gray-950 dark:hover:bg-gray-200"
                        >
                            Cari
                        </button>


                        @if(request('search'))

                            <a
                                href="{{ route('admin.penukaran') }}"
                                class="flex items-center justify-center rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-500 transition hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                            >
                                Reset
                            </a>

                        @endif

                    </div>

                </form>

            </div>

        </div>


        {{-- HASIL PENCARIAN --}}

        @if(request('search'))

            <div
                class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-xs text-gray-500 dark:border-white/10 dark:bg-white/[0.02]"
            >

                Hasil pencarian untuk:

                <span class="font-bold text-gray-900 dark:text-white">
                    "{{ request('search') }}"
                </span>

            </div>

        @endif


        {{-- ================================================= --}}
        {{-- TABLE --}}
        {{-- ================================================= --}}

        <div class="overflow-x-auto">

            <table class="w-full min-w-[900px] text-left text-sm">

                <thead
                    class="border-b border-gray-200 text-xs uppercase text-gray-500 dark:border-white/10"
                >

                    <tr>

                        <th class="px-6 py-4">
                            Siswa
                        </th>

                        <th class="px-6 py-4">
                            Detail Botol
                        </th>

                        <th class="px-6 py-4">
                            Total Poin
                        </th>

                        <th class="px-6 py-4">
                            Diajukan
                        </th>

                        <th class="px-6 py-4">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody
                    class="divide-y divide-gray-200 dark:divide-white/10"
                >

                    @forelse($pengajuan as $item)

                        <tr
                            class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                        >

                            {{-- SISWA --}}

                            <td class="px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-green-500 font-black text-gray-950"
                                    >
                                        {{ strtoupper(substr($item->siswa->nama_lengkap, 0, 1)) }}
                                    </div>

                                    <div>

                                        <p class="font-semibold">
                                            {{ $item->siswa->nama_lengkap }}
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $item->siswa->kode_siswa }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- DETAIL BOTOL --}}

                            <td class="px-6 py-5">

                                <div class="space-y-1.5">

                                    @foreach($item->detailPenukaran as $detail)

                                        <div class="flex items-center gap-2">

                                            <span class="font-medium">
                                                {{ $detail->kategoriBotol->nama_kategori }}
                                            </span>

                                            @if($detail->kategoriBotol->ukuran)

                                                <span class="text-xs text-gray-500">
                                                    ({{ $detail->kategoriBotol->ukuran }})
                                                </span>

                                            @endif

                                            <span class="text-xs text-gray-500">
                                                × {{ $detail->jumlah_botol }}
                                            </span>

                                        </div>

                                    @endforeach

                                </div>

                            </td>


                            {{-- TOTAL POIN --}}

                            <td class="px-6 py-5">

                                <span class="font-black text-green-500">
                                    +{{ number_format($item->total_poin, 0, ',', '.') }}
                                </span>

                                <p class="mt-1 text-xs text-gray-500">
                                    poin
                                </p>

                            </td>


                            {{-- TANGGAL --}}

                            <td class="px-6 py-5 text-gray-500">

                                <p>
                                    {{ $item->tanggal->format('d/m/Y') }}
                                </p>

                                <p class="mt-1 text-xs">
                                    {{ $item->tanggal->format('H:i') }}
                                </p>

                            </td>


                            {{-- STATUS --}}

                            <td class="px-6 py-5">

                                <span
                                    class="inline-flex rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold text-yellow-600 dark:text-yellow-400"
                                >
                                    Menunggu
                                </span>

                            </td>


                            {{-- AKSI --}}

                            <td class="px-6 py-5">

                                <div class="flex justify-end gap-2">

                                    {{-- FORM TOLAK --}}

                                    <form
                                        x-ref="tolakForm{{ $item->id }}"
                                        action="{{ route('admin.penukaran.tolak', $item->id) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="button"
                                            @click="openConfirm(
                                                'tolak',
                                                @js($item->siswa->nama_lengkap),
                                                $refs.tolakForm{{ $item->id }}
                                            )"
                                            class="rounded-lg border border-red-500/20 px-3 py-2 text-xs font-bold text-red-500 transition hover:bg-red-500/10"
                                        >
                                            Tolak
                                        </button>

                                    </form>


                                    {{-- FORM SETUJUI --}}

                                    <form
                                        x-ref="setujuiForm{{ $item->id }}"
                                        action="{{ route('admin.penukaran.setujui', $item->id) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="button"
                                            @click="openConfirm(
                                                'setujui',
                                                @js($item->siswa->nama_lengkap),
                                                $refs.setujuiForm{{ $item->id }}
                                            )"
                                            class="rounded-lg bg-green-500 px-3 py-2 text-xs font-bold text-gray-950 transition hover:bg-green-400"
                                        >
                                            Setujui
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-14 text-center"
                            >

                                <div
                                    class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-gray-400 dark:bg-white/5"
                                >

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.8"
                                        stroke="currentColor"
                                        class="h-7 w-7"
                                    >

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 6v6l4 2"
                                        />

                                    </svg>

                                </div>


                                @if(request('search'))

                                    <h3 class="mt-4 font-bold">
                                        Pengajuan tidak ditemukan
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Tidak ada pengajuan dari siswa yang sesuai dengan pencarian.
                                    </p>

                                @else

                                    <h3 class="mt-4 font-bold">
                                        Tidak ada pengajuan
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Saat ini tidak ada pengajuan penukaran yang menunggu persetujuan.
                                    </p>

                                @endif

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- ================================================= --}}
        {{-- PAGINATION --}}
        {{-- ================================================= --}}

        @if($pengajuan->hasPages())

            <div
                class="flex flex-col gap-4 border-t border-gray-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between dark:border-white/10"
            >

                <p class="text-xs text-gray-500">

                    Menampilkan

                    <span class="font-semibold text-gray-700 dark:text-gray-300">
                        {{ $pengajuan->firstItem() ?? 0 }}
                    </span>

                    -

                    <span class="font-semibold text-gray-700 dark:text-gray-300">
                        {{ $pengajuan->lastItem() ?? 0 }}
                    </span>

                    dari

                    <span class="font-semibold text-gray-700 dark:text-gray-300">
                        {{ $pengajuan->total() }}
                    </span>

                    pengajuan

                </p>


                <div class="flex items-center gap-1">

                    @if($pengajuan->onFirstPage())

                        <span
                            class="rounded-lg border border-gray-200 px-3 py-2 text-xs text-gray-300 dark:border-white/10"
                        >
                            Sebelumnya
                        </span>

                    @else

                        <a
                            href="{{ $pengajuan->previousPageUrl() }}"
                            class="rounded-lg border border-gray-200 px-3 py-2 text-xs text-gray-500 transition hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                        >
                            Sebelumnya
                        </a>

                    @endif


                    @foreach($pengajuan->getUrlRange(
                        max(1, $pengajuan->currentPage() - 2),
                        min($pengajuan->lastPage(), $pengajuan->currentPage() + 2)
                    ) as $page => $url)

                        @if($page == $pengajuan->currentPage())

                            <span
                                class="rounded-lg bg-green-500 px-3 py-2 text-xs font-bold text-gray-950"
                            >
                                {{ $page }}
                            </span>

                        @else

                            <a
                                href="{{ $url }}"
                                class="rounded-lg border border-gray-200 px-3 py-2 text-xs text-gray-500 transition hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                            >
                                {{ $page }}
                            </a>

                        @endif

                    @endforeach


                    @if($pengajuan->hasMorePages())

                        <a
                            href="{{ $pengajuan->nextPageUrl() }}"
                            class="rounded-lg border border-gray-200 px-3 py-2 text-xs text-gray-500 transition hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                        >
                            Selanjutnya
                        </a>

                    @else

                        <span
                            class="rounded-lg border border-gray-200 px-3 py-2 text-xs text-gray-300 dark:border-white/10"
                        >
                            Selanjutnya
                        </span>

                    @endif

                </div>

            </div>

        @endif

    </div>


    {{-- ================================================= --}}
    {{-- RIWAYAT --}}
    {{-- ================================================= --}}

    <div class="mt-12">

        <div class="mb-6">

            <h2 class="text-2xl font-black">
                Riwayat Penukaran
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Riwayat seluruh penukaran botol yang telah diproses.
            </p>

        </div>


        <div
            class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
        >

            <div class="overflow-x-auto">

                <table class="w-full min-w-[850px] text-left text-sm">

                    <thead
                        class="border-b border-gray-200 text-xs uppercase text-gray-500 dark:border-white/10"
                    >

                        <tr>

                            <th class="px-6 py-4">
                                Siswa
                            </th>

                            <th class="px-6 py-4">
                                Detail Botol
                            </th>

                            <th class="px-6 py-4">
                                Total
                            </th>

                            <th class="px-6 py-4">
                                Admin
                            </th>

                            <th class="px-6 py-4">
                                Waktu
                            </th>

                            <th class="px-6 py-4">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody
                        class="divide-y divide-gray-200 dark:divide-white/10"
                    >

                        @forelse($riwayat as $item)

                            <tr
                                class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                            >

                                {{-- SISWA --}}

                                <td class="px-6 py-5">

                                    <p class="font-semibold">
                                        {{ $item->siswa->nama_lengkap }}
                                    </p>

                                    <p class="mt-1 text-xs text-gray-500">
                                        {{ $item->siswa->kode_siswa }}
                                    </p>

                                </td>


                                {{-- DETAIL BOTOL --}}

                                <td class="px-6 py-5">

                                    <div class="space-y-1">

                                        @foreach($item->detailPenukaran as $detail)

                                            <p class="text-gray-500">

                                                {{ $detail->kategoriBotol->nama_kategori }}

                                                ×

                                                {{ $detail->jumlah_botol }}

                                            </p>

                                        @endforeach

                                    </div>

                                </td>


                                {{-- TOTAL --}}

                                <td class="px-6 py-5">

                                    <span class="font-bold text-green-500">
                                        +{{ number_format($item->total_poin, 0, ',', '.') }}
                                    </span>

                                </td>


                                {{-- ADMIN --}}

                                <td class="px-6 py-5 text-gray-500">

                                    @if($item->admin)

                                        {{ $item->admin->name }}

                                    @else

                                        -

                                    @endif

                                </td>


                                {{-- WAKTU --}}

                                <td class="px-6 py-5 text-gray-500">

                                    {{ $item->tanggal->format('d/m/Y H:i') }}

                                </td>


                                {{-- STATUS --}}

                                <td class="px-6 py-5">

                                    @if($item->status === 'disetujui')

                                        <span
                                            class="inline-flex rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                        >
                                            Disetujui
                                        </span>

                                    @elseif($item->status === 'ditolak')

                                        <span
                                            class="inline-flex rounded-full bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-500"
                                        >
                                            Ditolak
                                        </span>

                                    @else

                                        <span
                                            class="inline-flex rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold text-yellow-600 dark:text-yellow-400"
                                        >
                                            Menunggu
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-10 text-center text-sm text-gray-500"
                                >
                                    Belum ada riwayat penukaran.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- ================================================= --}}
    {{-- MODAL KONFIRMASI --}}
    {{-- ================================================= --}}

    <div
        x-show="confirmModal"
        x-transition.opacity
        class="fixed inset-0 z-[200] flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
        style="display: none;"
    >

        {{-- BACKDROP --}}

        <div
            class="absolute inset-0"
            @click="closeConfirm()"
        ></div>


        {{-- MODAL --}}

        <div
            x-show="confirmModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.stop
            class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900"
        >

            {{-- ICON --}}

            <div
                x-show="confirmAction === 'setujui'"
                class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-500/10 text-green-500"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    class="h-6 w-6"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m5 12 4 4L19 6"
                    />

                </svg>

            </div>


            <div
                x-show="confirmAction === 'tolak'"
                class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-500/10 text-red-500"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    class="h-6 w-6"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18 18 6M6 6l12 12"
                    />

                </svg>

            </div>


            {{-- TITLE --}}

            <h2
                class="mt-5 text-lg font-bold"
                x-text="confirmAction === 'setujui'
                    ? 'Setujui Pengajuan?'
                    : 'Tolak Pengajuan?'"
            ></h2>


            {{-- DESCRIPTION --}}

            <p class="mt-2 text-sm leading-6 text-gray-500">

                <span
                    x-show="confirmAction === 'tolak'"
                >
                    Kamu akan menolak pengajuan penukaran dari
                    <strong
                        class="font-bold text-gray-900 dark:text-white"
                        x-text="confirmName"
                    ></strong>.
                    Pengajuan ini tidak akan menambahkan poin ke saldo siswa.
                </span>

            </p>


            {{-- BUTTON --}}

            <div
                class="mt-6 flex justify-end gap-3 border-t border-gray-200 pt-5 dark:border-white/10"
            >

                <button
                    type="button"
                    @click="closeConfirm()"
                    class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-100 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/5"
                >
                    Batal
                </button>


                <button
                    type="button"
                    @click="submitConfirm()"
                    x-text="confirmAction === 'setujui'
                        ? 'Ya, Setujui'
                        : 'Ya, Tolak'"
                    :class="confirmAction === 'setujui'
                        ? 'bg-green-500 text-gray-950 hover:bg-green-400'
                        : 'bg-red-500 text-white hover:bg-red-600'"
                    class="rounded-xl px-5 py-3 text-sm font-bold transition"
                ></button>

            </div>

        </div>

    </div>


    {{-- ================================================= --}}
    {{-- POPUP SUCCESS --}}
    {{-- ================================================= --}}

    <div
        x-show="successModal"
        x-transition.opacity
        class="fixed right-5 top-5 z-[300] w-full max-w-sm"
        style="display: none;"
    >

        <div
            class="rounded-2xl border border-green-500/20 bg-white p-4 shadow-2xl dark:border-green-500/20 dark:bg-gray-900"
        >

            <div class="flex items-start gap-3">

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green-500/10 text-green-500"
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
                            d="m5 12 4 4L19 6"
                        />

                    </svg>

                </div>


                <div class="min-w-0 flex-1">

                    <p class="font-bold">
                        Berhasil
                    </p>

                    <p
                        class="mt-1 text-sm text-gray-500"
                        x-text="successMessage"
                    ></p>

                </div>


                <button
                    type="button"
                    @click="successModal = false"
                    class="text-gray-400 transition hover:text-gray-900 dark:hover:text-white"
                >
                    ✕
                </button>

            </div>

        </div>

    </div>


    {{-- ================================================= --}}
    {{-- POPUP ERROR --}}
    {{-- ================================================= --}}

    <div
        x-show="errorModal"
        x-transition.opacity
        class="fixed right-5 top-5 z-[300] w-full max-w-sm"
        style="display: none;"
    >

        <div
            class="rounded-2xl border border-red-500/20 bg-white p-4 shadow-2xl dark:border-red-500/20 dark:bg-gray-900"
        >

            <div class="flex items-start gap-3">

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-500/10 text-red-500"
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
                            d="M6 18 18 6M6 6l12 12"
                        />

                    </svg>

                </div>


                <div class="min-w-0 flex-1">

                    <p class="font-bold">
                        Gagal
                    </p>

                    <p
                        class="mt-1 text-sm text-gray-500"
                        x-text="errorMessage"
                    ></p>

                </div>


                <button
                    type="button"
                    @click="errorModal = false"
                    class="text-gray-400 transition hover:text-gray-900 dark:hover:text-white"
                >
                    ✕
                </button>

            </div>

        </div>

    </div>

</main>

@endsection
