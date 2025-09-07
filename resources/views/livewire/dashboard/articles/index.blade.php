<div class="w-full flex min-h-[calc(100vh-76px)]">
    <livewire:dashboard.articles.articles-sidebar :category-number="$categoryNumber" />

    <div class="relative overflow-x-auto w-full h-full sm:px-6 lg:px-8">
        <div class="sticky top-0 bg-white py-5">
            {{ $articles->links('components.pagination-light') }}
        </div>

        <div class="w-full">
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input
                    type="search"
                    id="inputSearch"
                    wire:model.live.debounce.300ms="inputSearch"
                    class="mb-4 block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-0 focus:ring-indigo-500 focus:ring-offset-0"
                    placeholder="Search articles..."
                />
            </div>
        </div>

        <table class="mb-4 min-w-full table-fixed text-sm text-left text-gray-700 rounded-lg overflow-hidden">
            <tbody class="divide-y divide-gray-300">
                @foreach ($articles as $article)
                    <tr class="hover:bg-indigo-300/50">
                        <td class="px-3 py-4 w-full">
                            <h2 class="{{ $article->status === 1 ? 'font-semibold' : 'font-light italic text-gray-500' }}">
                                <a href="{{ route('dashboard.articles.edit', $article->article_number) }}" wire:navigate class="hover:underline">
                                    {{ $article->title }}
                                </a>
                            </h2>
                        </td>
                        <td class="px-3 py-4 w-32 text-right">
                            @if ($article->status === 1)
                                <span class="inline-flex items-center text-xs font-semibold text-green-700 uppercase tracking-widest">
                                    Published
                                </span>
                            @else
                                <span class="inline-flex items-center text-xs font-semibold text-orange-700 uppercase tracking-widest">
                                    Draft
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
