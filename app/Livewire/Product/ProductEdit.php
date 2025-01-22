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
        // Update data produk
        $product = Product::find($this->product_id);
        $product->id_category = $this->id_category;
        $product->name = $this->name;
        $product->brand = $this->brand;
        $product->stock = $this->new_stock; // Gunakan jumlah stok baru
        $product->price_buy = $this->price_buy;
        $product->price_sell = $this->price_sell;
        $product->unit = $this->unit;
        $product->save();
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