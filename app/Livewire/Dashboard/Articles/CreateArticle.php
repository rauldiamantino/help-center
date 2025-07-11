<?php

namespace App\Livewire\Dashboard\Articles;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Articles')]
#[Layout('layouts.dashboard')]
class CreateArticle extends Component
{
    public Collection $categories;
    public string $title;
    public string $slug;
    public string $content = '';
    public int $category_id;

    public function mount()
    {
        $companyId = Auth::user()->company_id;

        $this->categories = Category::where('company_id', $companyId)
            ->select('id', 'name')
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

        return $this->redirectRoute('dashboard.articles.index');
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
