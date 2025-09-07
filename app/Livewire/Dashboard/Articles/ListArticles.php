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
    use WithPagination;
    public Collection $categories;
    public int $totalArticles;
    public string $inputSearch = '';

    protected $messages = [
        'inputSearch.required' => 'The search field is required',
        'inputSearch.min' => 'Please enter at least 3 characters',
        'inputSearch.max' => 'Maximum of 255 characters allowed',
    ];

    #[Url]
    public ?int $categoryNumber = null;

    public function mount()
    {
        $companyId = Auth::user()->company_id;

        $this->categories = Category::where('company_id', $companyId)
            ->select('id', 'name', 'category_number')
            ->withCount('articles')
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function render()
    {
        $companyId = Auth::user()->company_id;

        $categoryId = 0;

        if ($this->categoryNumber) {
            $categoryId = Category::where('company_id', $companyId)
                ->where('category_number', $this->categoryNumber)
                ->value('id');
        }

        $query = Article::where('company_id', $companyId);

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($this->inputSearch) {
            $query->where('title', 'like', '%' . $this->inputSearch . '%');
        }

        $articles = $query->orderBy('updated_at', 'desc')
                        ->paginate(20)
                        ->withQueryString();

        return view('livewire.dashboard.articles.index', [
            'articles' => $articles,
        ]);
    }

    public function updatingInputSearch()
    {
        $this->resetPage();
    }
}
