<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Article') }}
    </h2>
</x-slot>

<div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6">{{ $article->title }}</h1>
        <article class="prose max-w-none">{!! $article->content !!}</article>

        <x-link-button href="{{ route('dashboard.articles.index') }}" wire:navigate class="mt-10">
            ← Back to List
        </x-link-button>
    </div>
</div>
