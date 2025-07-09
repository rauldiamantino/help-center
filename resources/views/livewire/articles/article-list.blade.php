<div class="p-10 bg-gray-600">
    <div class="overflow-x-auto bg-gray-100 p-6 rounded-xl shadow">
        <table
            class="min-w-full text-sm text-left text-gray-700 bg-white border border-gray-300 rounded-lg overflow-hidden">
            <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                <tr>
                    <th class="px-5 py-3 border-b border-gray-300">ID</th>
                    <th class="px-5 py-3 border-b border-gray-300">Título</th>
                    <th class="px-5 py-3 border-b border-gray-300">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr class="hover:bg-gray-50 border-b border-gray-300">
                        <td class="px-5 py-3">{{ $article->id }}</td>
                        <td class="p-4 bg-white rounded shadow cursor-pointer hover:bg-gray-50" wire:click="showArticle({{ $article->id }})">
                            <h2 class="font-semibold">{{ $article->title }}</h2>
                        </td>
                        <td class="px-5 py-3">
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
