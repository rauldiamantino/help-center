<?php

namespace App\Livewire\Articles;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class ArticlesManager extends Component
{
    public ?int $selectedArticleId = null;
    protected $listeners = ['showArticle', 'backToList'];


    public function showArticle(array $payload)
    {
        $this->selectedArticleId = $payload['id'];
    }

    public function backToList()
    {
        $this->selectedArticleId = null;
    }

    public function render()
    {
        return view('livewire.articles.articles-manager');
    }
}
