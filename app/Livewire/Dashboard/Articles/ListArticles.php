<?php

namespace App\Livewire\Dashboard\Articles;

use Livewire\Component;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[Title('Article')]
#[Layout('layouts.dashboard')]
class ListArticles extends Component
{
    public Collection $categories;

    #[Url]
    public ?int $categoryNumber = null;

    public function mount()
    {
        $companyId = Auth::user()->company_id;

        $this->categories = Category::where('company_id', $companyId)
            ->select('id', 'name', 'category_number')
            ->orderBy('updated_at', 'desc')
            ->get();

        if (is_null($this->categoryNumber) && $this->categories->isNotEmpty()) {
            $this->categoryNumber = $this->categories->first()->category_number;
        }
    }

    public function render()
    {
        $companyId = Auth::user()->company_id;

        $categoryId = 0;
        $articles = collect();

        if ($this->categoryNumber) {
            $categoryId = Category::where('company_id', $companyId)
                ->where('category_number', $this->categoryNumber)
                ->value('id');
        }

        if ($categoryId) {
            $articles = Article::where('category_id', $categoryId)
                ->orderBy('updated_at', 'desc')
                ->paginate(10)
                ->withQueryString();
        }

        return view('livewire.dashboard.articles.index', [
            'articles' => $articles,
        ]);
    }
}
