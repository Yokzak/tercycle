@extends('layouts.siswa.app')

@section('title', 'Pencairan Dana')

@section('content')

<div
    x-data="pencairanDana()"
    class="space-y-8"
>

    {{-- HEADER --}}
    <div>
        <p class="text-sm font-medium text-green-500">
            Keuangan
        </p>

        <h1 class="mt-1 text-2xl font-black">
            Pencairan Dana
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Cairkan poin yang kamu miliki menjadi uang tunai.
        </p>
    </div>


    {{-- SALDO --}}
    <div class="grid gap-5 lg:grid-cols-3">

        {{-- SALDO POIN --}}
        <div
            class="rounded-2xl bg-green-500 p-6 text-gray-950 lg:col-span-2"
        >
            <div class="flex items-start justify-between">

                <div>
                    <p class="text-sm font-medium opacity-70">
                        Saldo Poin Saat Ini
                    </p>

                    {{-- NANTI HUBUNGKAN KE DATABASE --}}
                    <h2 class="mt-2 text-4xl font-black">
                        12.500
                        <span class="text-lg">
                            poin
                        </span>
                    </h2>

                    <p class="mt-3 text-sm font-medium opacity-70">
                        Estimasi nilai saldo
                    </p>

                    <p class="text-xl font-black">
                        Rp1.250.000
                    </p>
                </div>

                <div
                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-black/10"
                >
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
                            d="M12 6v12m-4-4 4 4 4-4M8 8l4-4 4 4"
                        />
                    </svg>
                </div>

            </div>
        </div>


        {{-- NILAI KONVERSI --}}
        <div
            class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
        >
            <p class="text-xs font-medium text-gray-500">
                Nilai Konversi
            </p>

            <p class="mt-3 text-2xl font-black">
                100 poin
            </p>

            <p class="mt-1 text-sm text-gray-500">
                = Rp10.000
            </p>

            <div
                class="mt-5 rounded-xl bg-gray-50 p-4 text-xs text-gray-500 dark:bg-white/5"
            >
                Nilai konversi dapat disesuaikan oleh administrator.
            </div>
        </div>

    </div>


    {{-- FORM + KETENTUAN --}}
    <div class="grid gap-6 lg:grid-cols-3">

        {{-- FORM PENCAIRAN --}}
        <div
            class="rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03] lg:col-span-2"
        >

            <div
                class="border-b border-gray-200 px-6 py-5 dark:border-white/10"
            >
                <h2 class="font-bold">
                    Ajukan Pencairan
                </h2>

                <p class="mt-1 text-xs text-gray-500">
                    Isi data pencairan dengan benar.
                </p>
            </div>


            <div class="space-y-6 p-6">

                {{-- JUMLAH POIN --}}
                <div>

                    <label
                        class="mb-2 block text-sm font-semibold"
                    >
                        Jumlah Poin
                    </label>

                    <div class="relative">

                        <input
                            type="number"
                            min="1000"
                            step="100"
                            x-model.number="points"
                            @input="calculateAmount()"
                            placeholder="Masukkan jumlah poin"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 pr-20 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                        >

                        <span
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-semibold text-gray-400"
                        >
                            poin
                        </span>

                    </div>


                    {{-- QUICK AMOUNT --}}
                    <div class="mt-3 flex flex-wrap gap-2">

                        <button
                            type="button"
                            @click="setPoints(1000)"
                            class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold transition hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                        >
                            1.000
                        </button>

                        <button
                            type="button"
                            @click="setPoints(5000)"
                            class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold transition hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                        >
                            5.000
                        </button>

                        <button
                            type="button"
                            @click="setPoints(10000)"
                            class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold transition hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                        >
                            10.000
                        </button>

                        <button
                            type="button"
                            @click="setPoints(12500)"
                            class="rounded-lg border border-green-500/20 bg-green-500/10 px-3 py-2 text-xs font-semibold text-green-500 transition hover:bg-green-500/20"
                        >
                            Semua Poin
                        </button>

                    </div>

                </div>


                {{-- ESTIMASI --}}
                <div
                    class="rounded-xl bg-gray-50 p-5 dark:bg-white/5"
                >

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-xs text-gray-500">
                                Poin yang dicairkan
                            </p>

                            <p
                                class="mt-1 text-lg font-black"
                                x-text="formatNumber(points) + ' poin'"
                            >
                                0 poin
                            </p>
                        </div>

                        <div class="text-right">

                            <p class="text-xs text-gray-500">
                                Dana diterima
                            </p>

                            <p
                                class="mt-1 text-xl font-black text-green-500"
                                x-text="formatRupiah(amount)"
                            >
                                Rp0
                            </p>

                        </div>

                    </div>

                </div>


                {{-- METODE --}}

                <div>

                    <label class="mb-3 block text-sm font-semibold">
                        Metode Pencairan
                    </label>

                    <div class="grid gap-3 sm:grid-cols-2">

                        {{-- DANA --}}
                        <button
                            type="button"
                            @click="
                                method = 'DANA';
                                destination = '';
                            "
                            :class="method === 'DANA'
                                ? 'border-green-500 bg-green-500/10'
                                : 'border-gray-200 dark:border-white/10'"
                            class="rounded-xl border p-4 text-left transition hover:bg-gray-50 dark:hover:bg-white/5"
                        >
                            <p class="font-bold">
                                DANA
                            </p>

                            <p class="mt-1 text-xs text-gray-500">
                                Dompet digital
                            </p>
                        </button>


                        {{-- GOPAY --}}
                        <button
                            type="button"
                            @click="
                                method = 'GoPay';
                                destination = '';
                            "
                            :class="method === 'GoPay'
                                ? 'border-green-500 bg-green-500/10'
                                : 'border-gray-200 dark:border-white/10'"
                            class="rounded-xl border p-4 text-left transition hover:bg-gray-50 dark:hover:bg-white/5"
                        >
                            <p class="font-bold">
                                GoPay
                            </p>

                            <p class="mt-1 text-xs text-gray-500">
                                Dompet digital
                            </p>
                        </button>


                        {{-- SHOPEEPAY --}}
                        <button
                            type="button"
                            @click="
                                method = 'ShopeePay';
                                destination = '';
                            "
                            :class="method === 'ShopeePay'
                                ? 'border-green-500 bg-green-500/10'
                                : 'border-gray-200 dark:border-white/10'"
                            class="rounded-xl border p-4 text-left transition hover:bg-gray-50 dark:hover:bg-white/5"
                        >
                            <p class="font-bold">
                                ShopeePay
                            </p>

                            <p class="mt-1 text-xs text-gray-500">
                                Dompet digital
                            </p>
                        </button>


                        {{-- CASH --}}
                        <button
                            type="button"
                            @click="
                                method = 'Cash';
                                destination = '';
                            "
                            :class="method === 'Cash'
                                ? 'border-green-500 bg-green-500/10'
                                : 'border-gray-200 dark:border-white/10'"
                            class="rounded-xl border p-4 text-left transition hover:bg-gray-50 dark:hover:bg-white/5"
                        >
                            <p class="font-bold">
                                Uang Cash
                            </p>

                            <p class="mt-1 text-xs text-gray-500">
                                Ambil langsung
                            </p>
                        </button>

                    </div>

                </div>


                {{-- NOMOR TUJUAN --}}
                <div
                    x-show="method !== 'Cash'"
                    x-transition
                >

                    <label class="mb-2 block text-sm font-semibold">
                        Nomor Penerima
                    </label>

                    <input
                        type="text"
                        x-model="destination"
                        placeholder="Contoh: 081234567890"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                    >

                    <p class="mt-2 text-xs text-gray-500">
                        Masukkan nomor akun <span x-text="method"></span> yang akan menerima dana.
                    </p>

                </div>


                {{-- INFORMASI CASH --}}
                <div
                    x-show="method === 'Cash'"
                    x-transition
                    class="rounded-xl border border-green-500/20 bg-green-500/10 p-4"
                >

                    <div class="flex gap-3">

                        <div class="mt-0.5 text-green-500">
                            !
                        </div>

                        <div>
                            <p class="text-sm font-semibold">
                                Pencairan Uang Cash
                            </p>

                            <p class="mt-1 text-xs text-gray-500">
                                Dana akan dicairkan secara tunai dan dapat diambil
                                sesuai prosedur yang ditentukan oleh admin.
                            </p>
                        </div>

                    </div>

                </div>

                {{-- SUBMIT --}}
                <div
                    class="border-t border-gray-200 pt-6 dark:border-white/10"
                >

                    <button
                        type="button"
                        @click="openConfirm()"
                        class="w-full rounded-xl bg-green-500 px-5 py-3.5 text-sm font-bold text-gray-950 transition hover:bg-green-400"
                    >
                        Ajukan Pencairan
                    </button>

                </div>

            </div>

        </div>


        {{-- KETENTUAN --}}
        <div
            class="h-fit rounded-2xl border border-gray-200 bg-white p-6 dark:border-white/10 dark:bg-white/[0.03]"
        >

            <div class="flex items-center gap-3">

                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-500/10 text-green-500"
                >
                    !
                </div>

                <div>
                    <h3 class="font-bold">
                        Ketentuan Pencairan
                    </h3>

                    <p class="text-xs text-gray-500">
                        Harap diperhatikan.
                    </p>
                </div>

            </div>


            <div class="mt-5 space-y-4">

                <div class="flex gap-3">
                    <span class="mt-0.5 text-green-500">✓</span>

                    <p class="text-sm text-gray-500">
                        Minimal pencairan adalah
                        <strong class="text-gray-900 dark:text-white">
                            1.000 poin
                        </strong>.
                    </p>
                </div>


                <div class="flex gap-3">
                    <span class="mt-0.5 text-green-500">✓</span>

                    <p class="text-sm text-gray-500">
                        Pengajuan akan diperiksa oleh admin.
                    </p>
                </div>


                <div class="flex gap-3">
                    <span class="mt-0.5 text-green-500">✓</span>

                    <p class="text-sm text-gray-500">
                        Pastikan nama penerima sudah benar.
                    </p>
                </div>


                <div class="flex gap-3">
                    <span class="mt-0.5 text-green-500">✓</span>

                    <p class="text-sm text-gray-500">
                        Poin akan diproses sesuai status pengajuan.
                    </p>
                </div>

            </div>

        </div>

    </div>


    {{-- RIWAYAT --}}
    <div
        class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
    >

        <div
            class="border-b border-gray-200 px-6 py-5 dark:border-white/10"
        >

            <h2 class="font-bold">
                Riwayat Pencairan
            </h2>

            <p class="mt-1 text-xs text-gray-500">
                Riwayat pengajuan pencairan dana kamu.
            </p>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead
                    class="border-b border-gray-200 text-xs uppercase text-gray-500 dark:border-white/10"
                >

                    <tr>

                        <th class="px-6 py-4">
                            Tanggal
                        </th>

                        <th class="px-6 py-4">
                            Poin
                        </th>

                        <th class="px-6 py-4">
                            Metode
                        </th>

                        <th class="px-6 py-4">
                            Nominal
                        </th>

                        <th class="px-6 py-4">
                            Status
                        </th>

                    </tr>

                </thead>


                <tbody
                    class="divide-y divide-gray-200 dark:divide-white/10"
                >

                    {{-- DATA CONTOH --}}
                    <tr class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]">

                        <td class="px-6 py-5 text-gray-500">
                            16 Agu 2026
                        </td>

                        <td class="px-6 py-5 font-semibold">
                            10.000 poin
                        </td>

                        <td class="px-6 py-5">
                            DANA
                        </td>

                        <td class="px-6 py-5 font-bold text-green-500">
                            Rp1.000.000
                        </td>

                        <td class="px-6 py-5">

                            <span
                                class="rounded-full bg-yellow-500/10 px-3 py-1 text-xs font-semibold text-yellow-500"
                            >
                                Menunggu
                            </span>

                        </td>

                    </tr>


                    <tr class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]">

                        <td class="px-6 py-5 text-gray-500">
                            10 Agu 2026
                        </td>

                        <td class="px-6 py-5 font-semibold">
                            5.000 poin
                        </td>

                        <td class="px-6 py-5">
                            Cash
                        </td>

                        <td class="px-6 py-5 font-bold text-green-500">
                            Rp500.000
                        </td>

                        <td class="px-6 py-5">

                            <span
                                class="rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-500"
                            >
                                Berhasil
                            </span>

                        </td>

                    </tr>


                    <tr class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]">

                        <td class="px-6 py-5 text-gray-500">
                            3 Agu 2026
                        </td>

                        <td class="px-6 py-5 font-semibold">
                            2.000 poin
                        </td>

                        <td class="px-6 py-5">
                            OVO
                        </td>

                        <td class="px-6 py-5 font-bold text-green-500">
                            Rp200.000
                        </td>

                        <td class="px-6 py-5">

                            <span
                                class="rounded-full bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-500"
                            >
                                Ditolak
                            </span>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MODAL ERROR --}}
    {{-- ========================================================= --}}

    <div
        x-show="errorModal"
        x-transition.opacity
        class="fixed inset-0 z-[120] flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
        style="display: none;"
    >

        <div
            class="absolute inset-0"
            @click="errorModal = false"
        ></div>


        <div
            x-show="errorModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            @click.stop
            class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900"
        >

            <div class="flex items-start gap-4">

                <div
                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-500/10 text-red-500"
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
                            d="M12 9v3.75m0 3h.01M10.29 3.86 2.82 17a2 2 0 0 0 1.74 3h14.88a2 2 0 0 0 1.74-3L13.71 3.86a2 2 0 0 0-3.42 0Z"
                        />
                    </svg>
                </div>

                <div>
                    <h2 class="text-lg font-bold">
                        Pengajuan Tidak Dapat Dilanjutkan
                    </h2>

                    <p
                        class="mt-2 text-sm text-gray-500"
                        x-text="errorMessage"
                    ></p>
                </div>

            </div>


            <button
                type="button"
                @click="errorModal = false"
                class="mt-6 w-full rounded-xl bg-red-500 px-5 py-3 text-sm font-bold text-white transition hover:bg-red-400"
            >
                Mengerti
            </button>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MODAL KONFIRMASI --}}
    {{-- ========================================================= --}}

    <div
        x-show="confirmModal"
        x-transition.opacity
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
        style="display: none;"
    >

        <div
            class="absolute inset-0"
            @click="confirmModal = false"
        ></div>


        <div
            x-show="confirmModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            @click.stop
            class="relative w-full max-w-md rounded-2xl bg-white shadow-2xl dark:bg-gray-900"
        >

            <div
                class="border-b border-gray-200 px-6 py-5 dark:border-white/10"
            >

                <h2 class="text-lg font-bold">
                    Konfirmasi Pencairan
                </h2>

                <p class="mt-1 text-xs text-gray-500">
                    Periksa kembali data pencairan kamu.
                </p>

            </div>


            <div class="space-y-4 p-6">

                <div class="flex justify-between">
                    <span class="text-sm text-gray-500">
                        Poin
                    </span>

                    <span
                        class="font-bold"
                        x-text="formatNumber(points) + ' poin'"
                    ></span>
                </div>


                <div class="flex justify-between">
                    <span class="text-sm text-gray-500">
                        Dana
                    </span>

                    <span
                        class="font-bold text-green-500"
                        x-text="formatRupiah(amount)"
                    ></span>
                </div>


                <div class="flex justify-between">
                    <span class="text-sm text-gray-500">
                        Metode
                    </span>

                    <span
                        class="font-semibold"
                        x-text="method"
                    ></span>
                </div>


                <div class="flex justify-between gap-5">
                    <span class="text-sm text-gray-500">
                        Penerima
                    </span>

                    <span
                        class="text-right font-semibold"
                        x-text="destination || '-'"
                    ></span>
                </div>

            </div>


            <div
                class="flex justify-end gap-3 border-t border-gray-200 px-6 py-5 dark:border-white/10"
            >

                <button
                    type="button"
                    @click="confirmModal = false"
                    class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-semibold dark:border-white/10"
                >
                    Batal
                </button>


                {{-- NANTI HUBUNGKAN KE FORM / ROUTE BACKEND --}}
                <button
                    type="button"
                    @click="submitPencairan()"
                    class="rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950"
                >
                    Konfirmasi Pencairan
                </button>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MODAL BERHASIL --}}
    {{-- ========================================================= --}}

    <div
        x-show="successModal"
        x-transition.opacity
        class="fixed inset-0 z-[110] flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
        style="display: none;"
    >

        <div
            class="absolute inset-0"
            @click="successModal = false"
        ></div>


        <div
            x-show="successModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            @click.stop
            class="relative w-full max-w-md rounded-2xl bg-white p-6 text-center shadow-2xl dark:bg-gray-900"
        >

            <div
                class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-green-500/10 text-green-500"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2"
                    stroke="currentColor"
                    class="h-7 w-7"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m5 12 4 4L19 6"
                    />
                </svg>
            </div>

            <h2 class="mt-4 text-lg font-bold">
                Pengajuan Berhasil
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                Pengajuan pencairan kamu berhasil dibuat dan sedang menunggu pemeriksaan admin.
            </p>

            <button
                type="button"
                @click="successModal = false"
                class="mt-6 w-full rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950"
            >
                Mengerti
            </button>

        </div>

    </div>

