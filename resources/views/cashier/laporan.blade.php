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
                                <th>Nama Kasir <i class="fas fa-user"></i></th>
                                <th>Kode Transaksi <i class="fas fa-code"></i></th>
                                <th>Tanggal <i class="fas fa-calendar-alt"></i></th>
                                <th>Nama Produk <i class="fas fa-file-signature"></i></th>
                                <th>Jumlah Produk <i class="fas fa-cubes"></i></th>
                                <th>Subtotal <i class="fas fa-dollar-sign"></i></th>
                                <th>Bayar <i class="fas fa-hand-holding-usd"></i></th>
                                <th>Status <i class="fas fa-stream"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 0;
                                $groupedCashier = $cashier->groupBy('code');
                            @endphp
                            @foreach ($groupedCashier as $code => $items)
                                <tr>
                                    <td>{{ ++ $no }}</td>
                                    <td rowspan="{{ $items->count() }}">{{ $items->first()->user->name }}</td>
                                    <td rowspan="{{ $items->count() }}">{{ $code }}</td>
                                    <td rowspan="{{ $items->count() }}">{{ $items->first()->date }}</td>
                                    <td>{{ $items->first()->product->name }}</td>
                                    <td>{{ $items->first()->total_item }}</td>
                                    <td rowspan="{{ $items->count() }}">Rp.
                                        {{ number_format($items->sum('subtotal'), 0, ',', '.') }}
                                    </td>
                                    <td rowspan="{{ $items->count() }}">Rp.
                                        {{ number_format($items->first()->amount_paid, 0, ',', '.') }}
                                    </td>
                                    <td rowspan="{{ $items->count() }}">
                                        <span
                                            class="btn bedge bg-success text-white">{{ ucfirst($items->first()->status) }}</span>
                                    </td>
                                </tr>
                                @foreach ($items->slice(1) as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->total_item }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total Pendapatan <i class="fas fa-hand-holding-usd"></i></td>
                                <td colspan="4"></td>
                                <td>Rp. {{ number_format($total_pendapatan, 2, ',', '.') }}</td>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td>Pengeluaran <i class="fas fa-file-invoice-dollar"></i></td>
                                <td colspan="4"></td>
                                <td>Rp. {{ number_format($pengeluaran, 2, ',', '.') }}</td>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td>Total Keseluruhan <i class="fas fa-money-check-alt"></i></td>
                                <td colspan="4"></td>
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
