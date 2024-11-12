<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
    public function create()
    {
        $category = Category::all();
        return view('products.create',compact('category'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('products.edit',compact('product','category'));
    }

    public function report()
    {
        $products = Product::all();
        return view('products.laporan',compact('products'));
    }

    public function generatePDF()
    {
        $data = [
            'title' => 'Laporan Produk',
            'products' => Product::all(),
            'user' => Auth::user()
        ];
        $pdf = PDF::loadView('products.print', $data);
        return $pdf->download('Laporan_Produk.pdf');
    }
}
