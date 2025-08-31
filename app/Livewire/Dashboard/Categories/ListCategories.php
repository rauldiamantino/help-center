<?php

namespace App\Livewire\Dashboard\Categories;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Title('Category')]
#[Layout('layouts.dashboard')]
class ListCategories extends Component
{
    public Collection $categories;

    public function mount()
    {
        $companyId = Auth::user()->company_id;

        $this->categories = Category::where('company_id', $companyId)
            ->select('id', 'name', 'category_number')
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard.categories.index');
    }
}
