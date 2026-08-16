@extends('layouts.siswa.app')

@section('title', 'Riwayat Poin')

@section('topbar-subtitle', 'Keuangan Poin')

@section('topbar-title', 'Riwayat Poin')

@section('content')

        <div class="mb-8">

            <p class="text-sm font-medium text-green-500">
                Poin Saya
            </p>

            <h2 class="mt-2 text-3xl font-black">
                Riwayat Poin
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Lihat seluruh pemasukan dan penggunaan poin kamu.
            </p>

        </div>



        {{-- ================================================= --}}
        {{-- SALDO + STAT --}}
        {{-- ================================================= --}}

        <div class="grid gap-4 md:grid-cols-3">


            {{-- SALDO --}}

            <div
                class="relative overflow-hidden rounded-2xl bg-green-500 p-6 text-gray-950 md:col-span-2"
            >

                <div
                    class="absolute -right-12 -top-12 h-40 w-40 rounded-full bg-white/10"
                ></div>

                <p class="relative text-sm font-semibold text-gray-950/70">
                    Saldo Poin Saat Ini
                </p>

                <div class="relative mt-2 flex items-end gap-2">

                    <span class="text-4xl font-black">
                        {{ number_format($siswa->saldo_poin, 0, ',', '.') }}
                    </span>

                    <span class="mb-1 font-semibold">
                        poin
                    </span>

                </div>

                <p class="relative mt-3 text-xs text-gray-950/70">
                    Bisa digunakan untuk membeli produk.
                </p>

            </div>



            {{-- TOTAL DIDAPAT --}}

            <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]">
                <p class="text-xs font-semibold text-gray-500">Total Poin Didapat</p>
                <p class="mt-2 text-2xl font-black">{{ number_format($totalDidapat, 0, ',', '.') }}</p>
                <p class="mt-2 text-xs text-green-500">+ {{ number_format($totalDidapatBulanIni, 0, ',', '.') }} poin bulan ini</p>
            </div>
        </div>



        {{-- ================================================= --}}
        {{-- FILTER --}}
        {{-- ================================================= --}}

        <div
            class="mt-8 flex flex-col gap-4 rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03] sm:flex-row sm:items-center sm:justify-between"
        >

            <div>

                <h3 class="font-bold">
                    Aktivitas Poin
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Riwayat transaksi poin kamu.
                </p>

            </div>


            <div class="flex gap-2">

            {{-- SEMUA --}}
                <a href="{{ route('siswa.poin') }}" class="rounded-xl px-4 py-2 text-xs font-semibold {{ request('filter') === null
                        ? 'bg-green-500 text-gray-950'
                        : 'border border-gray-200 text-gray-500 hover:border-green-500 hover:text-green-500 dark:border-white/10'
                    }}">
                    Semua
                </a>


                {{-- MASUK --}}
                <a
                    href="{{ route('siswa.poin', ['filter' => 'masuk']) }}"
                    class="rounded-xl px-4 py-2 text-xs font-semibold
                    {{ request('filter') === 'masuk'
                        ? 'bg-green-500 text-gray-950'
                        : 'border border-gray-200 text-gray-500 hover:border-green-500 hover:text-green-500 dark:border-white/10'
                    }}"
                >
                    Masuk
                </a>


                {{-- KELUAR --}}
                <a
                    href="{{ route('siswa.poin', ['filter' => 'keluar']) }}"
                    class="rounded-xl px-4 py-2 text-xs font-semibold
                    {{ request('filter') === 'keluar'
                        ? 'bg-green-500 text-gray-950'
                        : 'border border-gray-200 text-gray-500 hover:border-green-500 hover:text-green-500 dark:border-white/10'
                    }}"
                >
                    Keluar
                </a>

            </div>

        </div>



        {{-- ================================================= --}}
        {{-- RIWAYAT --}}
        {{-- ================================================= --}}

        <div
            class="mt-4 overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
        >

            {{-- HEADER --}}

            <div
                class="hidden border-b border-gray-200 px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:border-white/10 sm:grid sm:grid-cols-12"
            >

                <div class="col-span-5">
                    Aktivitas
                </div>

                <div class="col-span-3">
                    Tanggal
                </div>

                <div class="col-span-2">
                    Status
                </div>

                <div class="col-span-2 text-right">
                    Poin
                </div>

            </div>



            @forelse ($riwayatPoins as $riwayat)

            <div
                class="grid gap-3 border-b border-gray-200 px-6 py-5 last:border-b-0 dark:border-white/10 sm:grid-cols-12 sm:items-center"
            >

                {{-- AKTIVITAS --}}
                <div class="flex items-center gap-4 sm:col-span-5">

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl
                        {{ $riwayat->tipe === 'masuk'
                            ? 'bg-green-500/10 text-green-500'
                            : 'bg-red-500/10 text-red-500'
                        }}
                        font-bold"
                    >
                        {{ $riwayat->tipe === 'masuk' ? '+' : '-' }}
                    </div>

                    <div>

                        <p class="text-sm font-semibold">
                            {{ $riwayat->tipe === 'masuk'
                                ? 'Poin Masuk'
                                : 'Poin Keluar'
                            }}
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            {{ $riwayat->keterangan ?? '-' }}
                        </p>

                    </div>

                </div>


                {{-- TANGGAL --}}
                <div class="text-xs text-gray-500 sm:col-span-3">
                    {{ $riwayat->created_at->translatedFormat('d F Y') }}
                </div>


                {{-- STATUS --}}
                <div class="sm:col-span-2">

                    <span
                        class="rounded-full bg-green-500/10 px-3 py-1 text-[11px] font-semibold text-green-500"
                    >
                        Berhasil
                    </span>

                </div>


                {{-- POIN --}}
                <div
                    class="text-sm font-bold sm:col-span-2 sm:text-right
                    {{ $riwayat->tipe === 'masuk'
                        ? 'text-green-500'
                        : 'text-red-500'
                    }}"
                >
                    {{ $riwayat->tipe === 'masuk' ? '+' : '-' }}
                    {{ number_format($riwayat->jumlah_poin, 0, ',', '.') }}

                </div>

            </div>

        @empty

            <div class="px-6 py-10 text-center">

                <p class="text-sm font-semibold text-gray-500">
                    Belum ada riwayat poin.
                </p>

                <p class="mt-1 text-xs text-gray-400">
                    Aktivitas poin kamu akan muncul di sini.
                </p>

            </div>

        @endforelse

        @if ($riwayatPoins->hasPages())

            <div
                class="flex flex-col gap-4 border-t border-gray-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between dark:border-white/10"
            >

                <p class="text-xs text-gray-500">
                    Menampilkan
                    {{ $riwayatPoins->firstItem() ?? 0 }}-{{ $riwayatPoins->lastItem() ?? 0 }}
                    dari {{ $riwayatPoins->total() }} riwayat
                </p>


                <div class="flex gap-2">

                    {{-- SEBELUMNYA --}}
                    @if ($riwayatPoins->onFirstPage())

                        <span
                            class="rounded-lg border border-gray-200 px-3 py-2 text-xs text-gray-400 dark:border-white/10"
                        >
                            Sebelumnya
                        </span>

                    @else

                        <a
                            href="{{ $riwayatPoins->previousPageUrl() }}"
                            class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold transition hover:border-green-500 hover:text-green-500 dark:border-white/10"
                        >
                            Sebelumnya
                        </a>

                    @endif


                    {{-- NOMOR HALAMAN --}}
                    @foreach ($riwayatPoins->getUrlRange(1, $riwayatPoins->lastPage()) as $page => $url)

                        <a
                            href="{{ $url }}"
                            class="rounded-lg border px-3 py-2 text-xs font-semibold
                            {{ $page == $riwayatPoins->currentPage()
                                ? 'border-green-500 bg-green-500 text-gray-950'
                                : 'border-gray-200 hover:border-green-500 hover:text-green-500 dark:border-white/10'
                            }}"
                        >
                            {{ $page }}
                        </a>

                    @endforeach


                    {{-- SELANJUTNYA --}}
                    @if ($riwayatPoins->hasMorePages())

                        <a
                            href="{{ $riwayatPoins->nextPageUrl() }}"
                            class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold transition hover:border-green-500 hover:text-green-500 dark:border-white/10"
                        >
                            Selanjutnya
                        </a>

                    @else

                        <span
                            class="rounded-lg border border-gray-200 px-3 py-2 text-xs text-gray-400 dark:border-white/10"
                        >
                            Selanjutnya
                        </span>

                    @endif

                </div>

            </div>

        @endif

        </div>



        {{-- INFO --}}

        <div
            class="mt-5 rounded-2xl border border-green-500/20 bg-green-500/5 p-5"
        >

            <div class="flex gap-3">

                <div
                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-green-500/10 font-bold text-green-500"
                >
                    i
                </div>

                <div>

                    <p class="text-sm font-semibold">
                        Cara mendapatkan poin
                    </p>

                    <p class="mt-1 text-xs leading-5 text-gray-500">
                        Setorkan botol melalui admin Tercycle.
                        Setelah penukaran dikonfirmasi, poin akan
                        otomatis masuk ke saldo akun kamu.
                    </p>

                </div>

            </div>

        </div>


@endsection