@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Detail Transaksi {{ $cashier->first()->code }}</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal <i class="fas fa-calendar-alt"></i></th>
                            <th>Nama Produk <i class="fas fa-file-signature"></i></th>
                            <th>Jumlah Produk <i class="fas fa-cubes"></i></th>
                            <th>Subtotal <i class="fas fa-dollar-sign"></i></th>
                            <th>Diskon <i class="fas fa-percent"></i></th>
                            <th>Total Setelah Diskon <i class="fas fa-tags"></i></th>
                            <th>Bayar <i class="fas fa-hand-holding-usd"></i></th>
                            <th>Status <i class="fas fa-stream"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cashier as $transaction)
                        <tr>
                            <td>{{ $transaction->date }}</td>
                            <td>{{ $transaction->product->name }}</td>
                            <td>{{ $transaction->total_item }}</td>
                            <td>Rp. {{ number_format($transaction->subtotal,'0') }}</td>
                            <td>{{ $transaction->discount }}%</td>
                            <td>Rp. {{ number_format($transaction->subtotal * (1 - ($transaction->discount / 100)), '0') }}</td>
                            <td>Rp. {{ number_format($transaction->amount_paid,'0') }}</td>
                            <td><span class="badge bg-success">{{ $transaction->status }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
@endsection
