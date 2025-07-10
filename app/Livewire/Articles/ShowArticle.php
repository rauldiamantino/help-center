<?php

namespace App\Livewire\Articles;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Article')]
#[Layout('layouts.dashboard')]
class ShowArticle extends Component
{
    public $article;
    public $articleId;

    public function mount($id)
    {
        $this->article = Article::where('id', $id)
            ->where('company_id', Auth::user()->company_id)
            ->findOrFail($id);

        $this->articleId = $id;
    }

    public function render()
    {
        return view('livewire.dashboard.articles.show');
    }
}
