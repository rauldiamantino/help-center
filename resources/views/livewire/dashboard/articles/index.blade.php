<x-slot name="header">
    <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
        <x-link-button href="{{ route('dashboard.articles.create') }}" wire:navigate>
            + New Article
        </x-link-button>
    </div>
</x-slot>

<div>
    <div class="overflow-x-auto max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <table class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-300 rounded-lg overflow-hidden">
            <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                <tr>
                    <th class="py-3 border-b border-gray-300">Title</th>
                    <th class="py-3 border-b border-gray-300">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr class="hover:bg-gray-50 border-b border-gray-300">
                        <td class="py-4 bg-white rounded shadow hover:bg-gray-50">
                            <h2 class="font-semibold">
                                <a href="{{ route('dashboard.articles.edit', $article->article_number) }}" wire:navigate>
                                    {{ $article->title }}
                                </a>
                            </h2>
                        </td>
                        <td class="py-4">
                            @if ($article->status === 'published')
                                <span
                                    class="inline-flex items-center px-2 py-0.5 text-xs font-semibold text-green-700 bg-green-100 rounded">
                                    Publicado
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2 py-0.5 text-xs font-semibold text-gray-600 bg-gray-100 rounded">
                                    Rascunho
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
