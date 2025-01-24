<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductCreate extends Component
{
    public $id_category, $name, $brand, $stock, $price_buy, $price_sell, $unit;
    public $code; // Auto-generated product code

    // Rules for validation
    protected $rules = [
        'id_category' => 'required',
        'name' => 'required|string|max:30',
        'brand' => 'required|string|max:30',
        'stock' => 'required|integer|max:5',
        'price_buy' => 'required|numeric',
        'price_sell' => 'required|numeric',
        'unit' => 'required|string|max:20',
    ];

    public function mount()
    {
        $this->code = 'BR' . str_pad(Product::max('id_product') + 1, 4, '0', STR_PAD_LEFT); // Auto-generate product code
    }

    // Save the product
    public function save()
    {
        $validatedData = $this->validate([
            'id_category' => 'required',
            'name' => 'required|string',
            'brand' => 'required|string',
            'stock' => 'required|integer',
            'price_buy' => 'required|numeric',
            'price_sell' => 'required|numeric',
            'unit' => 'required|string',
        ]);

        Product::create([
            'code' => $this->code,
            'id_category' => $this->id_category,
            'name' => $this->name,
            'brand' => $this->brand,
            'stock' => $this->stock,
            'price_buy' => $this->price_buy,
            'price_sell' => $this->price_sell,
            'unit' => $this->unit,
        ]);

        toastr()->success('Data Berhasil Ditambahkan!');

        $this->reset(['id_category', 'name', 'brand', 'stock', 'price_buy', 'price_sell', 'unit']);

        $this->code = 'BR' . str_pad(Product::max('id_product') + 1, 4, '0', STR_PAD_LEFT);

        return redirect()->route('product.index');
    }
    public function render()
    {
        return view('livewire.product.product-create', [
            'category' => Category::all()
        ]);
    }
}
