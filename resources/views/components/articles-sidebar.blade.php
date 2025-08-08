@props(['categories', 'categoryNumber'])

<aside class="hidden h-screen overflow-y-auto absolute z-40 md:static md:block min-w-[300px] max-w-full md:max-w-[300px] bg-gray-100 p-4 border-r border-gray-300 transition-transform duration-100 sidebar-category">
    <div class="mb-6 py-1 px-1.5 w-full flex items-center justify-between gap-2 hover:bg-gray-200 rounded-md">
        <h3 class="text-sm font-semibold text-gray-600 uppercase">Categories</h3>

        <div class="w-full flex items-center justify-end gap-2">
            <button type="button" class="md:hidden px-1.5 py-1 focus:outline-none hover:bg-gray-300 rounded-md button-close-sidebar-category">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
            <a href="{{ route('dashboard.articles.create') . '?categoryNumber=' . $categoryNumber }}" wire:navigate class="inline-flex items-center px-1.5 py-1 focus:outline-none hover:bg-gray-300 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </a>
        </div>
    </div>

    <nav class="space-y-2">
        @foreach ($categories as $category)
            <a href="{{ route('dashboard.articles.index', ['categoryNumber' => $category->category_number]) }}"
                class="block px-3 py-2 rounded-md {{ $categoryNumber == $category->category_number ? 'font-bold' : 'hover:text-gray-600' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </nav>
</aside>

<button type="button" class="block: md:hidden absolute z-40 ml-1 top-1/2 h-max px-1.5 py-10 focus:outline-none bg-gray-100 hover:bg-gray-200 rounded duration-150 button-open-sidebar-category">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
    </svg>
</button>
