<div>
    @if ($selectedArticleId)
        <livewire:articles.show-article :article-id="$selectedArticleId" />
    @else
        <livewire:articles.article-list />
    @endif
</div>
