<!DOCTYPE html>
<html lang="id"
    x-data="{
        dark: localStorage.getItem('theme') !== 'light',
        sidebarOpen: false,
        logoutModal: false,

        toggleTheme() {
            this.dark = !this.dark;

            localStorage.setItem(
                'theme',
                this.dark ? 'dark' : 'light'
            );

            document.documentElement.classList.toggle(
                'dark',
                this.dark
            );
        }
    }"
    x-init="
        document.documentElement.classList.toggle('dark', dark)
    "
    :class="{ 'dark': dark }"
>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Keranjang - Tercycle</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('cartPage', () => ({
                cart: [
                    {
                        id: 1,
                        name: 'Pulpen Eco',
                        category: 'Alat Tulis',
                        price: 1000,
                        qty: 2,
                        icon: '🖊️'
                    },
                    {
                        id: 2,
                        name: 'Tumbler Recycle',
                        category: 'Rumah Tangga',
                        price: 5000,
                        qty: 1,
                        icon: '🥤'
                    },
                    {
                        id: 3,
                        name: 'Tote Bag Recycle',
                        category: 'Aksesoris',
                        price: 3500,
                        qty: 1,
                        icon: '👜'
                    }
                ],

                formatNumber(number) {
                    return new Intl.NumberFormat('id-ID').format(number)
                },

                get totalItems() {
                    return this.cart.reduce(
                        (total, item) => total + item.qty,
                        0
                    )
                },

                get totalPrice() {
                    return this.cart.reduce(
                        (total, item) => total + (item.price * item.qty),
                        0
                    )
                },

                increase(item) {
                    item.qty++
                },

                decrease(item) {
                    if (item.qty > 1) {
                        item.qty--
                    }
                },

                removeItem(id) {
                    this.cart = this.cart.filter(
                        item => item.id !== id
                    )
                },

                clearCart() {
                    this.cart = []
                }
            }))
        })
    </script>
</head>


<body
    class="min-h-screen bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-white"
