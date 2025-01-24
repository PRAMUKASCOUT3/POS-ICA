@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <!-- Date filter form -->
                <div class="d-flex align-items-center mb-4">
                    <!-- PDF Download Form -->
                    <form action="{{ route('cashier.pdf') }}" method="GET" style="margin-right: 10px">
                        <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                        <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                        <button type="submit" class="btn btn-danger">Download PDF <i class="fas fa-file-pdf"></i></button>
                    </form>
                    <form action="{{ route('cashier.excel') }}" method="GET" style="margin-right: 10px">
                        <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                        <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                        <button type="submit" class="btn btn-success">Download Excel <i class="fas fa-file-excel"></i></button>
                    </form>
                
                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('cashier.report') }}" class="d-flex align-items-center">
                        <div class="d-flex align-items mb-4" style="gap: 10px;">
                            <div>
                                <label for="start_date">Tanggal Mulai:</label>
                                <input type="date" name="start_date" class="form-control"
                                    value="{{ request('start_date') }}">
                            </div>
                            <div>
                                <label for="end_date">Tanggal Akhir:</label>
                                <input type="date" name="end_date" class="form-control"
                                    value="{{ request('end_date') }}">
                            </div>
                        </div>
                        <div class="d-flex align-items" style="gap: 10px; margin-left: 10px;">
                            <button type="submit" class="btn btn-primary">Filter <i class="fas fa-filter fa-xs"></i></button>
                            <a href="{{ route('cashier.report') }}" class="btn btn-danger">Reset <i class="fas fa-sync-alt fa-xs"></i></a>
                        </div>
                    </form>
                </div>
                
                <!-- Transaction report table -->
                <h5 class="card-title">Laporan Transaksi</h5>
                <div class="table-responsive">
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
                                        <a href="{{ route('cashier.show', $transactions->first()->code) }}">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total Pendapatan <i class="fas fa-hand-holding-usd"></i></td>
                                <td colspan="2"></td>
                                <td>Rp. {{ number_format($total_pendapatan, 2, ',', '.') }}</td>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td>Pengeluaran <i class="fas fa-file-invoice-dollar"></i></td>
                                <td colspan="2"></td>
                                <td>Rp. {{ number_format($pengeluaran, 2, ',', '.') }}</td>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td>Total Penjualan Bersih <i class="fas fa-money-check-alt"></i></td>
                                <td colspan="2"></td>
                                <td>Rp. {{ number_format($total_semua, 2, ',', '.') }}</td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                        
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