</div>


<script>
    function pencairanDana() {
        return {

            // ==========================================
            // DATA SEMENTARA
            // NANTI TEMEN LU GANTI DENGAN DATABASE
            // ==========================================

            points: 0,

            balance: 12500,

            // 100 poin = Rp10.000
            conversionRate: 100,

            amount: 0,

            method: 'DANA',

            destination: '',

            confirmModal: false,

            successModal: false,

            errorModal: false,

            errorMessage: '',


            // ==========================================
            // HITUNG NOMINAL
            // ==========================================

            calculateAmount() {

                if (!this.points || this.points < 0) {
                    this.amount = 0;
                    return;
                }

                this.amount =
                    Math.floor(this.points / this.conversionRate) * 10000;
            },


            // ==========================================
            // QUICK POINT
            // ==========================================

            setPoints(value) {

                if (value > this.balance) {
                    value = this.balance;
                }

                this.points = value;

                this.calculateAmount();
            },


            // ==========================================
            // FORMAT ANGKA
            // ==========================================

            formatNumber(value) {

                return new Intl.NumberFormat('id-ID')
                    .format(value || 0);
            },


            // ==========================================
            // FORMAT RUPIAH
            // ==========================================

            formatRupiah(value) {

                return new Intl.NumberFormat(
                    'id-ID',
                    {
                        style: 'currency',
                        currency: 'IDR',
                        maximumFractionDigits: 0
                    }
                ).format(value || 0);
            },

            showError(message) {

                this.errorMessage = message;

                this.errorModal = true;
            },

            openConfirm() {

                if (!this.points || this.points < 1000) {

                    this.showError(
                        'Minimal pencairan adalah 1.000 poin.'
                    );

                    return;
                }


                if (this.points > this.balance) {

                    this.showError(
                        'Jumlah poin melebihi saldo kamu.'
                    );

                    return;
                }


                if (!this.destination.trim()) {

                    this.showError(
                        'Nama penerima wajib diisi.'
                    );

                    return;
                }


                this.calculateAmount();

                this.confirmModal = true;
            },


            submitPencairan() {

                this.confirmModal = false;

                this.successModal = true;
            }

        }
    }
</script>

@endsection