>

    {{-- SIDEBAR --}}
    <aside
        class="fixed inset-y-0 left-0 z-50 w-64 border-r border-gray-200 bg-white transition-transform duration-300 dark:border-white/10 dark:bg-gray-950 lg:block"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    >

        <div class="flex h-full flex-col">

            {{-- LOGO --}}

            <div
                class="flex h-20 items-center border-b border-gray-200 px-6 dark:border-white/10"
            >
                <a
                    href="/siswa/dashboard"
                    class="flex items-center gap-3"
                >
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-500 font-black text-gray-950"
                    >
                        T
                    </div>

                    <span class="text-xl font-bold">
                        Ter<span class="text-green-500">cycle</span>
                    </span>
                </a>
            </div>



            {{-- NAVIGATION --}}

            <nav class="flex-1 space-y-1 px-4 py-6">

                <p
                    class="mb-3 px-3 text-[11px] font-bold uppercase tracking-wider text-gray-400"
                >
                    Menu
                </p>


                {{-- DASHBOARD --}}

                <a
                    href="/siswa/dashboard"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
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
                            d="M3 13h8V3H3v10Zm10 8h8V11h-8v10ZM3 21h8v-6H3v6Zm10-18v6h8V3h-8Z"
                        />

                    </svg>

                    Dashboard

                </a>



                {{-- RIWAYAT POIN --}}

                <a
                    href="/siswa/poin"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
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
                            d="M12 6v6l4 2"
                        />

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />

                    </svg>

                    Riwayat Poin

                </a>



                {{-- SETOR BOTOL --}}

                <a
                    href="/siswa/tukar"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
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
                            d="M7 3h10M8 3v4l-2 3v8a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3v-8l-2-3V3M7 10h10"
                        />

                    </svg>

                    Setor Botol

                </a>



                {{-- PRODUK --}}

                <a
                    href="/siswa/produk"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
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
                            d="M20 7 12 3 4 7m16 0-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                        />

                    </svg>

                    Produk

                </a>



                {{-- PESANAN --}}

                <a
                    href="/siswa/pesanan"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
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
                            d="M3 7h18M5 7v12h14V7M8 7V5a4 4 0 0 1 8 0v2"
                        />

                    </svg>

                    Pesanan

                </a>



                <p
                    class="mb-3 mt-8 px-3 text-[11px] font-bold uppercase tracking-wider text-gray-400"
                >
                    Account
                </p>



                {{-- PROFIL --}}

                <a
                    href="/siswa/profil"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-white/5 dark:hover:text-white"
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
                            d="M15 19a6 6 0 0 0-12 0m6-8a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm9-4v6m3-3h-6"
                        />

                    </svg>

                    Profil

                </a>

            </nav>



            {{-- USER --}}

            <div
                class="border-t border-gray-200 p-4 dark:border-white/10"
            >
                <div class="flex items-center gap-3">

                    {{-- AVATAR --}}
                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-green-500 font-bold text-gray-950"
                    >
                        K
                    </div>

                    {{-- NAMA --}}
                    <div class="min-w-0 flex-1">

                        <p class="truncate text-sm font-semibold">
                            Kevin
                        </p>

                        <p class="text-xs text-gray-500">
                            Siswa
                        </p>

                    </div>

                    {{-- LOGOUT ICON --}}
                    <form
                        action="/logout"
                        method="POST"
                    >
                        @csrf

                        <button
                            type="button"
                            @click="logoutModal = true"
                            class="flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-red-500/10 hover:text-red-500"
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
                                    d="M15 12H3m0 0 4-4m-4 4 4 4M15 4h3a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-3"
                                />
                            </svg>
                        </button>

                    </form>

                </div>
            </div>
        </div>

    </aside>

    <div
        x-show="sidebarOpen"
        x-transition.opacity
        @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm lg:hidden"
        style="display: none;"
    ></div>


    {{-- MAIN --}}
    <main class="lg:pl-64">

        {{-- TOPBAR --}}
        <header
            class="sticky top-0 z-30 hidden h-20 items-center justify-between border-b border-gray-200 bg-white/90 px-6 backdrop-blur-xl dark:border-white/10 dark:bg-gray-950/90 lg:flex lg:px-8"
        >

            <div>

                <p class="text-sm font-medium text-gray-500">
                    Belanja
                </p>

                <h1 class="font-bold">
                    Keranjang
                </h1>

            </div>


            <div class="flex items-center gap-2">

                {{-- KERANJANG --}}
                <a
                    href="/siswa/keranjang"
                    class="relative flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-gray-50 text-gray-700 transition hover:bg-gray-100 dark:border-white/10 dark:bg-white/5 dark:text-gray-300 dark:hover:bg-white/10"
                    title="Keranjang"
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
                            d="M2.25 3h1.386a1.5 1.5 0 0 1 1.46 1.15L5.42 6m0 0h14.33a1.5 1.5 0 0 1 1.46 1.85l-1.05 4.5a1.5 1.5 0 0 1-1.46 1.15H8.25a1.5 1.5 0 0 1-1.46-1.15L5.42 6Z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8.25 18.75a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Zm9 0a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Z"
                        />
                    </svg>

                    {{-- BADGE JUMLAH --}}
                    <span
                        class="absolute -right-1 -top-1 flex h-5 min-w-5 items-center justify-center rounded-full bg-red-500 px-1 text-[10px] font-bold text-white"
                    >
                        0
                    </span>
                </a>

                {{-- THEME BUTTON --}}
                <button
                    type="button"
                    @click="toggleTheme()"
                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 bg-gray-50 text-gray-700 transition hover:bg-gray-100 dark:border-white/10 dark:bg-white/5 dark:text-gray-300 dark:hover:bg-white/10"
                >

                    <svg
                        x-show="dark"
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
                            d="M12 3v2m0 14v2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M3 12h2m14 0h2M4.93 19.07l1.42-1.42m11.3-11.3 1.42-1.42M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"
                        />
                    </svg>

                    <svg
                        x-show="!dark"
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
                            d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z"
                        />
                    </svg>

                </button>

            </div>

        </header>


        {{-- CONTENT --}}
        <div
            x-data="cartPage"
            class="mx-auto max-w-7xl p-5 lg:p-8"
        >

            {{-- HEADER --}}
            <div class="mb-6">

                <div class="flex items-center justify-between gap-4">

                    <div>

                        <p class="text-sm font-medium text-gray-500">
                            Belanja
                        </p>

                        <h2 class="mt-1 text-2xl font-black tracking-tight">
                            Keranjang
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Produk yang ingin kamu tukarkan dengan poin.
                        </p>

                    </div>


                    <div
                        class="hidden rounded-xl bg-green-500/10 px-4 py-2 text-sm font-semibold text-green-600 sm:block"
                    >
                        <span x-text="totalItems"></span>
                        item
                    </div>

                </div>

            </div>


            {{-- EMPTY CART --}}
            <template x-if="cart.length === 0">

                <div
                    class="flex flex-col items-center justify-center rounded-2xl border border-gray-200 bg-white px-6 py-20 text-center dark:border-white/10 dark:bg-white/[0.03]"
                >

                    <div
                        class="flex h-20 w-20 items-center justify-center rounded-full bg-gray-100 text-4xl dark:bg-white/5"
                    >
                        🛒
                    </div>

                    <h2 class="mt-5 text-lg font-bold">
                        Keranjang masih kosong
                    </h2>

                    <p class="mt-2 max-w-sm text-sm text-gray-500">
                        Belum ada produk yang masuk ke keranjang.
                    </p>

                    <a
                        href="/siswa/produk"
                        class="mt-6 rounded-xl bg-green-500 px-5 py-3 text-sm font-bold text-gray-950 transition hover:bg-green-400"
                    >
                        Belanja Produk
                    </a>

                </div>

            </template>


            {{-- CART --}}
            <template x-if="cart.length > 0">

                <div
                    class="grid gap-6 lg:grid-cols-[1fr_360px]"
                >

                    {{-- PRODUCT LIST --}}
                    <div class="space-y-4">

                        <div
                            class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
                        >

                            <div class="flex items-center justify-between">

                                <div>

                                    <h2 class="font-bold">
                                        Produk Dipilih
                                    </h2>

                                    <p class="mt-1 text-xs text-gray-500">
                                        <span x-text="totalItems"></span>
                                        item dalam keranjang
                                    </p>

                                </div>


                                <button
                                    type="button"
                                    @click="clearCart()"
                                    class="text-xs font-semibold text-red-500 hover:text-red-600"
                                >
                                    Hapus Semua
                                </button>

                            </div>

                        </div>


                        {{-- ITEMS --}}
                        <template
                            x-for="item in cart"
                            :key="item.id"
                        >

                            <div
                                class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-white/10 dark:bg-white/[0.03]"
                            >

                                <div class="flex gap-4">

                                    {{-- IMAGE --}}
                                    <div
                                        class="flex h-24 w-24 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-4xl dark:bg-white/5 sm:h-28 sm:w-28"
                                    >
                                        <span x-text="item.icon"></span>
                                    </div>


                                    {{-- DETAIL --}}
                                    <div class="min-w-0 flex-1">

                                        <div
                                            class="flex items-start justify-between gap-3"
                                        >

                                            <div class="min-w-0">

                                                <p
                                                    class="text-xs font-medium text-green-500"
                                                    x-text="item.category"
                                                ></p>

                                                <h3
                                                    class="mt-1 truncate font-bold"
                                                    x-text="item.name"
                                                ></h3>

                                            </div>


                                            {{-- DELETE --}}
                                            <button
                                                type="button"
                                                @click="removeItem(item.id)"
                                                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-gray-400 transition hover:bg-red-500/10 hover:text-red-500"
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
                                                        d="M6 7h12M9 7V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2m2 0v12a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1V7m3 4v6m4-6v6"
                                                    />

                                                </svg>

                                            </button>

                                        </div>


                                        <div
                                            class="mt-4 flex items-end justify-between gap-4"
                                        >

                                            {{-- PRICE --}}
                                            <div>

                                                <p class="text-xs text-gray-500">
                                                    Harga
                                                </p>

                                                <p
                                                    class="mt-1 font-black text-green-500"
                                                    x-text="formatNumber(item.price) + ' poin'"
                                                ></p>

                                            </div>


                                            {{-- QUANTITY --}}
                                            <div
                                                class="flex items-center rounded-xl border border-gray-200 dark:border-white/10"
                                            >

                                                <button
                                                    type="button"
                                                    @click="decrease(item)"
                                                    class="flex h-9 w-9 items-center justify-center text-gray-500 hover:bg-gray-100 dark:hover:bg-white/5"
                                                >
                                                    −
                                                </button>

                                                <span
                                                    class="w-8 text-center text-sm font-bold"
                                                    x-text="item.qty"
                                                ></span>

                                                <button
                                                    type="button"
                                                    @click="increase(item)"
                                                    class="flex h-9 w-9 items-center justify-center text-gray-500 hover:bg-gray-100 dark:hover:bg-white/5"
                                                >
                                                    +
                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                </div>


                                {{-- SUBTOTAL --}}
                                <div
                                    class="mt-4 flex items-center justify-between border-t border-gray-200 pt-3 dark:border-white/10"
                                >

                                    <span class="text-xs text-gray-500">
                                        Subtotal
                                    </span>

                                    <span
                                        class="text-sm font-bold"
                                        x-text="formatNumber(item.price * item.qty) + ' poin'"
                                    ></span>

                                </div>

                            </div>

                        </template>

                    </div>


                    {{-- SUMMARY --}}
                    <div>

                        <div
                            class="sticky top-24 rounded-2xl border border-gray-200 bg-white p-5 dark:border-white/10 dark:bg-white/[0.03]"
                        >

                            <h2 class="font-bold">
                                Ringkasan Pesanan
                            </h2>


                            <div class="mt-5 space-y-3">

                                <div class="flex justify-between text-sm">

                                    <span class="text-gray-500">
                                        Total item
                                    </span>

                                    <span
                                        class="font-semibold"
                                        x-text="totalItems"
                                    ></span>

                                </div>


                                <div class="flex justify-between text-sm">

                                    <span class="text-gray-500">
                                        Jenis produk
                                    </span>

                                    <span
                                        class="font-semibold"
                                        x-text="cart.length"
                                    ></span>

                                </div>

                            </div>


                            <div
                                class="my-5 border-t border-gray-200 dark:border-white/10"
                            ></div>


                            <div class="flex items-end justify-between">

                                <div>

                                    <p class="text-xs text-gray-500">
                                        Total
                                    </p>

                                    <p
                                        class="mt-1 text-2xl font-black text-green-500"
                                        x-text="formatNumber(totalPrice)"
                                    ></p>

                                </div>

                                <span class="text-sm font-semibold text-gray-500">
                                    poin
                                </span>

                            </div>


                            <button
                                type="button"
                                class="mt-6 w-full rounded-xl bg-green-500 px-5 py-3.5 text-sm font-bold text-gray-950 transition hover:bg-green-400"
                            >
                                Lanjutkan Pesanan
                            </button>


                            <a
                                href="/siswa/produk"
                                class="mt-3 block w-full rounded-xl border border-gray-200 px-5 py-3.5 text-center text-sm font-semibold text-gray-600 transition hover:bg-gray-100 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/5"
                            >
                                Lanjut Belanja
                            </a>

                        </div>

                    </div>

                </div>

            </template>

        </div>

    </main>

