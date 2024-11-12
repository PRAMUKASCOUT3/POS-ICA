<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::all();
        return view('categorys.index', compact('categorys'));
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categorys.edit', compact('category'));
    }
}
