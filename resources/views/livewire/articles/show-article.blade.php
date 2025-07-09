<div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 py-12 px-4">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-3xl font-bold mb-6">{{ $article->title }}</h1>

        <article class="prose max-w-none">{!! $article->content !!}</article>

        <button wire:click="backToList"
            class="mt-10 inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold transition">
            ← Back to List
        </button>
    </div>

</div>
