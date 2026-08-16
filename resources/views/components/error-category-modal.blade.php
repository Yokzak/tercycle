@props([
    'state',
    'message',
])

<div
    x-show="{{ $state }}"
    x-transition.opacity
    class="fixed inset-0 z-[70] flex items-center justify-center bg-black/50 p-4"
    style="display: none;"
>
    <div
        class="absolute inset-0 bg-black/50 backdrop-blur-sm"
        @click="{{ $state }} = false"
    ></div>

    <div
        @click.stop
        class="relative w-full max-w-md rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900"
    >

        <div class="text-center">

            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-red-500/10">
                <svg
                    class="h-7 w-7 text-red-500"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </div>

            <h2 class="mt-4 text-lg font-bold">
                Gagal
            </h2>

            <p
                class="mt-2 text-sm text-gray-500"
                x-text="{{ $message }}"
            ></p>

        </div>

        <button
            type="button"
            @click="{{ $state }} = false"
            class="mt-6 w-full rounded-xl bg-red-500 px-5 py-3 text-sm font-bold text-white"
        >
            OK
        </button>

    </div>
</div>