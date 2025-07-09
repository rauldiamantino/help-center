<?php

namespace App\Livewire\Articles;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Article')]
#[Layout('layouts.app')]
class ShowArticle extends Component
{
    public $article;
    public $articleId;

    public function mount($articleId)
    {
        $this->article = Article::where('id', $articleId)
            ->where('company_id', Auth::user()->company_id)
            ->findOrFail($articleId);

        $this->articleId = $articleId;
    }

    public function backToList()
    {
        $this->dispatch('backToList');
    }

    public function render()
    {
        return view('livewire.articles.show-article');
    }
}
