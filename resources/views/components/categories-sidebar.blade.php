@props(['categories', 'categoryNumber'])

<aside class="hidden h-screen overflow-y-auto overflow-visible absolute z-40 md:static md:block min-w-[300px] max-w-full md:max-w-[300px] bg-gray-100 p-2 border-r border-gray-300 transition-transform duration-100 sidebar-category">
    <nav class="space-y-1 text-sm">
        @php if ($categoryNumber): @endphp
            <div class="space-y-1 mb-5">
                <a href="{{ route('dashboard.articles.create') . '?categoryNumber=' . $categoryNumber }}" wire:navigate
                    class="flex gap-2 items-center px-3 py-2 rounded-md hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>

                    New article
                </a>
                <a href="{{ route('dashboard.categories.create') }}" wire:navigate
                    class="flex gap-2 items-center px-3 py-2 rounded-md hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                    </svg>

                    New category
                </a>
            </div>
        @php endif; @endphp

        <button type="button" class="absolute right-2 top-1 z-20 px-1.5 flex items-center py-1.5 focus:outline-none hover:bg-gray-200 rounded-md button-close-sidebar-category">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>

        @foreach ($categories as $category)
            <div onclick="window.location='{{ route('dashboard.articles.index', ['categoryNumber' => $category->category_number]) }}'"
                class="relative group cursor-pointer w-full flex justify-between items-center px-3 py-2 rounded-md hover:bg-gray-200 {{ $categoryNumber == $category->category_number ? 'bg-gray-200' : '' }}">

                <span class="group-hover:w-5/6 truncate">{{ $category->name }}</span>

                <a href="{{ route('dashboard.categories.edit', $category->category_number) }}" onclick="event.stopPropagation()" class="absolute right-2 hidden group-hover:block rounded-md bg-gray-200 hover:bg-gray-300 text-gray-600 p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                </a>
            </div>
        @endforeach
    </nav>
</aside>

<button type="button" class="block: md:hidden absolute z-40 ml-1 top-1/2 h-max px-1.5 py-10 focus:outline-none bg-gray-100 hover:bg-gray-200 rounded duration-150 button-open-sidebar-category">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
    </svg>
</button>
