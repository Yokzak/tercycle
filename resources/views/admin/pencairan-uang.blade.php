@extends('layouts.admin.app')

@section('title', 'Pencairan Dana')

@section('topbar-subtitle', 'Keuangan')

@section('topbar-title', 'Pencairan Dana')

@section('content')

<div
    class="space-y-6"
    x-data="{
        showConfirm: false,
        showResult: false,
        resultType: '',
        resultMessage: '',
        selectedForm: null,
        confirmMessage: '',
        showDetail: false,
        detail: {
            id: null,
            nama: '',
            kodeSiswa: '',
            poin: 0,
            uang: 0,
            metode: '',
            provider: '',
            penerima: '',
            nomor: '',
            status: '',
            tanggal: '',
            waktu: ''
        },

        openDetail(data) {
            this.detail = data;
            this.showDetail = true;
        },

        closeDetail() {
            this.showDetail = false;
        },

        openConfirm(form, message) {
            this.selectedForm = form;
            this.confirmMessage = message;
            this.showConfirm = true;
        },

        submitAction() {
            if (this.selectedForm) {
                this.selectedForm.submit();
            }
        }
    }"
>

{{-- HEADER --}}
<div>
    <h2 class="text-2xl font-black">
        Pencairan Dana
    </h2>

    <p class="mt-1 text-sm text-gray-500">
        Kelola pengajuan pencairan poin siswa.
    </p>
</div>

