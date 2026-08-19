@extends('layouts.siswa.app')

@section('title', 'Setor Botol')

@section('topbar-subtitle', 'Menu')

@section('topbar-title', 'Tukar Botol')

@section('content')

        <div class="mb-8">

            <p class="text-sm font-medium text-green-500">
                Setor Sampah
            </p>

            <h2 class="mt-2 text-3xl font-black">
                Tukarkan Botolmu
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Masukkan jumlah sampah yang ingin kamu setorkan.
            </p>

        </div>



        {{-- ================================================= --}}
        {{-- INFO --}}
        {{-- ================================================= --}}

        <div
            class="mb-6 flex gap-4 rounded-2xl border border-green-500/20 bg-green-500/5 p-5"
        >

            <div
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green-500/10 font-bold text-green-500"
            >
                i
            </div>

            <div>

                <p class="text-sm font-semibold">
                    Bagaimana cara setor?
                </p>

                <p class="mt-1 text-xs leading-5 text-gray-500">
                    Pilih jenis botol, masukkan jumlahnya, lalu ajukan
                    penukaran. Bawa sampah tersebut ke admin untuk
                    diverifikasi.
                </p>

            </div>

        </div>



       <div
    x-data="{
        items: [
            @foreach ($kategoriBotol as $kategori)
                {
                    id: {{ $kategori->id }},
                    nama: @js($kategori->nama_kategori),
                    poin: {{ $kategori->poin_satuan }},
                    jumlah: 0
                },
            @endforeach
        ],

        catatan: '',

        get totalBotol() {
            return this.items.reduce(
                (total, item) => total + Number(item.jumlah),
                0
            );
        },

        get totalPoin() {
            return this.items.reduce(
                (total, item) =>
                    total + (Number(item.jumlah) * Number(item.poin)),
                0
            );
        },

        tambah(index) {
            this.items[index].jumlah++;
        },

        kurang(index) {
            if (this.items[index].jumlah > 0) {
                this.items[index].jumlah--;
            }
        }
    }"
