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
class EditCategory extends Component
{
    public Category $category;
    public Collection $categories;
    public string $name;
    public string $slug;
    public int $status;

    public function mount(int $categoryNumber)
    {
        $companyId = Auth::user()->company_id;

        $this->category = Category::where('category_number', $categoryNumber)
            ->where('company_id', $companyId)
            ->firstOrFail();

        $this->categories = Category::where('company_id', $companyId)
            ->select('id', 'name', 'category_number')
            ->orderBy('updated_at', 'desc')
            ->get();

        $this->name = $this->category->name;
        $this->slug = $this->category->slug;
        $this->status = (int) $this->category->status;
    }

    public function render()
    {
        return view('livewire.dashboard.categories.edit');
    }

    public function save()
    {
        $validated = $this->validate();

        $this->category->fill($validated);
        $this->category->save();

        session()->flash('success', 'Saved.');
        // Update Article Sidebar
        $this->dispatch('articleUpdated');

        return $this->redirectRoute('dashboard.articles.index', ['categoryNumber' => $this->category->category_number]);
    }

    public function destroy()
    {
        if ($this->category->delete()) {
            session()->flash('success', 'Category deleted successfully.');
            return $this->redirectRoute('dashboard.categories.index');
        }

        session()->flash('error', 'Failed to delete the category.');
        return $this->redirectRoute('dashboard.categories.edit');
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'regex:/^[a-z0-9-]+$/',
                'unique:categories,slug,' . $this->category->id,
            ],
            'status' => 'numeric',
        ];
    }
}
