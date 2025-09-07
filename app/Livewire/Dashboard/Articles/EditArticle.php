<?php

namespace App\Livewire\Dashboard\Articles;

use App\Models\Upload;
use App\Models\Article;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\Articles\CleanupOrphanUploads;

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
        $this->content = $this->article->content;
        $this->category_id = $this->article->category_id;
        $this->status = $this->article->status;
    }

    public function render()
    {
        return view('livewire.dashboard.articles.edit');
    }

    public function save()
    {
        $validated = $this->validate();

        $this->article->fill($validated);

        CleanupOrphanUploads::handle(Article::class, $this->article->id, $this->extractImageUrls());

        $this->article->save();

        $this->dispatch('show-flash', message: 'Saved.');
        $this->dispatch('articleUpdated');
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

    private function extractImageUrls(): array
    {
        $content = json_decode($this->article->content, true);
        $contentBlocks = $content['blocks'] ?? [];

        $images = [];
        foreach ($contentBlocks as $block) {

            if (! isset($block['type']) || $block['type'] !== 'image') {
                continue;
            }

            if (isset($block['data']['file']['url']) and $block['data']['file']['url']) {
                $images[] = str_replace('/storage/', '', $block['data']['file']['url']);
            }
        }

        return $images;
    }
}