</body>

{{-- ========================================================= --}}
{{-- MODAL KONFIRMASI LOGOUT --}}
{{-- ========================================================= --}}

<div
    x-show="logoutModal"
    x-transition.opacity
    x-effect="document.body.style.overflow = logoutModal ? 'hidden' : ''"
    class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 p-4"
    style="display: none;"
>
    {{-- BACKDROP --}}
    <div
        class="absolute inset-0 bg-black/50 backdrop-blur-md"
        @click="logoutModal = false"
    ></div>


    {{-- MODAL --}}
    <div
        x-show="logoutModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @click.stop
        class="relative w-full max-w-sm rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900"
    >

        {{-- ICON --}}
        <div class="flex justify-center">

            <div
                class="flex h-12 w-12 items-center justify-center rounded-full bg-red-500/10 text-red-500"
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
                        d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m10 17 5-5-5-5m5 5H3"
                    />
                </svg>
            </div>

        </div>


        {{-- TEXT --}}
        <div class="mt-4 text-center">

            <h2 class="text-lg font-bold">
                Yakin mau logout?
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                Kamu akan keluar dari akun dan harus login kembali.
            </p>

        </div>


        {{-- BUTTON --}}
        <div class="mt-6 grid grid-cols-2 gap-3">

            {{-- BATAL --}}
            <button
                type="button"
                @click="logoutModal = false"
                class="rounded-xl border border-gray-200 px-4 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-100 dark:border-white/10 dark:text-gray-300 dark:hover:bg-white/5"
            >
                Batal
            </button>


            {{-- LOGOUT --}}
            <form
                action="/logout"
                method="POST"
            >
                @csrf

                <button
                    type="submit"
                    class="w-full rounded-xl bg-red-500 px-4 py-3 text-sm font-bold text-white transition hover:bg-red-600"
                >
                    Logout
                </button>

            </form>

        </div>

    </div>

</div>
</html>