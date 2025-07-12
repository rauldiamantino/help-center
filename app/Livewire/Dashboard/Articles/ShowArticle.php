<?php

namespace App\Livewire\Dashboard\Articles;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Title('Articles')]
#[Layout('layouts.dashboard')]
class ShowArticle extends Component
{
    public Article $article;
    public Collection $categories;
    public int $articleNumber;

    public function mount($articleNumber)
    {
        $this->articleNumber = $articleNumber;
        $companyId = Auth::user()->company_id;

        $this->article = Article::where('article_number', $articleNumber)
            ->where('company_id', $companyId)
            ->firstOrFail();

        $this->categories = Category::where('company_id', $companyId)
            ->select('id', 'name', 'category_number')
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard.articles.show');
    }
}
