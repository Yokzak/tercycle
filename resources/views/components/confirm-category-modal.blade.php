@props([
    'title',
    'message',
    'confirmText' => 'Konfirmasi',
    'confirmAction',
    'state',
    'confirmClass' => 'bg-green-500 hover:bg-green-400 text-gray-950',
])

<div
    x-show="{{ $state }}"
    x-transition.opacity
    class="fixed inset-0 z-[60] flex items-center justify-center bg-black/50 p-4"
    style="display: none;"
>
    {{-- BACKDROP --}}
    <div
        class="absolute inset-0 bg-black/50 backdrop-blur-md"
        @click="{{ $state }} = false"
    ></div>

    {{-- MODAL --}}
    <div
        @click.stop
        class="relative w-full max-w-md rounded-2xl bg-white shadow-2xl dark:bg-gray-900"
    >

        {{-- HEADER --}}
        <div class="border-b border-gray-200 px-6 py-5 dark:border-white/10">

            <h2 class="text-lg font-bold">
                {{ $title }}
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                {{ $message }}
            </p>

        </div>

        {{-- ACTION --}}
        <div class="flex justify-end gap-3 px-6 py-5">

            <button
                type="button"
                @click="{{ $state }} = false"
                class="rounded-xl border border-gray-200 px-5 py-3 text-sm font-semibold dark:border-white/10"
            >
                Batal
            </button>

            <button
                type="button"
                @click="{{ $confirmAction }}"
                class="rounded-xl px-5 py-3 text-sm font-bold {{ $confirmClass }}"
            >
                {{ $confirmText }}
            </button>

        </div>

    </div>
</div>