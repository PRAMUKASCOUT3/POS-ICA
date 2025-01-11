<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductEdit extends Component
{
    public $product_id;
    public $id_category, $name, $brand, $stock, $price_buy, $price_sell, $unit;

    public function mount($product)
    {
        $this->product_id = $product->id_product;
        $this->id_category = $product->id_category;  // Ensure this is correctly assigned
        $this->name = $product->name;
        $this->brand = $product->brand;
        $this->stock = $product->stock;
        $this->price_buy = $product->price_buy;
        $this->price_sell = $product->price_sell;
        $this->unit = $product->unit;
    }


    public function update()
    {
        $this->validate([
            'id_category' => 'required',
            'name' => 'required',
            'brand' => 'required',
            'stock' => 'required',
            'price_buy' => 'required',
            'price_sell' => 'required',
            'unit' => 'required',
        ]);
        // Update data produk di database
        $product = Product::find($this->product_id);
        $product->id_category = $this->id_category;
        $product->name = $this->name;
        $product->brand = $this->brand;
        $product->stock = $this->stock;
        $product->price_buy = $this->price_buy;
        $product->price_sell = $this->price_sell;
        $product->unit = $this->unit;
        $product->save();
        return redirect()->route('product.index')->with('success','Data Berhasil Diubah');
    }
    public function render()
    {
        return view('livewire.product.product-edit', [
            'category' => Category::all()
        ]);
    }
}