{{-- TABLE --}}
<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]">

    {{-- TABLE HEADER --}}
    <div class="border-b border-gray-200 p-6 dark:border-white/10">

        <div class="flex flex-col gap-5">

            {{-- JUDUL --}}
            <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h3 class="font-bold">
                        Pengajuan Pencairan
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Daftar pengajuan pencairan poin dari siswa.
                    </p>
                </div>

                <div class="text-sm text-gray-500">
                    Total:
                    <span class="font-bold text-gray-900 dark:text-white">
                        {{ $pencairan->total() }}
                    </span>
                    pengajuan
                </div>

            </div>


            {{-- SEARCH --}}
            <form
                method="GET"
                action="{{ route('admin.pencairan-uang.indexAdmin') }}"
                class="flex flex-col gap-2 sm:flex-row"
            >

                <div class="relative flex-1">

                    {{-- ICON SEARCH --}}
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m21 21-4.35-4.35m2.1-5.4a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z"
                            />
                        </svg>

                    </div>


                    {{-- INPUT --}}
                    <input
                        type="text"
                        name="search"
                        value="{{ $search ?? '' }}"
                        placeholder="Cari ID, nama siswa, kode siswa, penerima..."
                        class="w-full rounded-xl border border-gray-300 bg-white py-3 pl-11 pr-4 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-white/5"
                    >

                </div>


                {{-- BUTTON --}}
                <button
                    type="submit"
                    class="rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
                >
                    Cari
                </button>


                {{-- RESET --}}
                @if(!empty($search))

                    <a
                        href="{{ route('admin.pencairan-uang.indexAdmin') }}"
                        class="rounded-xl border border-gray-200 px-5 py-3 text-center text-sm font-semibold text-gray-600 transition hover:bg-gray-100 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/5"
                    >
                        Reset
                    </a>

                @endif

            </form>


            {{-- HASIL SEARCH --}}
            @if(!empty($search))

                <p class="text-xs text-gray-500">
                    Menampilkan hasil pencarian untuk:
                    <span class="font-semibold text-gray-900 dark:text-white">
                        "{{ $search }}"
                    </span>
                </p>

            @endif

        </div>

    </div>


    {{-- TABLE --}}
    <div class="overflow-x-auto">

        <table class="w-full text-left text-sm">

            <thead class="border-b border-gray-200 text-xs uppercase text-gray-500 dark:border-white/10">

                <tr>

                    <th class="whitespace-nowrap px-6 py-4">
                        ID
                    </th>

                    <th class="whitespace-nowrap px-6 py-4">
                        Siswa
                    </th>

                    <th class="whitespace-nowrap px-6 py-4">
                        Poin
                    </th>

                    <th class="whitespace-nowrap px-6 py-4">
                        Nominal
                    </th>

                    <th class="whitespace-nowrap px-6 py-4">
                        Metode
                    </th>

                    <th class="whitespace-nowrap px-6 py-4">
                        Penerima
                    </th>

                    <th class="whitespace-nowrap px-6 py-4">
                        Status
                    </th>

                    <th class="whitespace-nowrap px-6 py-4">
                        Pengajuan
                    </th>

                    <th class="whitespace-nowrap px-6 py-4 text-center">
                        Detail
                    </th>

                    <th class="whitespace-nowrap px-6 py-4 text-right">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-200 dark:divide-white/10">

                @forelse ($pencairan as $item)

                    <tr class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]">

                        {{-- ID --}}
                        <td class="whitespace-nowrap px-6 py-5">

                            <span class="font-mono text-xs font-semibold">
                                PEN-{{ str_pad($item->id, 6, '0', STR_PAD_LEFT) }}
                            </span>

                        </td>


                        {{-- SISWA --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-500 font-bold text-gray-950">

                                    {{ strtoupper(substr($item->siswa->nama_lengkap ?? 'S', 0, 1)) }}

                                </div>

                                <div>

                                    <p class="font-semibold">
                                        {{ $item->siswa->nama_lengkap ?? '-' }}
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $item->siswa->kode_siswa ?? '-' }}
                                    </p>

                                </div>

                            </div>

                        </td>


                        {{-- POIN --}}
                        <td class="whitespace-nowrap px-6 py-5">

                            <span class="font-bold text-green-500">
                                {{ number_format($item->jumlah_poin, 0, ',', '.') }}
                            </span>

                            <span class="text-xs text-gray-500">
                                poin
                            </span>

                        </td>


                        {{-- NOMINAL --}}
                        <td class="whitespace-nowrap px-6 py-5">

                            <span class="font-bold">
                                Rp {{ number_format($item->jumlah_uang, 0, ',', '.') }}
                            </span>

                        </td>


                        {{-- METODE --}}
                        <td class="px-6 py-5">

                            @if ($item->metode === 'e-wallet')

                                <div>
                                    <p class="font-semibold">
                                        E-Wallet
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $item->provider ?? '-' }}
                                    </p>
                                </div>

                            @elseif ($item->metode === 'bank')

                                <div>
                                    <p class="font-semibold">
                                        Bank
                                    </p>

                                    <p class="text-xs text-gray-500">
                                        {{ $item->provider ?? '-' }}
                                    </p>
                                </div>

                            @else

                                <span class="font-semibold">
                                    Cash
                                </span>

                            @endif

                        </td>


                        {{-- PENERIMA --}}
                        <td class="px-6 py-5">

                            <p class="font-semibold">
                                {{ $item->nama_penerima }}
                            </p>

                            @if ($item->nomor_tujuan)

                                <p class="font-mono text-xs text-gray-500">
                                    {{ $item->nomor_tujuan }}
                                </p>

                            @endif

                        </td>


                        {{-- STATUS --}}
                        <td class="whitespace-nowrap px-6 py-5">

                            @if ($item->status === 'menunggu')

                                <span class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold text-yellow-600 dark:text-yellow-400">
                                    Menunggu
                                </span>

                            @elseif ($item->status === 'diproses')

                                <span class="rounded-full bg-blue-500/10 px-3 py-1 text-xs font-semibold text-blue-600 dark:text-blue-400">
                                    Diproses
                                </span>

                            @elseif ($item->status === 'disetujui')

                                <span class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-600 dark:text-green-400">
                                    Disetujui
                                </span>

                            @elseif ($item->status === 'ditolak')

                                <span class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-600 dark:text-red-400">
                                    Ditolak
                                </span>

                            @elseif ($item->status === 'selesai')

                                <span class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-600 dark:text-green-400">
                                    Selesai
                                </span>

                            @else

                                <span class="rounded-full bg-gray-500/10 px-3 py-1 text-xs font-semibold text-gray-500">
                                    {{ ucfirst($item->status) }}
                                </span>

                            @endif

                        </td>


                        {{-- TANGGAL --}}
                        <td class="whitespace-nowrap px-6 py-5">

                            <p class="text-xs font-medium">
                                {{ $item->tanggal_pengajuan?->format('d M Y') }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ $item->tanggal_pengajuan?->format('H:i') }}
                            </p>

                        </td>

                        {{-- DETAIL --}}
                        <td class="px-6 py-5 text-center">

                            <button
                                type="button"
                                @click="openDetail({
                                    id: {{ $item->id }},
                                    nama: @js($item->siswa->nama_lengkap ?? '-'),
                                    kodeSiswa: @js($item->siswa->kode_siswa ?? '-'),
                                    poin: {{ $item->jumlah_poin }},
                                    uang: {{ $item->jumlah_uang }},
                                    metode: @js($item->metode),
                                    provider: @js($item->provider),
                                    penerima: @js($item->nama_penerima),
                                    nomor: @js($item->nomor_tujuan),
                                    status: @js($item->status),
                                    tanggal: @js($item->tanggal_pengajuan?->format('d M Y')),
                                    waktu: @js($item->tanggal_pengajuan?->format('H:i'))
                                })"
                                class="rounded-lg border border-green-200 px-3 py-2 text-xs font-bold text-green-600 transition hover:bg-green-50 dark:border-green-500/20 dark:hover:bg-green-500/10"
                            >
                                Lihat Detail
                            </button>

                        </td>


                        {{-- AKSI --}}
                        <td class="px-6 py-5">

                            <div class="flex justify-end gap-2">

                                {{-- MENUNGGU --}}
                                @if ($item->status === 'menunggu')

                                    <form
                                        method="POST"
                                        action="{{ route('admin.pencairan-uang.process', $item) }}"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="button"
                                            @click="openConfirm($el.closest('form'), 'Proses pengajuan pencairan ini? Saldo siswa akan dikurangi.')"
                                            class="rounded-lg bg-blue-500 px-3 py-2 text-xs font-bold text-white transition hover:bg-blue-600"
                                        >
                                            Proses
                                        </button>

                                    </form>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.pencairan-uang.reject', $item) }}"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="button"
                                            @click="openConfirm($el.closest('form'), 'Tolak pengajuan pencairan ini?')"
                                            class="rounded-lg border border-red-200 px-3 py-2 text-xs font-bold text-red-500 transition hover:bg-red-50 dark:border-red-500/20 dark:hover:bg-red-500/10"
                                        >
                                            Tolak
                                        </button>

                                    </form>


                                {{-- DIPROSES --}}
                                @elseif ($item->status === 'diproses')

                                    <form
                                        method="POST"
                                        action="{{ route('admin.pencairan-uang.approve', $item) }}"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="button"
                                            @click="openConfirm($el.closest('form'), 'Konfirmasi bahwa transfer dana kepada siswa sudah dilakukan?')"
                                            class="rounded-lg bg-green-500 px-3 py-2 text-xs font-bold text-gray-950 transition hover:bg-green-400"
                                        >
                                            Konfirmasi Transfer
                                        </button>

                                    </form>


                                    <form
                                        method="POST"
                                        action="{{ route('admin.pencairan-uang.reject', $item) }}"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="button"
                                            @click="openConfirm($el.closest('form'), 'Tolak pengajuan ini? Saldo siswa akan dikembalikan.')"
                                            class="rounded-lg border border-red-200 px-3 py-2 text-xs font-bold text-red-500 transition hover:bg-red-50 dark:border-red-500/20 dark:hover:bg-red-500/10"
                                        >
                                            Tolak
                                        </button>

                                    </form>


                                {{-- STATUS FINAL --}}
                                @else

                                    <span class="text-xs text-gray-400">
                                        Tidak ada aksi
                                    </span>

                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="10"
                            class="px-6 py-16 text-center"
                        >

                            <div class="flex flex-col items-center">

                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-gray-400 dark:bg-white/10">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="h-6 w-6"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                        />
                                    </svg>

                                </div>

                                <p class="mt-3 font-semibold">
                                    Belum ada pengajuan pencairan
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    Pengajuan pencairan dari siswa akan muncul di sini.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- PAGINATION --}}
    @if ($pencairan->hasPages())

        <div class="border-t border-gray-200 px-6 py-4 dark:border-white/10">

            {{ $pencairan->links() }}

        </div>

    @endif

