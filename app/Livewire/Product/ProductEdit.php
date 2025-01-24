<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductEdit extends Component
{
    public $product_id;
    public $id_category, $name, $brand, $stock, $price_buy, $price_sell, $unit;
    public $new_stock = 0;

    public function mount($product)
    {
        // Inisialisasi data produk
        $this->product_id = $product->id_product;
        $this->id_category = $product->id_category;
        $this->name = $product->name;
        $this->brand = $product->brand;
        $this->stock ; // Tambahkan stok baru, mulai dari 0
        $this->price_buy = $product->price_buy;
        $this->price_sell = $product->price_sell;
        $this->unit = $product->unit;

        // Inisialisasi stok baru sama dengan stok lama
        $this->new_stock = $product->stock;
    }

    public function updatedStock()
    {
        // Hitung stok baru secara dinamis
        $product = Product::find($this->product_id);
        $this->new_stock = $product->stock + (int)$this->stock;
    }

    public function update()
    {
        $this->validate([
            'id_category' => 'required',
            'name' => 'required|string|max:30',
            'brand' => 'required|string|max:30',
            'stock' => 'required|integer',
            'price_buy' => 'required|numeric',
            'price_sell' => 'required|numeric',
            'unit' => 'required|string|max:20',
        ]);
        // Update data produk
        Product::find($this->product_id)->update([
            'id_category' => $this->id_category,
            'name' => $this->name,
            'brand' => $this->brand,
            'stock' => $this->new_stock,
            'price_buy' => $this->price_buy,
            'price_sell' => $this->price_sell,
            'unit' => $this->unit,
        ]);
        return redirect()->route('product.index')->with('success','Data Berhasil Diubah');
    }

    public function render()
    {
        return view('livewire.product.product-edit', [
            'category' => Category::all(),
            'product' => Product::find($this->product_id),
        ]);
    }
}