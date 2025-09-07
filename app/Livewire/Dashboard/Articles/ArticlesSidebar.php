<?php

namespace App\Livewire\Dashboard\Articles;

use Livewire\Component;
use App\Models\Category;
use App\Models\Article;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ArticlesSidebar extends Component
{
    public string $active = '';
    protected $listeners = ['articleUpdated' => '$refresh'];

    #[Url]
    public ?int $categoryNumber = null;

    public function mount(?int $categoryNumber = null)
    {
        $this->categoryNumber = $categoryNumber ?? request()->query('categoryNumber');

        // Active tab
        if (Route::currentRouteName() === 'dashboard.articles.create') {
            $this->active = 'newArticle';
        } elseif (Route::currentRouteName() === 'dashboard.categories.create') {
            $this->active = 'newCategory';
        } elseif ($this->categoryNumber) {
            $this->active = 'category' . $this->categoryNumber;
        } else {
            $this->active = 'allArticles';
        }
    }

    public function render()
    {
        $companyId = Auth::user()->company_id;

        $categories = Category::where('company_id', $companyId)
            ->select('id', 'name', 'category_number')
            ->withCount('articles')
            ->orderBy('updated_at', 'desc')
            ->get();

        $totalArticles = Article::where('company_id', $companyId)->count();

        return view('livewire.dashboard.articles.articles-sidebar', [
            'categories' => $categories,
            'totalArticles' => $totalArticles,
            'categoryNumber' => $this->categoryNumber,
        ]);
    }
}