</div>

{{-- POPUP DETAIL --}}
<div
    x-show="showDetail"
    x-cloak
    x-transition.opacity
    class="fixed inset-0 z-[90] flex items-center justify-center bg-black/50 px-4 backdrop-blur-sm"
>
    <div
        x-show="showDetail"
        x-transition
        @click.outside="closeDetail()"
        class="w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-900"
    >

        {{-- HEADER --}}
        <div class="bg-gray-950 px-6 py-5 text-white dark:bg-white dark:text-gray-950">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">
                        Detail Pencairan
                    </p>

                    <h3 class="mt-1 text-xl font-black">
                        Informasi Pengajuan
                    </h3>
                </div>

                <button
                    type="button"
                    @click="closeDetail()"
                    class="rounded-lg p-2 text-gray-400 transition hover:bg-white/10 hover:text-white dark:hover:bg-black/10 dark:hover:text-gray-950"
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
                </button>

            </div>

        </div>


        {{-- CONTENT --}}
        <div class="p-6">

            {{-- ID --}}
            <div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-4 text-center dark:border-white/10 dark:bg-white/5">

                <p class="text-xs text-gray-500">
                    ID Pencairan
                </p>

                <p
                    class="mt-1 font-mono text-xl font-black tracking-wider"
                    x-text="'PEN-' + String(detail.id).padStart(6, '0')"
                ></p>

            </div>


            {{-- NOMINAL --}}
            <div class="mt-5 rounded-xl bg-green-500/10 p-5 text-center">

                <p class="text-xs text-gray-500">
                    Jumlah Pencairan
                </p>

                <p
                    class="mt-1 text-3xl font-black text-green-600"
                    x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(detail.uang)"
                ></p>

                <p
                    class="mt-1 text-sm text-gray-500"
                    x-text="new Intl.NumberFormat('id-ID').format(detail.poin) + ' poin'"
                ></p>

            </div>


            {{-- DETAIL --}}
            <div class="mt-6 space-y-3">

                <div class="flex justify-between gap-4">
                    <span class="text-sm text-gray-500">
                        Nama Siswa
                    </span>

                    <span
                        class="text-right text-sm font-semibold"
                        x-text="detail.nama"
                    ></span>
                </div>


                <div class="flex justify-between gap-4">
                    <span class="text-sm text-gray-500">
                        Kode Siswa
                    </span>

                    <span
                        class="font-mono text-sm font-semibold"
                        x-text="detail.kodeSiswa"
                    ></span>
                </div>


                <div class="flex justify-between gap-4">
                    <span class="text-sm text-gray-500">
                        Metode
                    </span>

                    <span
                        class="text-right text-sm font-semibold"
                        x-text="detail.metode === 'e-wallet' ? 'E-Wallet' : detail.metode === 'cash' ? 'Cash' : detail.metode"
                    ></span>
                </div>


                <template x-if="detail.provider">

                    <div class="flex justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Provider
                        </span>

                        <span
                            class="text-right text-sm font-semibold"
                            x-text="detail.provider.toUpperCase()"
                        ></span>

                    </div>

                </template>


                <div class="flex justify-between gap-4">

                    <span class="text-sm text-gray-500">
                        Penerima
                    </span>

                    <span
                        class="text-right text-sm font-semibold"
                        x-text="detail.penerima"
                    ></span>

                </div>


                <template x-if="detail.nomor">

                    <div class="flex justify-between gap-4">

                        <span class="text-sm text-gray-500">
                            Nomor Tujuan
                        </span>

                        <span
                            class="font-mono text-sm font-semibold"
                            x-text="detail.nomor"
                        ></span>

                    </div>

                </template>


                <div class="flex justify-between gap-4">

                    <span class="text-sm text-gray-500">
                        Status
                    </span>

                    <span
                        class="rounded-full bg-gray-500/10 px-3 py-1 text-xs font-semibold"
                        x-text="detail.status.charAt(0).toUpperCase() + detail.status.slice(1)"
                    ></span>

                </div>


                <div class="flex justify-between gap-4">

                    <span class="text-sm text-gray-500">
                        Pengajuan
                    </span>

                    <span
                        class="text-right text-sm font-semibold"
                        x-text="detail.tanggal + ' ' + detail.waktu"
                    ></span>

                </div>

            </div>


            {{-- CLOSE --}}
            <button
                type="button"
                @click="closeDetail()"
                class="mt-6 w-full rounded-xl bg-gray-950 px-4 py-3 text-sm font-bold text-white transition hover:bg-gray-800 dark:bg-white dark:text-gray-950 dark:hover:bg-gray-200"
            >
                Tutup
            </button>

        </div>

    </div>
