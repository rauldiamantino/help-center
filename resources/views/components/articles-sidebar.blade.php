@props(['categories', 'categoryNumber'])

<aside class="hidden h-screen overflow-y-auto overflow-visible absolute z-40 md:static md:block min-w-[300px] max-w-full md:max-w-[300px] bg-gray-100 p-2 border-r border-gray-300 transition-transform duration-100 sidebar-category">
    <nav class="space-y-1 text-sm">
         <a href="{{ route('dashboard.articles.create') . '?categoryNumber=' . $categoryNumber }}" wire:navigate
            class="flex gap-2 items-center px-3 py-2 mb-5 rounded-md hover:bg-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="size-5" viewBox="0 0 16 16" stroke-width="0.3" stroke="currentColor">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
            </svg>
            New article
        </a>

        <button type="button" class="absolute right-2 top-1 z-20 px-1.5 flex items-center py-1.5 focus:outline-none hover:bg-gray-200 rounded-md button-close-sidebar-category">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>

        @foreach ($categories as $category)
            <div onclick="window.location='{{ route('dashboard.articles.index', ['categoryNumber' => $category->category_number]) }}'"
                class="relative group cursor-pointer w-full flex justify-between items-center px-3 py-2 rounded-md hover:bg-gray-200 {{ $categoryNumber == $category->category_number ? 'bg-gray-200' : '' }}">

                <span class="group-hover:w-5/6 truncate">{{ $category->name }}</span>

                <a href="" onclick="event.stopPropagation()" class="absolute right-2 hidden group-hover:block rounded-md bg-gray-200 hover:bg-gray-300 text-gray-600 p-1">
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
