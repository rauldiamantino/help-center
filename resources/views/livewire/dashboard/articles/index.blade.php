<div class="w-full flex h-screen">
    <livewire:dashboard.articles.articles-sidebar :category-number="$categoryNumber" />

    <div class="overflow-x-auto w-full py-2 sm:px-6 lg:px-8">
        <div class="mb-5">
            {{ $articles->links('components.pagination-light') }}
        </div>

        <table class="min-w-full table-fixed text-sm text-left text-gray-700 rounded-lg overflow-hidden">
            <tbody>
                @foreach ($articles as $article)
                    <tr class="hover:bg-indigo-300/50 border-b border-gray-300">
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
