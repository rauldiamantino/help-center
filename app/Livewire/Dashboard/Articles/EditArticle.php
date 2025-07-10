<?php

namespace App\Livewire\Dashboard\Articles;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Articles')]
#[Layout('layouts.dashboard')]
class EditArticle extends Component
{
    public Article $article;
    public string $title;
    public string $slug;
    public string $content;

    public function mount(int $articleNumber)
    {
        $companyId = Auth::user()->company_id;

        $this->article = Article::where('article_number', $articleNumber)
            ->where('company_id', $companyId)
            ->firstOrFail();

        $this->title = $this->article->title;
        $this->slug = $this->article->slug;
        $this->content = $this->article->content;
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
            'content' => 'nullable|string',
        ];
    }
}
