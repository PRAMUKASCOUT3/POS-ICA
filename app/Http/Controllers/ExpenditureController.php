<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
{
    public function index()
    {
        $expenditures = Expenditure::all();

        return view('expenditures.index', compact('expenditures'));
    }
    public function edit($id)
    {
        $expenditure = Expenditure::find($id);

        return view('expenditures.edit', compact('expenditure'));
    }
}
