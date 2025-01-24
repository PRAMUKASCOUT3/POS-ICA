<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryEdit extends Component
{
    public $category_id, $name;

    public function mount($category)
    {
        $this->category_id = $category->id_category; // Sesuai dengan kolom primary key
        $this->name = $category->name;
    }

    public function render()
    {
        return view('livewire.category.category-edit', [
            'category' => Category::find($this->category_id) // Laravel akan mencari berdasarkan id_category
        ]);
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:50',
        ]);

        $category = Category::find($this->category_id); // Laravel akan menggunakan id_category
        $category->name = $this->name;
        $category->save();

        toastr()->success('Data Berhasil Diubah!');

        return redirect()->route('category.index');
    }
}
