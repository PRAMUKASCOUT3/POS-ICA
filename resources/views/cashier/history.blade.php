@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Data Riwayat Transaksi <i class="fas fa-history"></i></h5>
                <div>
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Transaksi <i class="fas fa-code"></i></th>
                                <th>Tanggal <i class="fas fa-calendar-alt"></i></th>
                                <th>Subtotal <i class="fas fa-dollar-sign"></i></th>
                                <th>Bayar <i class="fas fa-hand-holding-usd"></i></th>
                                <th>Status <i class="fas fa-stream"></i></th>
                                <th>Aksi <i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 0;
                            @endphp
                            @foreach ($cashier as $index => $transactions)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transactions->first()->code }}</td>
                                    <td>{{ $transactions->first()->date }}</td>
                                    <td>Rp. {{ number_format($transactions->sum('subtotal'), '0') }}</td>
                                    <td>Rp. {{ number_format($transactions->first()->amount_paid, '0') }}</td>
                                    <td><span class="badge bg-success">{{ $transactions->first()->status }}</span></td>
                                    <td>
                                        <a href="{{ route('cashier.show', $transactions->first()->code) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('cashier.reprint', $transactions->first()->code) }}" class="btn btn-sm btn-warning" target="_blank">
                                            <i class="fas fa-print"></i> Print Struk Ulang
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    

                </div>
            </div>
        </div>
    </div>
@endsection
