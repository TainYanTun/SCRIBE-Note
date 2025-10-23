@props(['name', 'show' => false, 'maxWidth' => '2xl', 'closeable' => true])

@php
    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth];
@endphp

<div
    x-data="{ show: @js($show) }"
    x-init="
        $watch('show', value => {
            if (value) {
                document.body.classList.add('overflow-y-hidden');
                @if ($attributes->has('focusable'))
                    setTimeout(() => firstFocusable().focus(), 100);
                @endif
            } else {
                document.body.classList.remove('overflow-y-hidden');
            }
        });
        @if ($show)
            document.body.classList.add('overflow-y-hidden');
        @endif
    "
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:keydown.escape.window="if (show && {{ $closeable ? 'true' : 'false' }}) { show = false }"
    class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center"
    style="display: {{ $show ? 'block' : 'none' }};"
>
    <div
        x-show="show"
        class="fixed inset-0 transform transition-all"
        x-on:click="show = false"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="absolute inset-0 bg-gray-500/75 dark:bg-gray-900/75"></div>
    </div>

    <div
        x-show="show"
        class="mb-6 bg-[#252525] border border-gray-800/50 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }}"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        {{ $slot }}
    </div>
</div>
