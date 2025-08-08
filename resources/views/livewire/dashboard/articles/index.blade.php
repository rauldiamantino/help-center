<div class="w-full flex h-screen">
    <x-articles-sidebar :categories="$categories" :categoryNumber="$categoryNumber" />

    <div class="overflow-x-auto w-full py-10 sm:px-6 lg:px-8">
        <table
            class="min-w-full text-sm text-left text-gray-700 rounded-lg overflow-hidden">
            <tbody>
                @foreach ($articles as $article)
                    <tr class="hover:bg-indigo-300/50 border-b border-gray-300">
                        <td class="px-3 py-4">
                            <h2 class="{{ $article->status === 1 ? 'font-semibold' : 'font-light italic text-gray-500' }}">
                                <a href="{{ route('dashboard.articles.edit', $article->article_number) }}" wire:navigate>
                                    {{ $article->title }}
                                </a>
                            </h2>
                        </td>
                        <td class="px-3 py-4">
                            @if ($article->status === 1)
                                <span
                                    class="inline-flex items-center px-2 py-0.5 text-xs font-semibold text-green-700 bg-green-100 rounded">
                                    Published
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2 py-0.5 text-xs font-semibold text-gray-600 bg-gray-200 rounded">
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
