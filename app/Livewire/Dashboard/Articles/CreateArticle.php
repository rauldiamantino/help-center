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
class CreateArticle extends Component
{
    public Collection $categories;
    public Collection $categoriesSelect;
    public string $title;
    public string $slug;
    public string $content = '';
    public int $category_id;

    #[Url]
    public ?int $categoryNumber = null;

    public function mount()
    {
        $companyId = Auth::user()->company_id;

        if ($this->categoryNumber) {
            $category = Category::select('id', 'name', 'category_number')
                ->where('company_id', $companyId)
                ->where('category_number', $this->categoryNumber)
                ->firstOrFail();

            $this->category_id = $category->id;
            $this->categoriesSelect = collect([ $category ]);
        }

        $this->categories = Category::where('company_id', $companyId)
            ->select('id', 'name', 'category_number')
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard.articles.create');
    }

    public function save()
    {
        $this->validate();

        Article::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'category_id' => $this->category_id,
            'company_id' => Auth::user()->company_id,
            'user_id' => Auth::id(),
        ]);

        return $this->redirectRoute('dashboard.articles.index', ['categoryNumber' => $this->categoryNumber]);
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'regex:/^[a-z0-9-]+$/',
                'unique:articles,slug',
            ],
            'category_id' => 'required|numeric|exists:categories,id',
            'content' => 'nullable|string',
        ];
    }
}
