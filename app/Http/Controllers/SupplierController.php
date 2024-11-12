<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index()
    {
        // Retrieve all the suppliers from the database
        $suppliers = Supplier::all();

        // Return the suppliers in a view
        return view('suppliers.index', compact('suppliers'));
    }
    public function edit($id)
    {
        // Retrieve the supplier details from the database
        $suppliers = Supplier::find($id);

        // Return the supplier details in a view
        return view('suppliers.edit', compact('suppliers'));
    }
}
