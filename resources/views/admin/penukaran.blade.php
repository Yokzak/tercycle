@extends('layouts.admin.app')

@section('title', 'Penukaran Botol')

@section('topbar-subtitle', 'Penukaran Botol')

@section('topbar-title', 'Penukaran Botol')

@section('content')

    <main class="mx-auto max-w-7xl px-6 py-8 lg:px-8">


        {{-- ALERT SUCCESS --}}

        @if(session('success'))

            <div
                class="mb-6 rounded-xl border border-green-500/20 bg-green-500/10 px-5 py-4 text-sm text-green-600 dark:text-green-400"
            >
                {{ session('success') }}
            </div>

        @endif


        {{-- ALERT ERROR --}}

        @if(session('error'))

            <div
                class="mb-6 rounded-xl border border-red-500/20 bg-red-500/10 px-5 py-4 text-sm text-red-600 dark:text-red-400"
            >
                {{ session('error') }}
            </div>

        @endif



        {{-- ================================================= --}}
        {{-- INPUT PENUKARAN OFFLINE --}}
        {{-- ================================================= --}}

        <div class="mb-8">

            <h2 class="text-2xl font-black">
                Input Penukaran Offline
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Admin dapat mencatat penukaran botol yang dilakukan siswa secara langsung.
            </p>

        </div>


        {{-- CARI SISWA --}}

        <div
            class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
        >

            <div class="flex items-center justify-between">

                <div>

                    <h3 class="font-bold">
                        Cari Siswa
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Gunakan kode siswa atau nama.
                    </p>

                </div>

                <span
                    class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                >
                    Langkah 1
                </span>

            </div>


            <form
                action="{{ route('admin.penukaran.cari') }}"
                method="POST"
                class="mt-5 flex flex-col gap-3 sm:flex-row"
            >

                @csrf

                <div class="relative flex-1">

                    <input
                        type="text"
                        name="keyword"
                        value="{{ old('keyword') }}"
                        placeholder="Masukkan kode siswa atau nama..."
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 pl-11 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-900"
                    >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="absolute left-4 top-3.5 h-5 w-5 text-gray-400"
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
                    class="rounded-xl bg-gray-900 px-6 py-3 text-sm font-bold text-white transition hover:bg-gray-700 dark:bg-white dark:text-gray-950 dark:hover:bg-gray-200"
                >
                    Cari Siswa
                </button>

            </form>

        </div>



        {{-- DATA SISWA HASIL PENCARIAN --}}

        @if(session('siswa'))

            @php
                $siswa = session('siswa');
            @endphp

            <div
                class="mt-6 rounded-2xl border border-green-500/20 bg-green-500/5 p-6 dark:bg-green-500/5"
            >

                <div class="flex items-center gap-4">

                    <div
                        class="flex h-14 w-14 items-center justify-center rounded-2xl bg-green-500 font-black text-gray-950"
                    >
                        {{ strtoupper(substr($siswa->nama_lengkap, 0, 1)) }}
                    </div>

                    <div class="flex-1">

                        <div class="flex items-center gap-3">

                            <h3 class="font-bold">
                                {{ $siswa->nama_lengkap }}
                            </h3>

                            <span
                                class="rounded-full bg-green-500/10 px-2.5 py-1 text-[11px] font-semibold text-green-500"
                            >
                                Aktif
                            </span>

                        </div>

                        <p class="mt-1 text-sm text-gray-500">
                            {{ $siswa->kode_siswa }}
                        </p>

                    </div>

                    <div class="hidden text-right sm:block">

                        <p class="text-xs text-gray-500">
                            Saldo saat ini
                        </p>

                        <p class="mt-1 font-black text-green-500">
                            {{ number_format($siswa->saldo_poin, 0, ',', '.') }} poin
                        </p>

                    </div>

                </div>

            </div>



            {{-- INPUT BOTOL OFFLINE --}}

            <div
                x-data="{
                    items: [
                        {
                            kategori_botol_id: '',
                            jumlah_botol: 1,
                            poin_satuan: 0
                        }
                    ],

                    kategori: @js(
                        $kategoriBotol->map(fn($item) => [
                            'id' => $item->id,
                            'nama' => $item->nama_kategori,
                            'ukuran' => $item->ukuran,
                            'poin' => $item->poin_satuan
                        ])
                    ),

                    tambah() {
                        this.items.push({
                            kategori_botol_id: '',
                            jumlah_botol: 1,
                            poin_satuan: 0
                        });
                    },

                    hapus(index) {
                        if (this.items.length > 1) {
                            this.items.splice(index, 1);
                        }
                    },

                    updatePoin(index) {
                        const item = this.items[index];

                        const kategori = this.kategori.find(
                            k => k.id == item.kategori_botol_id
                        );

                        item.poin_satuan = kategori
                            ? Number(kategori.poin)
                            : 0;
                    },

                    subtotal(item) {
                        return Number(item.jumlah_botol || 0)
                            * Number(item.poin_satuan || 0);
                    },

                    total() {
                        return this.items.reduce(
                            (total, item) =>
                                total + this.subtotal(item),
                            0
                        );
                    },

                    format(number) {
                        return new Intl.NumberFormat('id-ID').format(number);
                    }
                }"
                class="mt-6 rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <div class="flex items-center justify-between">

                    <div>

                        <h3 class="font-bold">
                            Detail Penukaran
                        </h3>

                        <p class="mt-1 text-xs text-gray-500">
                            Masukkan jenis dan jumlah botol yang diterima.
                        </p>

                    </div>

                    <span
                        class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                    >
                        Langkah 2
                    </span>

                </div>


                <form
                    action="{{ route('admin.penukaran.offline') }}"
                    method="POST"
                    class="mt-6"
                >

                    @csrf

                    <input
                        type="hidden"
                        name="siswa_id"
                        value="{{ $siswa->id }}"
                    >


                    {{-- ITEM BOTOL --}}

                    <div class="space-y-4">

                        <template
                            x-for="(item, index) in items"
                            :key="index"
                        >

                            <div
                                class="rounded-xl border border-gray-200 p-4 dark:border-white/10"
                            >

                                <div class="grid gap-4 md:grid-cols-12">


                                    {{-- JENIS --}}

                                    <div class="md:col-span-5">

                                        <label
                                            class="mb-2 block text-sm font-semibold"
                                        >
                                            Jenis Botol
                                        </label>

                                        <select
                                            :name="`botol[${index}][kategori_botol_id]`"
                                            x-model="item.kategori_botol_id"
                                            @change="updatePoin(index)"
                                            required
                                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none focus:border-green-500 dark:border-white/10 dark:bg-gray-900"
                                        >

                                            <option value="">
                                                Pilih jenis botol
                                            </option>

                                            <template
                                                x-for="kategori in kategori"
                                                :key="kategori.id"
                                            >

                                                <option
                                                    :value="kategori.id"
                                                    x-text="`${kategori.nama} (${kategori.ukuran}) - ${format(kategori.poin)} poin`"
                                                ></option>

                                            </template>

                                        </select>

                                    </div>


                                    {{-- JUMLAH --}}

                                    <div class="md:col-span-3">

                                        <label
                                            class="mb-2 block text-sm font-semibold"
                                        >
                                            Jumlah Botol
                                        </label>

                                        <input
                                            type="number"
                                            min="1"
                                            :name="`botol[${index}][jumlah_botol]`"
                                            x-model="item.jumlah_botol"
                                            required
                                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none focus:border-green-500 dark:border-white/10 dark:bg-gray-900"
                                        >

                                    </div>


                                    {{-- SUBTOTAL --}}

                                    <div class="md:col-span-3">

                                        <label
                                            class="mb-2 block text-sm font-semibold"
                                        >
                                            Poin
                                        </label>

                                        <div
                                            class="rounded-xl border border-green-500/20 bg-green-500/10 px-4 py-3 text-sm font-black text-green-500"
                                        >

                                            <span
                                                x-text="`+${format(subtotal(item))} Poin`"
                                            ></span>

                                        </div>

                                    </div>


                                    {{-- HAPUS --}}

                                    <div class="flex items-end md:col-span-1">

                                        <button
                                            type="button"
                                            @click="hapus(index)"
                                            class="w-full rounded-xl border border-red-500/20 px-3 py-3 text-red-500 transition hover:bg-red-500/10"
                                        >

                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.8"
                                                stroke="currentColor"
                                                class="mx-auto h-5 w-5"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673A2.25 2.25 0 0 1 15.916 21.5H8.084a2.25 2.25 0 0 1-2.244-1.827L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-9.5 0a48.11 48.11 0 0 1 3.478-.397m0 0V4.5A2.25 2.25 0 0 1 12 2.25h0a2.25 2.25 0 0 1 2.25 2.25v.893m-6.75 0a48.667 48.667 0 0 1 6.75 0"
                                                />
                                            </svg>

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </template>

                    </div>


                    {{-- TAMBAH BOTOL --}}

                    <button
                        type="button"
                        @click="tambah()"
                        class="mt-4 rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-100 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/5"
                    >
                        + Tambah Jenis Botol
                    </button>


                    {{-- SUMMARY --}}

                    <div
                        class="mt-6 rounded-xl bg-gray-50 p-5 dark:bg-white/5"
                    >

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-sm font-semibold">
                                    Total Penukaran
                                </p>

                                <p class="mt-1 text-xs text-gray-500">
                                    Total poin yang akan diberikan kepada siswa.
                                </p>

                            </div>

                            <p
                                class="text-xl font-black text-green-500"
                                x-text="`+${format(total())}`"
                            ></p>

                        </div>

                    </div>


                    {{-- BUTTON --}}

                    <div class="mt-6 flex justify-end">

                        <button
                            type="submit"
                            class="rounded-xl bg-green-500 px-6 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
                        >
                            Konfirmasi Penukaran
                        </button>

                    </div>

                </form>

            </div>

        @endif



        {{-- ================================================= --}}
        {{-- PENGAJUAN ONLINE --}}
        {{-- ================================================= --}}

        <div class="mt-10 mb-8">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-2xl font-black">
                        Pengajuan Online
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Pengajuan penukaran botol yang menunggu persetujuan admin.
                    </p>

                </div>

                <span
                    class="rounded-full bg-yellow-500/10 px-3 py-1.5 text-xs font-bold text-yellow-600 dark:text-yellow-400"
                >
                    {{ $pengajuan->count() }} Menunggu
                </span>

            </div>

        </div>


        @if($pengajuan->isEmpty())

            <div
                class="rounded-2xl border border-gray-200 bg-white p-10 text-center dark:border-white/10 dark:bg-white/[0.03]"
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

                <h3 class="mt-4 font-bold">
                    Tidak ada pengajuan
                </h3>

                <p class="mt-1 text-sm text-gray-500">
                    Saat ini tidak ada penukaran online yang menunggu persetujuan.
                </p>

            </div>

        @else

            <div class="space-y-5">

                @foreach($pengajuan as $item)

                    <div
                        class="rounded-2xl border border-yellow-500/20 bg-white p-6 dark:border-yellow-500/20 dark:bg-white/[0.03]"
                    >

                        {{-- HEADER --}}

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center">

                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-green-500 font-black text-gray-950"
                            >
                                {{ strtoupper(substr($item->siswa->nama_lengkap, 0, 1)) }}
                            </div>

                            <div class="flex-1">

                                <h3 class="font-bold">
                                    {{ $item->siswa->nama_lengkap }}
                                </h3>

                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $item->siswa->kode_siswa }}
                                </p>

                            </div>

                            <div class="text-left sm:text-right">

                                <p class="text-xs text-gray-500">
                                    Diajukan
                                </p>

                                <p class="mt-1 text-sm font-semibold">
                                    {{ $item->tanggal->format('d/m/Y H:i') }}
                                </p>

                            </div>

                        </div>


                        {{-- DETAIL --}}

                        <div
                            class="mt-5 overflow-hidden rounded-xl border border-gray-200 dark:border-white/10"
                        >

                            <div
                                class="grid grid-cols-3 bg-gray-50 px-4 py-3 text-xs font-semibold text-gray-500 dark:bg-white/5"
                            >

                                <div>
                                    Jenis Botol
                                </div>

                                <div>
                                    Jumlah
                                </div>

                                <div>
                                    Poin
                                </div>

                            </div>


                            @foreach($item->detailPenukaran as $detail)

                                <div
                                    class="grid grid-cols-3 border-t border-gray-200 px-4 py-3 text-sm dark:border-white/10"
                                >

                                    <div class="font-medium">

                                        {{ $detail->kategoriBotol->nama_kategori }}

                                        @if($detail->kategoriBotol->ukuran)
                                            <span class="text-gray-500">
                                                ({{ $detail->kategoriBotol->ukuran }})
                                            </span>
                                        @endif

                                    </div>

                                    <div>
                                        {{ $detail->jumlah_botol }} botol
                                    </div>

                                    <div class="font-bold text-green-500">
                                        +{{ number_format($detail->subtotal_poin, 0, ',', '.') }}
                                    </div>

                                </div>

                            @endforeach

                        </div>


                        {{-- FOOTER --}}

                        <div
                            class="mt-5 flex flex-col gap-4 border-t border-gray-200 pt-5 dark:border-white/10 sm:flex-row sm:items-center sm:justify-between"
                        >

                            <div>

                                <p class="text-xs text-gray-500">
                                    Total Poin
                                </p>

                                <p class="mt-1 text-xl font-black text-green-500">
                                    +{{ number_format($item->total_poin, 0, ',', '.') }}
                                </p>

                            </div>


                            <div class="flex gap-3">

                                {{-- TOLAK --}}

                                <form
                                    action="{{ route('admin.penukaran.tolak', $item->id) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Yakin ingin menolak pengajuan ini?')"
                                        class="rounded-xl border border-red-500/20 px-5 py-3 text-sm font-bold text-red-500 transition hover:bg-red-500/10"
                                    >
                                        Tolak
                                    </button>

                                </form>


                                {{-- SETUJUI --}}

                                <form
                                    action="{{ route('admin.penukaran.setujui', $item->id) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Yakin ingin menyetujui pengajuan ini? Poin akan ditambahkan ke saldo siswa.')"
                                        class="rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
                                    >
                                        Setujui
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @endif



        {{-- ================================================= --}}
        {{-- RIWAYAT --}}
        {{-- ================================================= --}}

        <div class="mt-12">

            <div class="mb-6">

                <h2 class="text-2xl font-black">
                    Riwayat Penukaran
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Riwayat penukaran offline maupun online.
                </p>

            </div>


            <div
                class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
            >

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

                                <tr class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]">

                                    {{-- SISWA --}}

                                    <td class="px-6 py-5">

                                        <p class="font-semibold">
                                            {{ $item->siswa->nama_lengkap }}
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $item->siswa->kode_siswa }}
                                        </p>

                                    </td>


                                    {{-- DETAIL --}}

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

                                    <td class="px-6 py-5 font-bold text-green-500">
                                        +{{ number_format($item->total_poin, 0, ',', '.') }}
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
                                                class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                                            >
                                                Disetujui
                                            </span>

                                        @elseif($item->status === 'ditolak')

                                            <span
                                                class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-500"
                                            >
                                                Ditolak
                                            </span>

                                        @else

                                            <span
                                                class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold text-yellow-600 dark:text-yellow-400"
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

    @endsection

