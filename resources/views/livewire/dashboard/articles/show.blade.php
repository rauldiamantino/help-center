<div class="w-full h-screen">
    <x-articles-sidebar :categories="$categories" :categoryNumber="$article->category->category_number"/>

    <div class="overflow-x-auto w-full py-10 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6">{{ $article->title }}</h1>
        <article class="prose max-w-none">{!! $article->content !!}</article>

        <x-link-button href="{{ route('dashboard.articles.index', ['categoryNumber' => $categoryNumber]) }}" wire:navigate>
            ← Back to List
        </x-link-button>
    </div>
</div>
