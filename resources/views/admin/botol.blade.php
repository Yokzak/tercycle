@extends('layouts.admin.app')

@section('title', 'Jenis Botol')

@section('topbar-subtitle', 'Management')

@section('topbar-title', 'Kategori Botol')

@section('content')

<div
    x-data="{
        bottleModal: false,
        deleteModal: false,
        deleteForm: null,

        successModal: false,
        errorModal: false,
        successMessage: '',
        errorMessage: '',

        showSuccess(message) {
            this.successMessage = message;
            this.successModal = true;

            setTimeout(() => {
                this.successModal = false;
            }, 2500);
        },

        showError(message) {
            this.errorMessage = message;
            this.errorModal = true;

            setTimeout(() => {
                this.errorModal = false;
            }, 3000);
        },

        confirmDelete(form) {
            this.deleteForm = form;
            this.deleteModal = true;
        },

        submitDelete() {
            if (this.deleteForm) {
                this.deleteForm.submit();
            }
        }
    }"
>

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div
        class="flex flex-col justify-between gap-5 sm:flex-row sm:items-center"
    >

        <div>

            <h2 class="text-2xl font-black">
                Kelola Kategori Botol
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Atur kategori botol dan jumlah poin yang diberikan.
            </p>

        </div>


        {{-- TAMBAH --}}

        <button
            type="button"
            @click="bottleModal = true"
            class="rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
        >
            + Tambah Kategori Botol
        </button>

    </div>


    {{-- ========================================================= --}}
    {{-- STATISTICS --}}
    {{-- ========================================================= --}}

    <div class="mt-8 grid gap-4 sm:grid-cols-3">

        <div
            class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
        >

            <p class="text-xs font-medium text-gray-500">
                Total Kategori
            </p>

            <p class="mt-2 text-3xl font-black">
                {{ $kategoriBotols->count() }}
            </p>

        </div>


        <div
            class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
        >

            <p class="text-xs font-medium text-gray-500">
                Total Ditukar
            </p>

            <p class="mt-2 text-3xl font-black">
                2.481
            </p>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- TABLE --}}
    {{-- ========================================================= --}}

    <div
        x-data="{
            search: '',
            page: 1,
            perPage: 5,

            data: @js($kategoriBotols->map(fn ($kategori) => [
                'id' => $kategori->id,
                'nama_kategori' => $kategori->nama_kategori,
                'ukuran' => $kategori->ukuran,
                'poin_satuan' => $kategori->poin_satuan,
            ])),

            get filteredData() {
                return this.data.filter(item => {
                    const keyword = this.search.toLowerCase();

                    return item.nama_kategori.toLowerCase().includes(keyword)
                        || item.ukuran.toLowerCase().includes(keyword);
                });
            },

            get totalPages() {
                return Math.max(
                    1,
                    Math.ceil(this.filteredData.length / this.perPage)
                );
            },

            get paginatedData() {
                const start = (this.page - 1) * this.perPage;

                return this.filteredData.slice(
                    start,
                    start + this.perPage
                );
            },

            get startItem() {
                if (this.filteredData.length === 0) {
                    return 0;
                }

                return (this.page - 1) * this.perPage + 1;
            },

            get endItem() {
                return Math.min(
                    this.page * this.perPage,
                    this.filteredData.length
                );
            },

            resetPage() {
                this.page = 1;
            }
        }"
        x-effect="
            if (page > totalPages) {
                page = totalPages;
            }
        "
        class="mt-8 overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-white/10 dark:bg-white/[0.03]"
    >

        {{-- TABLE HEADER --}}

        <div
            class="flex flex-col justify-between gap-4 border-b border-gray-200 px-6 py-5 sm:flex-row sm:items-center dark:border-white/10"
        >

            <div>

                <h3 class="font-bold">
                    Daftar Kategori Botol
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Data kategori botol yang tersedia.
                </p>

            </div>


            <div class="relative">

                <input
                    type="text"
                    x-model="search"
                    @input="resetPage()"
                    placeholder="Cari kategori botol..."
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 pl-10 text-sm outline-none focus:border-green-500 sm:w-64 dark:border-white/10 dark:bg-gray-900"
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

        </div>


        {{-- TABLE --}}

        <div class="overflow-x-auto">

            <table class="w-full text-left text-sm">

                <thead
                    class="border-b border-gray-200 text-xs uppercase text-gray-500 dark:border-white/10"
                >

                    <tr>

                        <th class="px-6 py-4">
                            Kategori Botol
                        </th>

                        <th class="px-6 py-4">
                            Ukuran
                        </th>

                        <th class="px-6 py-4">
                            Poin
                        </th>

                        <th class="px-6 py-4">
                            Total Ditukar
                        </th>

                        <th class="px-6 py-4 text-right">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody
                    class="divide-y divide-gray-200 dark:divide-white/10"
                >

                    @forelse ($kategoriBotols as $kategori)

                        <template
                            x-if="
                                '{{ strtolower($kategori->nama_kategori) }}'.includes(search.toLowerCase()) ||
                                '{{ strtolower($kategori->ukuran) }}'.includes(search.toLowerCase())
                            "
                        >

                            <tr
                                x-data="{
                                    edit: false,
                                    ukuran: @js($kategori->ukuran),
                                    poin: @js($kategori->poin_satuan)
                                }"
                                class="transition hover:bg-gray-50 dark:hover:bg-white/[0.02]"
                            >

                                {{-- KATEGORI --}}

                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-500/10 text-xl"
                                        >
                                            ♻
                                        </div>

                                        <div>

                                            <p class="font-semibold">
                                                {{ $kategori->nama_kategori }}
                                            </p>

                                            <p class="mt-1 text-xs text-gray-500">
                                                {{ strtoupper($kategori->ukuran) }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- UKURAN --}}

                                <td class="px-6 py-5 text-gray-500">

                                    <span
                                        x-show="!edit"
                                        x-text="ukuran"
                                    ></span>

                                    <input
                                        x-show="edit"
                                        x-model="ukuran"
                                        type="text"
                                        class="w-32 rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                                    >

                                </td>


                                {{-- POIN --}}

                                <td class="px-6 py-5">

                                    <span
                                        x-show="!edit"
                                        class="font-bold text-green-500"
                                    >
                                        {{ number_format($kategori->poin_satuan) }}
                                        poin
                                    </span>

                                    <input
                                        x-show="edit"
                                        x-model="poin"
                                        type="number"
                                        min="0"
                                        class="w-32 rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                                    >

                                </td>


                                {{-- TOTAL DITUKAR --}}

                                <td class="px-6 py-5 font-semibold">
                                    0
                                </td>


                                {{-- AKSI --}}

                                <td class="px-6 py-5">

                                    <div class="flex justify-end gap-2">

                                        {{-- FORM UPDATE --}}

                                        <form
                                            x-show="edit"
                                            action="{{ route('admin.botol.update', $kategori->id) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('PUT')

                                            <input
                                                type="hidden"
                                                name="ukuran"
                                                :value="ukuran"
                                            >

                                            <input
                                                type="hidden"
                                                name="poin_satuan"
                                                :value="poin"
                                            >

                                            <button
                                                type="submit"
                                                class="rounded-lg bg-green-500 px-3 py-2 text-xs font-bold text-gray-950 transition hover:bg-green-400"
                                            >
                                                Simpan
                                            </button>

                                        </form>


                                        {{-- EDIT --}}

                                        <button
                                            x-show="!edit"
                                            @click="edit = true"
                                            type="button"
                                            class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold transition hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                        >
                                            Edit
                                        </button>


                                        {{-- BATAL --}}

                                        <button
                                            x-show="edit"
                                            @click="
                                                edit = false;
                                                ukuran = @js($kategori->ukuran);
                                                poin = @js($kategori->poin_satuan);
                                            "
                                            type="button"
                                            class="rounded-lg border border-gray-200 px-3 py-2 text-xs font-semibold transition hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                        >
                                            Batal
                                        </button>


                                        {{-- HAPUS --}}

                                        <form
                                            x-show="!edit"
                                            action="{{ route('admin.botol.destroy', $kategori->id) }}"
                                            method="POST"
                                            x-ref="deleteForm{{ $kategori->id }}"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="button"
                                                @click="confirmDelete($refs.deleteForm{{ $kategori->id }})"
                                                class="rounded-lg border border-red-500/20 px-3 py-2 text-xs font-semibold text-red-500 transition hover:bg-red-500/10"
                                            >
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        </template>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="px-6 py-10 text-center text-sm text-gray-500"
                            >
                                Belum ada kategori botol.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}

        <div
            class="flex items-center justify-between border-t border-gray-200 px-6 py-4 dark:border-white/10"
        >

            <p class="text-xs text-gray-500">

                Menampilkan

                <span x-text="startItem"></span>

                -

                <span x-text="endItem"></span>

                dari

                <span x-text="filteredData.length"></span>

                kategori botol

            </p>


            <div class="flex items-center gap-2">

                <button
                    type="button"
                    @click="page--"
                    :disabled="page === 1"
                    :class="page === 1
                        ? 'cursor-not-allowed text-gray-300'
                        : 'text-gray-500 hover:bg-gray-100'"
                    class="rounded-lg border border-gray-200 px-3 py-2 text-xs dark:border-white/10"
                >
                    Sebelumnya
                </button>


                <template
                    x-for="number in totalPages"
                    :key="number"
                >

                    <button
                        type="button"
                        @click="page = number"
                        x-text="number"
                        :class="page === number
                            ? 'bg-green-500 font-bold text-gray-950'
                            : 'border border-gray-200 text-gray-500 dark:border-white/10'"
                        class="rounded-lg px-3 py-2 text-xs"
                    ></button>

                </template>


                <button
                    type="button"
                    @click="page++"
                    :disabled="page === totalPages"
                    :class="page === totalPages
                        ? 'cursor-not-allowed text-gray-300'
                        : 'text-gray-500 hover:bg-gray-100'"
                    class="rounded-lg border border-gray-200 px-3 py-2 text-xs dark:border-white/10"
                >
                    Selanjutnya
                </button>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MODAL TAMBAH KATEGORI BOTOL --}}
    {{-- ========================================================= --}}

    <div
        x-show="bottleModal"
        x-transition.opacity
        class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
        style="display: none;"
    >

        <div
            class="absolute inset-0"
            @click="bottleModal = false"
        ></div>


        <div
            x-show="bottleModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.stop
            class="relative w-full max-w-md rounded-2xl bg-white shadow-2xl dark:bg-gray-900"
        >

            {{-- HEADER --}}

            <div
                class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10"
            >

                <div>

                    <h2 class="text-lg font-bold">
                        Tambah Kategori Botol
                    </h2>

                    <p class="mt-1 text-xs text-gray-500">
                        Masukkan informasi kategori botol baru.
                    </p>

                </div>


                <button
                    type="button"
                    @click="bottleModal = false"
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

            <form
                action="{{ route('admin.botol.store') }}"
                method="POST"
                class="p-6"
            >

                @csrf


                {{-- NAMA --}}

                <div>

                    <label
                        for="nama_kategori"
                        class="mb-2 block text-sm font-semibold"
                    >
                        Nama Kategori Botol
                    </label>

                    <input
                        type="text"
                        id="nama_kategori"
                        name="nama_kategori"
                        required
                        placeholder="Contoh: Botol Plastik 600ml"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                    >

                </div>


                {{-- UKURAN --}}

                <div class="mt-5">

                    <label
                        for="ukuran"
                        class="mb-2 block text-sm font-semibold"
                    >
                        Ukuran / Kapasitas
                    </label>

                    <input
                        type="text"
                        id="ukuran"
                        name="ukuran"
                        required
                        placeholder="Contoh: 600 ml"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                    >

                </div>


                {{-- POIN --}}

                <div class="mt-5">

                    <label
                        for="poin_satuan"
                        class="mb-2 block text-sm font-semibold"
                    >
                        Poin per Botol
                    </label>

                    <div class="relative">

                        <input
                            type="number"
                            id="poin_satuan"
                            name="poin_satuan"
                            min="0"
                            required
                            placeholder="50"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 pr-16 text-sm outline-none transition placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-500/20 dark:border-white/10 dark:bg-gray-950"
                        >

                        <span
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-semibold text-gray-400"
                        >
                            poin
                        </span>

                    </div>

                </div>


                {{-- BUTTON --}}

                <div
                    class="mt-7 flex justify-end gap-3 border-t border-gray-200 pt-5 dark:border-white/10"
                >

                    <button
                        type="button"
                        @click="bottleModal = false"
                        class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-100 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/5"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
                    >
                        Simpan Jenis Botol
                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MODAL KONFIRMASI HAPUS --}}
    {{-- ========================================================= --}}

    <div
        x-show="deleteModal"
        x-transition.opacity
        class="fixed inset-0 z-[110] flex items-center justify-center bg-black/50 p-4 backdrop-blur-sm"
        style="display: none;"
    >

        <div
            class="absolute inset-0"
            @click="deleteModal = false"
        ></div>


        <div
            @click.stop
            class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900"
        >

            <div class="flex items-start gap-4">

                <div
                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-red-500/10 text-red-500"
                >
                    !
                </div>

                <div>

                    <h2 class="text-lg font-bold">
                        Hapus Kategori?
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Data kategori botol ini akan dihapus secara permanen.
                    </p>

                </div>

            </div>


            <div
                class="mt-6 flex justify-end gap-3 border-t border-gray-200 pt-5 dark:border-white/10"
            >

                <button
                    type="button"
                    @click="deleteModal = false"
                    class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-semibold dark:border-white/10"
                >
                    Batal
                </button>


                <button
                    type="button"
                    @click="submitDelete()"
                    class="rounded-xl bg-red-500 px-5 py-3 text-sm font-bold text-white transition hover:bg-red-600"
                >
                    Ya, Hapus
                </button>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- SUCCESS POPUP --}}
    {{-- ========================================================= --}}

    <div
        x-show="successModal"
        x-transition.opacity
        class="fixed right-5 top-5 z-[200] w-full max-w-sm"
        style="display: none;"
    >

        <div
            class="rounded-2xl border border-green-500/20 bg-white p-4 shadow-2xl dark:border-green-500/20 dark:bg-gray-900"
        >

            <div class="flex items-start gap-3">

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green-500/10 text-green-500"
                >
                    ✓
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
                    class="text-gray-400 hover:text-gray-900 dark:hover:text-white"
                >
                    ✕
                </button>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- ERROR POPUP --}}
    {{-- ========================================================= --}}

    <div
        x-show="errorModal"
        x-transition.opacity
        class="fixed right-5 top-5 z-[200] w-full max-w-sm"
        style="display: none;"
    >

        <div
            class="rounded-2xl border border-red-500/20 bg-white p-4 shadow-2xl dark:border-red-500/20 dark:bg-gray-900"
        >

            <div class="flex items-start gap-3">

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-500/10 text-red-500"
                >
                    !
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
                    class="text-gray-400 hover:text-gray-900 dark:hover:text-white"
                >
                    ✕
                </button>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- SESSION SUCCESS --}}
    {{-- ========================================================= --}}

    @if (session('success'))

        <div
            x-init="showSuccess(@js(session('success')))"
        ></div>

    @endif


    {{-- ========================================================= --}}
    {{-- SESSION ERROR --}}
    {{-- ========================================================= --}}

    @if (session('error'))

        <div
            x-init="showError(@js(session('error')))"
        ></div>

    @endif


    {{-- VALIDATION ERROR --}}

    @if ($errors->any())

        <div
            x-init="showError(@js($errors->first()))"
        ></div>

    @endif

</div>

@endsection