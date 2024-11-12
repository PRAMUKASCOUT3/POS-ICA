<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Expenditure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class CashierController extends Controller
{
    public function index()
    {
        return view('cashier.index');
    }
    public function print()
    {
        $cashier = session('transaction');
        return view('cashier.print', compact('cashier'));
    }

    public function history()
    {
        // Mengambil data transaksi dengan paginasi
        $cashier = Cashier::where('user_id', Auth::id())
            ->with('product') // Include relasi dengan produk
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Menggunakan paginate

        return view('cashier.history', compact('cashier'));
    }

    public function report(Request $request)
    {
        // Query for transactions with optional date filtering
        $query = Cashier::with(['product']);
    
        if ($request->start_date && $request->end_date) {
            // Apply date filtering
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }
    
        // Paginate the filtered or unfiltered results
        $cashier = $query->paginate(10);

        $expenditure = Expenditure::all();
    
        return view('cashier.laporan', compact('cashier','expenditure'));
    }
    


    public function generatePDF(Request $request)
    {
        // Query for transactions with optional date filtering
        $query = Cashier::with('product');

        if ($request->start_date && $request->end_date) {
            // Apply date filtering
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        // Get the filtered or unfiltered results
        $cashier = $query->get();
        $expenditure = Expenditure::all();
        // Prepare data for the PDF view
        $data = [
            'title' => 'Laporan Transaksi',
            'cashier' => $cashier,
            'user' => Auth::user(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'expenditure' => $expenditure
        ];

        // Generate and download the PDF
        $pdf = PDF::loadView('cashier.pdf', $data);
        return $pdf->download('Laporan_Transaksi.pdf');
    }
}