>

    <form
        action="{{ route('siswa.tukar.store') }}"
        method="POST"
    >
        @csrf

        <div class="grid gap-6 lg:grid-cols-3">

            {{-- ============================================= --}}
            {{-- JENIS BOTOL --}}
            {{-- ============================================= --}}

            <div class="space-y-4 lg:col-span-2">

                <div
                    class="rounded-2xl border border-gray-200 bg-white p-6
                    dark:border-white/10 dark:bg-white/[0.03]"
                >

                    <div class="mb-6">

                        <h3 class="font-bold">
                            Jenis Botol
                        </h3>

                       
                    </div>


                    {{-- LOOP KATEGORI BOTOL --}}

                    <template
                        x-for="(item, index) in items"
                        :key="item.id"
                    >
                        <div
                            class="flex flex-col gap-4 border-b
                            border-gray-200 py-5 last:border-0
                            dark:border-white/10
                            sm:flex-row sm:items-center
                            sm:justify-between"
                        >

                            {{-- ID KATEGORI --}}
                            <input
                                type="hidden"
                                :name="'botol[' + index + '][kategori_botol_id]'"
                                :value="item.id"
                                :disabled="item.jumlah === 0"
                            >

                            {{-- INFO BOTOL --}}
                            <div class="flex items-center gap-4">

                                <div
                                    class="flex h-12 w-12 shrink-0
                                    items-center justify-center
                                    rounded-xl bg-green-500/10
                                    text-green-500"
                                >
                                    ♻
                                </div>

                                <div>

                                    <p
                                        class="font-semibold"
                                        x-text="item.nama"
                                    ></p>

                                    <p class="mt-1 text-xs text-gray-500">

                                        <span
                                            x-text="Number(item.poin).toLocaleString('id-ID')"
                                        ></span>

                                        poin / botol

                                    </p>

                                </div>

                            </div>


                            {{-- JUMLAH --}}
                            <div class="flex items-center gap-3">

                                {{-- MINUS --}}
                                <button
                                    type="button"
                                    @click="kurang(index)"
                                    class="flex h-9 w-9 items-center
                                    justify-center rounded-lg
                                    border border-gray-200
                                    text-lg text-gray-500
                                    transition hover:border-green-500
                                    hover:text-green-500
                                    dark:border-white/10"
                                >
                                    -
                                </button>


                                {{-- JUMLAH BOTOL --}}
                                <input
                                    type="number"
                                    min="0"
                                    :name="'botol[' + index + '][jumlah_botol]'"
                                    x-model.number="item.jumlah"
                                    :disabled="item.jumlah === 0"
                                    class="w-16 rounded-lg border
                                    border-gray-200 bg-white px-2 py-2
                                    text-center font-bold outline-none
                                    focus:border-green-500
                                    dark:border-white/10
                                    dark:bg-white/5"
                                >


                                {{-- PLUS --}}
                                <button
                                    type="button"
                                    @click="tambah(index)"
                                    class="flex h-9 w-9 items-center
                                    justify-center rounded-lg
                                    bg-green-500 text-lg font-bold
                                    text-gray-950 transition
                                    hover:bg-green-400"
                                >
                                    +
                                </button>

                            </div>

                        </div>
                    </template>
                </div>


                {{-- ============================================= --}}
                {{-- CATATAN --}}
                {{-- ============================================= --}}

                <div
                    class="rounded-2xl border border-gray-200
                    bg-white p-6
                    dark:border-white/10
                    dark:bg-white/[0.03]"
                    hidden
                >

                    <h3 class="font-bold" hidden>
                        Catatan
                    </h3>

                    <p class="mt-1 text-xs text-gray-500" hidden>
                        Tambahkan catatan jika diperlukan.
                    </p>

                    <textarea hidden
                        name="catatan"
                        x-model="catatan"
                        rows="4"
                        placeholder="Contoh: Botol sudah dipisahkan berdasarkan ukuran..."
                        class="mt-5 w-full resize-none rounded-xl
                        border border-gray-200 bg-gray-50 px-4 py-3
                        text-sm outline-none transition
                        placeholder:text-gray-400
                        focus:border-green-500
                        focus:ring-2 focus:ring-green-500/10
                        dark:border-white/10
                        dark:bg-white/5"
                    ></textarea>

                </div>

            </div>


            {{-- ============================================= --}}
            {{-- RINGKASAN --}}
            {{-- ============================================= --}}

            <div class="lg:col-span-1">

                <div
                    class="sticky top-28 rounded-2xl
                    border border-gray-200 bg-white p-6
                    dark:border-white/10
                    dark:bg-white/[0.03]"
                >

                    <h3 class="font-bold">
                        Ringkasan Pengajuan
                    </h3>

                    <p class="mt-1 text-xs text-gray-500">
                        Periksa kembali sebelum mengajukan.
                    </p>


                    <div class="mt-6 space-y-4">


                        {{-- TOTAL BOTOL --}}

                        <div class="space-y-3">
                            <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">
                                Detail setoran
                            </p>
                            <template x-for="item in items" :key="item.id">
                                <div x-show="Number(item.jumlah) > 0" class="flex justify-between text-sm">
                                    <span class="text-gray-500"><span x-text="item.nama"></span></span>
                                    <span class="font-semibold">
                                        <span x-text="item.jumlah"></span>
                                        x 
                                        <span x-text="Number(item.poin).toLocaleString('id-ID')"></span>
                                </span>
                                </div>
                            </template>
                            <p x-show="totalBotol === 0" class="text-xs text-gray-400">Belum ada botol yang dipilih</p>
                        </div>


                        {{-- TOTAL POIN --}}

                        <div
                            class="border-t border-gray-200 pt-4
                            dark:border-white/10"
                        >

                            <div
                                class="rounded-xl bg-green-500/10 p-4"
                            >

                                <p class="text-xs text-gray-500">
                                    Estimasi poin
                                </p>

                                <div
                                    class="mt-1 flex items-end gap-2"
                                >

                                    <span
                                        class="text-3xl font-black
                                        text-green-500"
                                        x-text="
                                            totalPoin.toLocaleString('id-ID')
                                        "
                                    >
                                        0
                                    </span>

                                    <span
                                        class="mb-1 text-sm font-semibold
                                        text-green-500"
                                    >
                                        poin
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- INFORMASI WORKFLOW --}}

                        <div
                            class="rounded-xl border
                            border-yellow-200 bg-yellow-50 p-4
                            dark:border-yellow-500/20
                            dark:bg-yellow-500/5"
                        >

                            <p class="text-xs leading-5 text-gray-600
                                dark:text-gray-300"
                            >
                                Setelah mengajukan, silakan serahkan
                                botol kepada admin. Poin akan masuk
                                setelah botol diverifikasi dan
                                pengajuan dikonfirmasi.
                            </p>

                        </div>


                        {{-- SUBMIT --}}

                        <button
                            type="submit"
                            :disabled="totalBotol === 0"
                            class="w-full rounded-xl
                            bg-green-500 px-5 py-3
                            text-sm font-bold text-gray-950
                            transition hover:bg-green-400
                            disabled:cursor-not-allowed
                            disabled:opacity-50"
                        >
                            Ajukan Penukaran
                        </button>


                        <p
                            class="text-center text-[11px]
                            leading-4 text-gray-400"
                        >
                            Pengajuan akan berstatus
                            <strong>menunggu</strong>
                            sampai diverifikasi admin.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>


        {{-- ================================================= --}}
        {{-- RIWAYAT PENGAJUAN --}}
        {{-- ================================================= --}}

        <div class="mt-8">

            <div class="mb-4">

                <h3 class="font-bold">
                    Pengajuan Terakhir
                </h3>

                <p class="mt-1 text-xs text-gray-500">
                    Status penukaran sampah kamu.
                </p>

            </div>


            

                <div
                    class="hidden border-b border-gray-200 px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-400 dark:border-white/10 sm:grid sm:grid-cols-12"
                >

                    <div class="col-span-4">
                        Pengajuan
                    </div>

                    <div class="col-span-3">
                        Tanggal
                    </div>

                    <div class="col-span-2">
                        Jumlah
                    </div>

                    <div class="col-span-3 text-right">
                        Status
                    </div>

                </div>


                {{-- ITEM --}}
                @if ($pengajuan->count()) 
                    @foreach ($pengajuan as $item) 
                        <div class="grid gap-3 border-b border-gray-200 px-6 py-5 dark:border-white/10 sm:grid-cols-12 sm:items-center">

                            <div class="sm:col-span-4"> 
                                <p class="text-sm font-semibold">
                                    #SETOR-{{ str_pad($item->id, 5,'0', STR_PAD_LEFT) }}
                                </p>
                                <p class="mt-1 text-xs text-gray-500">
                                    @foreach ($item->detailPenukaran as $detail )
                                    {{ $detail->kategoriBotol->nama_kategori ?? 'Kategori tidak tersedia' }}

                                    @if(!$loop->last),
                                    @endif
                                        
                                    @endforeach
                                </p>
                            </div>

                            <div class="text-xs text-gray-500 sm:col-span-3">

                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}

                            </div>

                            <div class="text-sm font-semibold sm:col-span-2">
                                {{ $item->detailPenukaran->sum('jumlah_botol') }} 
                                item
                            </div>
                            
                            <div class="sm:col-span-3 sm:text-right">
                                @if($item->status === 'menunggu')
                                    <span class="rounded-full bg-yellow-500/10 px-3 py-1 text-[11px] font-semibold text-yellow-600 dark:text-yellow-400">
                                        Menunggu Verifikasi
                                    </span>
                                @elseif($item->status === 'disetujui')
                                    <span class="rounded-full bg-green-500/10 px-3 py-1 text-[11px] font-semibold text-green-500">
                                        Disetujui
                                    </span>
                                @elseif($item->status === 'ditolak')
                                    <span class="rounded-full bg-red-500/10 px-3 py-1 text-[11px] font-semibold text-red-500">
                                        Ditolak
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                    @endforeach
                @else
                    <div class="px-6 py-10 text-center">
                        <p class="text-sm text-gray-500">
                            Belum ada pengajuan penukaran
                        </p>
                    </div>
                @endif
                
                    
@endsection