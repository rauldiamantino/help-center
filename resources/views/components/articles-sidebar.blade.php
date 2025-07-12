@props(['categories', 'categoryNumber'])

<aside class="bg-gray-100 p-4 border-r border-gray-300">
    <div class="mb-6">
        <x-link-button
            class="w-full py-3 text-center text-white font-semibold rounded-lg
                   bg-gray-600 shadow-sm
                   hover:bg-gray-700
                   focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2
                   transition-colors duration-200"
            href="{{ route('dashboard.articles.create') . '?categoryNumber=' . $categoryNumber }}" wire:navigate>
            + New Article
        </x-link-button>
    </div>

    <nav class="space-y-2">
        <h3 class="text-sm font-semibold text-gray-600 uppercase">Categories</h3>

        @foreach ($categories as $category)
            <a href="{{ route('dashboard.articles.index', ['categoryNumber' => $category->category_number]) }}"
                class="block px-3 py-2 rounded-md {{ $categoryNumber == $category->category_number ? 'font-bold' : 'hover:text-gray-600' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </nav>
</aside>
