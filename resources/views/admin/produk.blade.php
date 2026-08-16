@extends('layouts.admin.app')

@section('title', 'Kelola Produk')

@section('topbar-subtitle', 'Kelola Produk')

@section('topbar-title', 'Produk')

@section('content')

<div x-data="kategoriProduk()">

        {{-- HEADER --}}

        <div
            class="flex flex-col justify-between gap-5 sm:flex-row sm:items-center"
        >

            <div>

                <h2 class="text-2xl font-black">
                    Kelola Produk
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Kelola produk yang dapat dibeli menggunakan poin.
                </p>

            </div>

        </div>



        {{-- STATISTICS --}}

        <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Total Produk
                </p>

                <p class="mt-2 text-3xl font-black">
                    {{ $totalProduk }}
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Produk Aktif
                </p>

                <p class="mt-2 text-3xl font-black text-green-500">
                    {{ $produkAktif }}
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Total Stok
                </p>

                <p class="mt-2 text-3xl font-black">
                    {{ number_format($totalStok, 0, ',', '.') }}
                </p>

            </div>


            <div
                class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
            >

                <p class="text-xs font-medium text-gray-500">
                    Terjual Bulan Ini
                </p>

                <p class="mt-2 text-3xl font-black">
                    {{ number_format($terjualBulanIni, 0, ',', '.') }}
                </p>

            </div>

        </div>



        {{-- FILTER --}}

        <div
            class="mt-8 flex flex-col gap-4 rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03] lg:flex-row lg:items-center lg:justify-between"
        >

            <div class="flex flex-col gap-3 sm:flex-row">

                <div class="relative">

                    <form
                        method="GET"
                        action="{{ route('admin.produk') }}"
                        class="relative"
                    >
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Cari produk..."
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 pl-10 text-sm outline-none focus:border-green-500 sm:w-64 dark:border-white/10 dark:bg-gray-900"
                            oninput="clearTimeout(window.searchTimer); window.searchTimer = setTimeout(() => this.form.submit(), 400)"
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

                <select
                    x-model="selectedCategory"
                    @change="filterProducts()"
                    class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm outline-none focus:border-green-500 dark:border-white/10 dark:bg-gray-900"
                >
                    <option value="">
                        Semua Kategori
                    </option>

                    <template x-for="kategori in categories" :key="kategori.id">
                        <option
                            :value="kategori.id"
                            x-text="kategori.nama_kategori"
                        ></option>
                    </template>
                </select>

            </div>


            <p class="text-xs text-gray-500">
                {{ $produks->total() }} produk ditemukan
            </p>

        </div>


        {{-- KATEGORI MANAGEMENT --}}

        <div class="mt-4 flex flex-col gap-4 rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03] lg:flex-row lg:items-center lg:justify-between">

            <div>
                <h3 class="font-bold">
                    Kategori Produk
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Lihat dan atur kategori produk.
                </p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">

                {{-- LIHAT KATEGORI --}}
                <button
                    type="button"
                    @click="loadCategories()"
                    class="rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold transition hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                >
                    Lihat Kategori
                </button>

                {{-- ATUR KATEGORI --}}
                <div class="relative">

                    <button
                        type="button"
                        @click="showCategoryOptions = !showCategoryOptions"
                        class="flex items-center gap-2 rounded-xl bg-green-500 px-4 py-2.5 text-sm font-bold text-gray-950 transition hover:bg-green-400"
                    >
                        Atur Kategori

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            class="h-4 w-4"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m6 9 6 6 6-6"
                            />
                        </svg>
                    </button>

                    {{-- DROPDOWN --}}
                    <div
                        x-show="showCategoryOptions"
                        x-transition
                        @click.outside="showCategoryOptions = false"
                        class="absolute right-0 top-full z-40 mt-2 w-52 rounded-xl border border-gray-200 bg-white p-2 shadow-xl dark:border-white/10 dark:bg-gray-900"
                        style="display: none;"
                    >

                        <button
                            type="button"
                            @click="
                                showCategoryOptions = false;
                                showAddCategoryModal = true;
                            "
                            class="w-full rounded-lg px-4 py-3 text-left text-sm font-medium transition hover:bg-gray-100 dark:hover:bg-white/5"
                        >
                            Tambah Kategori
                        </button>

                        <button
                            type="button"
                            @click="
                                showCategoryOptions = false;
                                loadCategories().then(() => {
                                    showCategoriesModal = false;
                                    showDeleteCategoryModal = true;
                                });
                            "
                            class="w-full rounded-lg px-4 py-3 text-left text-sm font-medium transition hover:bg-red-500/10"
                        >
                            Hapus Kategori
                        </button>

                    </div>

                </div>

            </div>
        </div>

        {{-- MODAL LIHAT KATEGORI --}}

        <div
            x-show="showCategoriesModal"
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
            style="display: none;"
        >
            <div
                class="absolute inset-0 bg-black/50 backdrop-blur-md"
                @click="showCategoriesModal = false"
            ></div>

            <div
                @click.stop
                class="relative w-full max-w-md rounded-2xl bg-white shadow-2xl dark:bg-gray-900"
            >

                <div class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10">
                    <div>
                        <h2 class="text-lg font-bold">
                            Daftar Kategori
                        </h2>

                        <p class="mt-1 text-xs text-gray-500">
                            Kategori produk yang tersedia.
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="showCategoriesModal = false"
                        class="text-gray-400 hover:text-gray-900 dark:hover:text-white"
                    >
                        ✕
                    </button>
                </div>

                {{-- SCROLL TANPA SCROLLBAR --}}
                <div class="no-scrollbar max-h-[60vh] space-y-2 overflow-y-auto p-6">

                    <template x-for="kategori in categories" :key="kategori.id">

                        <div class="rounded-xl border border-gray-200 px-4 py-3 dark:border-white/10">

                            <p
                                class="font-semibold"
                                x-text="kategori.nama_kategori"
                            ></p>

                            <p
                                class="mt-1 text-xs text-gray-500"
                                x-text="kategori.deskripsi || 'Tidak ada deskripsi.'"
                            ></p>

                        </div>

                    </template>

                    <template x-if="categories.length === 0">
                        <p class="py-6 text-center text-sm text-gray-500">
                            Belum ada kategori.
                        </p>
                    </template>

                </div>
            </div>
        </div>

        {{-- MODAL TAMBAH KATEGORI --}}

        <div
            x-show="showAddCategoryModal"
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
            style="display: none;"
        >
            <div
                class="absolute inset-0 bg-black/50 backdrop-blur-md"
                @click="showAddCategoryModal = false"
            ></div>

            <div
                @click.stop
                class="relative w-full max-w-md rounded-2xl bg-white shadow-2xl dark:bg-gray-900"
            >

                <div class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10">
                    <div>
                        <h2 class="text-lg font-bold">
                            Tambah Kategori
                        </h2>

                        <p class="mt-1 text-xs text-gray-500">
                            Tambahkan kategori produk baru.
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="showAddCategoryModal = false"
                        class="text-gray-400 hover:text-gray-900 dark:hover:text-white"
                    >
                        ✕
                    </button>
                </div>

                <form
                    action="{{ route('admin.kategori.store') }}"
                    method="POST"
                    @submit.prevent="openAddCategory()"
                    class="p-6"
                >
                    @csrf

                    <div>
                        <label
                            for="nama_kategori"
                            class="mb-2 block text-sm font-semibold"
                        >
                            Kategori
                        </label>

                        <input
                            type="text"
                            id="nama_kategori"
                            x-model="newCategory.nama_kategori"
                            placeholder="Contoh: Elektronik"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none focus:border-green-500 dark:border-white/10 dark:bg-gray-950"
                            required
                        >
                    </div>

                    <div class="mt-5">
                        <label
                            for="deskripsi_kategori"
                            class="mb-2 block text-sm font-semibold"
                        >
                            Deskripsi
                        </label>

                        <textarea
                            id="deskripsi_kategori"
                            x-model="newCategory.deskripsi"
                            rows="4"
                            placeholder="Deskripsi kategori..."
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm outline-none focus:border-green-500 dark:border-white/10 dark:bg-gray-950"
                        ></textarea>
                    </div>

                    <div class="mt-6 flex justify-end gap-3 border-t border-gray-200 pt-5 dark:border-white/10">

                        <button
                            type="button"
                            @click="showAddCategoryModal = false"
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

        {{-- MODAL HAPUS KATEGORI --}}

        <div
            x-show="showDeleteCategoryModal"
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
            style="display: none;"
        >
            <div
                class="absolute inset-0 bg-black/50 backdrop-blur-md"
                @click="showDeleteCategoryModal = false"
            ></div>

            <div
                @click.stop
                class="relative w-full max-w-md rounded-2xl bg-white shadow-2xl dark:bg-gray-900"
            >

                <div class="flex items-center justify-between border-b border-gray-200 px-6 py-5 dark:border-white/10">
                    <div>
                        <h2 class="text-lg font-bold">
                            Hapus Kategori
                        </h2>

                        <p class="mt-1 text-xs text-gray-500">
                            Pilih kategori yang ingin dihapus.
                        </p>
                    </div>

                    <button
                        type="button"
                        @click="showDeleteCategoryModal = false"
                        class="text-gray-400 hover:text-gray-900 dark:hover:text-white"
                    >
                        ✕
                    </button>
                </div>

                <form
                    @submit.prevent="deleteCategories"
                    class="p-6"
                >
                    <div class="max-h-72 space-y-3 overflow-y-auto">

                        <template
                            x-for="kategori in categories"
                            :key="kategori.id"
                        >
                            <label
                                class="flex cursor-pointer items-center gap-3 rounded-xl border border-gray-200 px-4 py-3 transition hover:bg-gray-50 dark:border-white/10 dark:hover:bg-white/5"
                            >
                                <input
                                    type="checkbox"
                                    :value="kategori.id"
                                    x-model="selectedCategories"
                                    class="h-4 w-4 rounded border-gray-300 text-green-500 focus:ring-green-500"
                                >

                                <div>
                                    <p
                                        class="text-sm font-semibold"
                                        x-text="kategori.nama_kategori"
                                    ></p>

                                    <p
                                        class="mt-1 text-xs text-gray-500"
                                        x-text="kategori.deskripsi || 'Tidak ada deskripsi.'"
                                    ></p>
                                </div>
                            </label>
                        </template>

                        <template x-if="categories.length === 0">
                            <p class="py-6 text-center text-sm text-gray-500">
                                Belum ada kategori.
                            </p>
                        </template>

                    </div>

                    <div
                        class="mt-6 flex justify-end border-t border-gray-200 pt-5 dark:border-white/10"
                    >
                        <button
                            type="button"
                            @click="openDeleteCategory()"
                            :disabled="selectedCategories.length === 0 || deletingCategories"
                            class="rounded-xl bg-red-500 px-5 py-3 text-sm font-bold text-white transition hover:bg-red-600 disabled:cursor-not-allowed disabled:opacity-50"
                        >
                            <span x-show="!deletingCategories">
                                Hapus
                            </span>

                            <span x-show="deletingCategories">
                                Menghapus...
                            </span>
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <x-confirm-category-modal
            title="Hapus Kategori?"
            message="Kategori ini akan dihapus secara permanen."
            confirm-text="Hapus"
            confirm-action="confirmDeleteCategory()"
            state="showConfirmDeleteCategory"
            confirm-class="bg-red-500 hover:bg-red-600 text-white"
        />

        <x-confirm-category-modal
            title="Simpan Kategori?"
            message="Yakin ingin menambahkan kategori ini?"
            confirm-text="Simpan"
            confirm-action="confirmAddCategory()"
            state="showConfirmAddCategory"
            confirm-class="bg-green-500 hover:bg-green-400 text-gray-950"
        />

        <x-success-category-modal
            state="showSuccessModal"
            message="successMessage"
        />

        <x-error-category-modal
            state="showErrorModal"
            message="errorMessage"
        />

        {{-- POPUP DARI SESSION LARAVEL --}}
        @if (session('success'))
            <div
                x-init="showSuccess(@js(session('success')))"
            ></div>
        @endif

        @if (session('error'))
            <div
                x-init="showError(@js(session('error')))"
            ></div>
        @endif


        <div class="mx-auto mt-6 grid max-w-6xl items-center gap-5 sm:grid-cols-2 xl:grid-cols-3">

            @forelse ($produks as $produk)

                <div
                    class="overflow-hidden rounded-2xl border border-gray-200 bg-white transition hover:-translate-y-1 hover:border-green-500/30 dark:border-white/10 dark:bg-white/[0.03]"
                >

                    <div class="flex h-48 items-center justify-center bg-gray-100 dark:bg-white/5">

                        @if ($produk->gambar)
                            <img
                                src="{{ asset('storage/' . $produk->gambar) }}"
                                alt="{{ $produk->nama_produk }}"
                                class="h-full w-full object-cover"
                            >
                        @else
                            <div class="text-7xl">
                                📦
                            </div>
                        @endif

                    </div>


                    <div class="p-5">

                        <div class="flex items-start justify-between gap-3">

                            <div>

                                <p class="text-xs font-medium text-green-500">
                                    {{ $produk->kategoriProduk->nama_kategori ?? 'Tanpa Kategori' }}
                                </p>

                                <h3 class="mt-1 font-bold">
                                    {{ $produk->nama_produk }}
                                </h3>

                            </div>


                            @if ($produk->status_approval === 'menunggu')

                                <span class="rounded-full bg-yellow-500/10 px-2.5 py-1 text-[11px] font-semibold text-yellow-500">Menunggu</span>

                            @elseif ($produk->status_approval === 'disetujui')

                                @if ($produk->status === 'tersedia')
                                    <span class="rounded-full bg-green-500/10 px-2.5 py-1 text-[11px] font-semibold text-green-500">Disetujui</span>
                                @else
                                    <span class="rounded-full bg-gray-500/10 px-2.5 py-1 text-[11px] font-semibold text-gray-500">Tidak Tersedia</span>
                                @endif

                            @elseif ($produk->status_approval === 'ditolak')

                                <span class="rounded-full bg-red-500/10 px-2.5 py-1 text-[11px] font-semibold text-red-500">Ditolak</span>

                            @endif

                        </div>


                        <p class="mt-3 text-sm text-gray-500">
                            {{ $produk->deskripsi }}
                        </p>


                        <div class="mt-5 flex items-end justify-between">

                            <div>

                                <p class="text-xs text-gray-500">
                                    Harga
                                </p>

                                <p class="mt-1 text-xl font-black text-green-500">
                                    {{ number_format($produk->harga_poin, 0, ',', '.') }}
                                    poin
                                </p>

                            </div>


                            <div class="text-right">

                                <p class="text-xs text-gray-500">
                                    Stok
                                </p>

                                <p class="mt-1 font-bold">
                                    {{ $produk->stok }}
                                </p>

                            </div>

                        </div>


                        @if ($produk->status_approval === 'menunggu')

                            <div class="mt-5 flex gap-2 border-t border-gray-200 pt-4 dark:border-white/10">

                                <button
                                    type="button"
                                    onclick="openApproveModal(
                                        '{{ route('admin.produk.approve', $produk) }}',
                                        '{{ addslashes($produk->nama_produk) }}'
                                    )"
                                    class="flex-1 rounded-lg border border-gray-200 py-2 text-xs font-semibold hover:bg-gray-100 dark:border-white/10 dark:hover:bg-white/5"
                                >
                                    Terima
                                </button>

                                <button
                                    type="button"
                                    onclick="openRejectModal(
                                        '{{ route('admin.produk.reject', $produk) }}',
                                        '{{ addslashes($produk->nama_produk) }}'
                                    )"
                                    class="rounded-lg border border-red-500/20 px-4 py-2 text-xs font-semibold text-red-500 hover:bg-red-500/10"
                                >
                                    Tolak
                                </button>

                            </div>

                        @endif

                    </div>

                </div>

            @empty

                <div class="col-span-full py-16 text-center">

                    <p class="text-sm text-gray-500">
                        Tidak ada produk ditemukan.
                    </p>

                </div>

            @endforelse

        </div>


        <div
            id="approveModal"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4"
        >

            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

            <div class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900">

                <h2 class="text-lg font-bold">
                    Terima Produk?
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Apakah kamu yakin ingin menerima produk
                    <strong id="approveProductName"></strong>?
                    Produk akan ditampilkan sebagai produk tersedia.
                </p>

                <form
                    id="approveForm"
                    method="POST"
                    class="mt-6 flex justify-end gap-3"
                >

                    @csrf
                    @method('PATCH')

                    <button
                        type="button"
                        onclick="closeApproveModal()"
                        class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-semibold dark:border-white/10"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950"
                    >
                        Ya, Terima
                    </button>

                </form>

            </div>

        </div>


        <div
            id="rejectModal"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4"
        >

            <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

            <div class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900">

                <h2 class="text-lg font-bold">
                    Tolak Produk?
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Produk
                    <strong id="rejectProductName"></strong>
                    akan dihapus secara permanen setelah ditolak.
                </p>

                <form
                    id="rejectForm"
                    method="POST"
                    class="mt-6 flex justify-end gap-3"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="button"
                        onclick="closeRejectModal()"
                        class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-semibold dark:border-white/10"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="rounded-xl bg-red-500 px-5 py-3 text-sm font-bold text-white"
                    >
                        Ya, Tolak & Hapus
                    </button>

                </form>

            </div>

        </div>


        {{-- PAGINATION --}}

        <div class="mt-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <p class="text-xs text-gray-500">
                Menampilkan
                {{ $produks->firstItem() ?? 0 }}
                -
                {{ $produks->lastItem() ?? 0 }}
                dari
                {{ $produks->total() }}
                produk
            </p>


            <div>
                {{ $produks->links() }}
            </div>

        </div>

</div>

@endsection


<script>
    window.kategoriProdukRoutes = {
        index: @json(route('admin.kategori.index')),
        store: @json(route('admin.kategori.store')),
        destroy: @json(route('admin.kategori.destroy')),
        csrf: @json(csrf_token())
    };
</script>