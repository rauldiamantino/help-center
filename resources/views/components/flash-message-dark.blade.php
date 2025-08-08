@if (session('success') || session('error'))
    <div
        x-data="{ shown: true, timeout: null }"
        x-init="timeout = setTimeout(() => shown = false, 3000)"
        x-show="shown"
        @click="shown = false; clearTimeout(timeout)"
        x-transition.opacity.duration.500ms
        role="alert"
        style="display: none;"
        class="fixed z-40 bottom-20 left-1/2 transform -translate-x-1/2 px-5 py-3 rounded-lg shadow-lg bg-gray-900 text-white border border-gray-800 max-w-max whitespace-nowrap cursor-pointer select-none">
        {{ session('success') ?? session('error') }}
    </div>
@endif
