<?php

namespace App\Livewire\Dashboard\Categories;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Categories')]
#[Layout('layouts.dashboard')]
class CreateCategory extends Component
{
    public Collection $categories;
    public Collection $categoriesSelect;
    public string $name;
    public string $slug;
    public ?string $categoryNumber;

    public function mount()
    {
        $companyId = Auth::user()->company_id;
        $this->categoryNumber = null;

        $this->categories = Category::where('company_id', $companyId)
            ->select('id', 'name', 'category_number')
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard.categories.create');
    }

    public function save()
    {
        $this->validate();

        $category = Category::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'company_id' => Auth::user()->company_id,
            'user_id' => Auth::id(),
        ]);

        session()->flash('success', 'Saved.');
        // Update Article Sidebar
        $this->dispatch('articleUpdated');

        return $this->redirectRoute('dashboard.articles.index', ['categoryNumber' => $category->category_number]);
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'regex:/^[a-z0-9-]+$/',
                'unique:categories,slug',
            ],
        ];
    }
}
