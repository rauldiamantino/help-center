<?php

namespace App\Livewire\Articles;

use Livewire\Component;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Articles')]
#[Layout('layouts.dashboard')]
class ListArticles extends Component
{
    public $articles;

    public function mount()
    {
        $this->articles = Article::where('company_id', Auth::user()->company_id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard.articles.index');
    }
}
