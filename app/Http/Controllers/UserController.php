<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Transaction;
use App\Models\Expenditure;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('user.detail', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id); // Laravel akan mencari berdasarkan id_user

    $request->validate([
        'name' => 'required|string|max:30',
        'email' => 'nullable|email|max:50|unique:users,email,' . $id . ',id_user', // Validasi email
        'password' => 'nullable|min:8',
    ]);

    // Update data user
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
    }

    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');
}

    


    public function dashboard()
    {
        $completedPercentages = [];
        $totalTransactionCodes = [];

        // Loop through the last 12 months
        for ($i = 11; $i >= 0; $i--) {
            // Get the start and end of the month
            $startOfMonth = now()->subMonths($i)->startOfMonth();
            $endOfMonth = now()->subMonths($i)->endOfMonth();

            // Get total transactions (based on distinct codes) for the month
            $totalTransactions = Transaction::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->distinct('code')
                ->count('code');

            // Store total transaction codes count for each month
            $totalTransactionCodes[] = $totalTransactions;

            // Calculate the percentage of completed transactions
            if ($totalTransactions > 0) {
                $completedPercentages[] = $totalTransactions; // Just store the count of transaction codes
            } else {
                $completedPercentages[] = 0; // If there are no transactions, store 0
            }
        }

        // Calculate subtotal and expenditure for the current month
        $startOfCurrentMonth = now()->startOfMonth();
        $endOfCurrentMonth = now()->endOfMonth();

        $cashierThisMonth = Transaction::whereBetween('created_at', [$startOfCurrentMonth, $endOfCurrentMonth])
            ->sum('subtotal');
        $expenditureThisMonth = Expenditure::whereBetween('date', [$startOfCurrentMonth, $endOfCurrentMonth])
            ->sum('nominal');
        $profitThisMonth = $cashierThisMonth - $expenditureThisMonth;

        // Calculate total profit overall
        $cashier = Transaction::sum('subtotal');
        $expenditure = Expenditure::sum('nominal');
        $total_semua = $cashier - $expenditure;

        // Pass the data to the view
        return view('dashboard', compact(
            'completedPercentages',
            'totalTransactionCodes',
            'total_semua',
            'profitThisMonth'
        ));
    }


    public function report()
    {
        $users = User::where('isAdmin', 0)->paginate(10);
        return view('user.laporan', compact('users'));
    }

    public function generatePDF()
    {
        $data = [
            'title' => 'Laporan Pengguna/Kasir',
            'user' => User::where('isAdmin', 0)->get(),
        ];
        $pdf = PDF::loadView('user.print', $data);
        return $pdf->download('Laporan_Pengguna_Kasir.pdf');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return redirect()->route('pengguna.index')->with('success', 'Data Berhasil Dihapus');
    }
}
