<div class="w-full flex flex-col md:flex-row items-center justify-between gap-2">
    <div class="text-sm text-gray-400">
        Showing
        <span class="font-semibold">{{ $paginator->firstItem() }}</span>
        to
        <span class="font-semibold">{{ $paginator->lastItem() }}</span>
        of
        <span class="font-semibold">{{ $paginator->total() }}</span>
        results
    </div>

    <div class="flex justify-center items-center space-x-1">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 text-sm text-gray-400 bg-gray-100 border border-gray-300 rounded">Prev</span>
        @else
            <button
                wire:click="previousPage"
                class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded hover:bg-indigo-100">
                Prev
            </button>
        @endif

        {{-- Pages --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-1 text-sm text-gray-500">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 text-sm text-white bg-indigo-400 border border-indigo-400 rounded">{{ $page }}</span>
                    @else
                        <button
                            wire:click="gotoPage({{ $page }})"
                            class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded hover:bg-indigo-100">
                            {{ $page }}
                        </button>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <button
                wire:click="nextPage"
                class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded hover:bg-indigo-100">
                Next
            </button>
        @else
            <span class="px-3 py-1 text-sm text-gray-400 bg-gray-100 border border-gray-300 rounded">Next</span>
        @endif
    </div>
</div>
