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
class EditArticle extends Component
{
    public Article $article;
    public Collection $categories;
    public string $title;
    public string $slug;
    public string $content;
    public int $category_id;

    public function mount(int $articleNumber)
    {
        $companyId = Auth::user()->company_id;

        $this->article = Article::where('article_number', $articleNumber)
            ->where('company_id', $companyId)
            ->firstOrFail();

        $this->categories = Category::where('company_id', $companyId)
            ->select('id', 'name')
            ->get();

        $this->title = $this->article->title;
        $this->slug = $this->article->slug;
        $this->content = $this->article->content;
        $this->category_id = $this->article->category_id;
    }

    public function render()
    {
        return view('livewire.dashboard.articles.edit');
    }

    public function save()
    {
        $validated = $this->validate();
        $this->article->fill($validated);
        $this->article->save();
        $this->dispatch('saved');
    }

    public function destroy()
    {
        if ($this->article->delete()) {
            session()->flash('success', 'Article deleted successfully.');
            return $this->redirectRoute('dashboard.articles.index');
        }

        session()->flash('error', 'Failed to delete the article.');
        return $this->redirectRoute('dashboard.articles.edit');
    }


    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'regex:/^[a-z0-9-]+$/',
                'unique:articles,slug,' . $this->article->id,
            ],
            'category_id' => 'required|numeric|exists:categories,id',
            'content' => 'nullable|string',
        ];
    }
}
