<?php

namespace App\Livewire\Dashboard\Articles;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Articles')]
#[Layout('layouts.dashboard')]
class ShowArticle extends Component
{
    public $article;
    public $articleNumber;

    public function mount($articleNumber)
    {
        $this->articleNumber = $articleNumber;
        $companyId = Auth::user()->company_id;

        $this->article = Article::where('article_number', $articleNumber)
            ->where('company_id', $companyId)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.dashboard.articles.show');
    }
}
