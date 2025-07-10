<div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 py-12 px-4">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
        <h1 class="text-3xl font-bold mb-6">{{ $article->title }}</h1>
        <article class="prose max-w-none">{!! $article->content !!}</article>

        <x-link-button href="{{ route('dashboard.articles.index') }}" wire:navigate class="mt-10">
            ← Back to List
        </x-link-button>
    </div>
</div>
