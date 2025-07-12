<?php

namespace App\Livewire\Dashboard\Articles;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Collection;
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
    public int $status;

    public function mount(int $articleNumber)
    {
        $companyId = Auth::user()->company_id;

        $this->article = Article::where('article_number', $articleNumber)
            ->where('company_id', $companyId)
            ->firstOrFail();

        $this->categories = Category::where('company_id', $companyId)
            ->select('id', 'name', 'category_number')
            ->orderBy('updated_at', 'desc')
            ->get();

        $this->title = $this->article->title;
        $this->slug = $this->article->slug;
        $this->category_id = $this->article->category_id;
        $this->status = $this->article->status;

        if (is_array($this->article->content)) {
            $this->content = json_encode($this->article->content);
        } elseif (is_string($this->article->content) && $this->article->content !== '') {
            $this->content = $this->article->content;
        } else {
            $this->content = json_encode([
                'time' => now()->timestamp,
                'blocks' => [],
                'version' => '2.29.0',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.articles.edit');
    }

    public function save()
    {
        $this->dispatch('saveEditorContent');

        $validated = $this->validate();

        if (is_array($validated['content'])) {
            $validated['content'] = json_encode($validated['content']);
        }

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
            'status' => 'numeric',
        ];
    }
}
