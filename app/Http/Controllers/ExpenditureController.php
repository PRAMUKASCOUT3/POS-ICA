<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use Carbon\Carbon;
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

    public function delete($id)
    {
        $expenditure = Expenditure::find($id);
        $expenditure->delete();
        return redirect()->route('expenditures.index')->with('success','Data Berhasil Dihapus');
    }

    public function show()
    {
        $expenditures = Expenditure::all();
        return view('expenditures.riwayat',compact('expenditures'));
    }
}
