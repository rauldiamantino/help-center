@if ($paginator->hasPages())
    <div class="flex items-center justify-between">
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
                <span
                    class="px-3 py-1 text-sm text-gray-400 bg-gray-100 border border-gray-300 rounded cursor-not-allowed">Prev</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded hover:bg-indigo-100">
                    Prev
                </a>
            @endif
            {{-- Pages --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 py-1 text-sm text-gray-500">{{ $element }}</span>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="px-3 py-1 text-sm text-white bg-indigo-500 border border-indigo-500 rounded">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                                class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded hover:bg-indigo-100">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="px-3 py-1 text-sm text-gray-700 bg-white border border-gray-300 rounded hover:bg-indigo-100">
                    Next
                </a>
            @else
                <span
                    class="px-3 py-1 text-sm text-gray-400 bg-gray-100 border border-gray-300 rounded cursor-not-allowed">Next</span>
            @endif
        </div>
    </div>
@endif
