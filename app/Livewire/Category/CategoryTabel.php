<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryTabel extends Component
{
    public $categories;
    protected $listeners = ['DeleteUser' => 'render'];

    public function mount()
    {
        $this->categories = Category::orderBy('created_at','desc')->get();
    }
    public function render()
    {
        return view('livewire.category.category-tabel',[
            'categories' => $this->categories,
        ]);
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        toastr()->success('Data Berhasil Dihapus!');

        $this->dispatch('DeleteUser');
    }
}
