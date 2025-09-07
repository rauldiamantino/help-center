<div class="w-full flex min-h-[calc(100vh-76px)]">
    <livewire:dashboard.articles.articles-sidebar :category-number="$categoryNumber" />

    <div class="relative overflow-x-auto w-full h-full sm:px-6 lg:px-8">
        <div class="sticky top-0 bg-white py-5">
            {{ $articles->links('components.pagination-light') }}
        </div>

        <table class="mb-2 min-w-full table-fixed text-sm text-left text-gray-700 rounded-lg overflow-hidden">
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
