<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryCreate extends Component
{
    public $name;

    protected $rules =[
        'name' =>'required|string|max:50',
    ];
    public function render()
    {
        return view('livewire.category.category-create');
    }

    public function save()
    {
        $this->validate();

        Category::create(['name' => $this->name]);

        toastr()->success('Data Berhasil Ditambahkan!');

        $this->reset(['name']);

        redirect()->route('category.index');
    }

}