</div>

{{-- MODAL KONFIRMASI --}}
<div
    x-show="showConfirm"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4"
>
    <div
        @click.outside="showConfirm = false"
        class="w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900"
    >

        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-yellow-500/10 text-yellow-500">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
                class="h-6 w-6"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 9v3.75m0 3.75h.008M10.29 3.86l-7.1 12.28A1.5 1.5 0 0 0 4.49 18.4h15.02a1.5 1.5 0 0 0 1.3-2.26L13.71 3.86a1.98 1.98 0 0 0-3.42 0Z"
                />
            </svg>
        </div>

        <h3 class="mt-4 text-lg font-bold">
            Konfirmasi Tindakan
        </h3>

        <p
            class="mt-2 text-sm text-gray-500"
            x-text="confirmMessage"
        ></p>

        <div class="mt-6 flex justify-end gap-3">

            <button
                type="button"
                @click="showConfirm = false"
                class="rounded-lg border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-600 transition hover:bg-gray-100 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/5"
            >
                Batal
            </button>

            <button
                type="button"
                @click="submitAction()"
                class="rounded-lg bg-green-500 px-4 py-2 text-sm font-bold text-gray-950 transition hover:bg-green-400"
            >
                Ya, Lanjutkan
            </button>

        </div>

    </div>
</div>

@if (session('success') || session('error'))

    <div
        x-data="{ open: true }"
        x-show="open"
        x-cloak
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 px-4"
    >

        <div
            @click.outside="open = false"
            class="w-full max-w-md rounded-2xl bg-white p-6 text-center shadow-2xl dark:bg-gray-900"
        >

            @if (session('success'))

                {{-- SUCCESS ICON --}}
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-500/10 text-green-500">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="h-8 w-8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m4.5 12.75 6 6 9-13.5"
                        />
                    </svg>

                </div>

                <h3 class="mt-4 text-xl font-bold">
                    Berhasil
                </h3>

                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    {{ session('success') }}
                </p>

            @else

                {{-- FAILED ICON --}}
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-500/10 text-red-500">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="h-8 w-8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18 18 6M6 6l12 12"
                        />
                    </svg>

                </div>

                <h3 class="mt-4 text-xl font-bold">
                    Gagal
                </h3>

                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    {{ session('error') }}
                </p>

            @endif

            <button
                type="button"
                @click="open = false"
                class="mt-6 w-full rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-gray-800 dark:bg-white dark:text-gray-900"
            >
                Tutup
            </button>

        </div>

    </div>

@endif
</div>

@endsection
