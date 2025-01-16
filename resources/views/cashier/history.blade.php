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
                            // Mengelompokkan transaksi berdasarkan kode transaksi
                            $groupedCashier = $cashier->groupBy('code');
                        @endphp
    
                        @forelse ($groupedCashier as $code => $items)
                            <tr>
                                <!-- Mengambil data dari transaksi pertama dalam grup -->
                                <td rowspan="{{ $items->count() }}">{{ $code }}</td>
                                <td rowspan="{{ $items->count() }}">{{ $items->first()->date }}</td>
                                
                                <!-- Menampilkan produk pertama di baris pertama -->
                                <td>{{ $items->first()->product->name }}</td>
                                <td>{{ $items->first()->total_item }}</td>
                                <td rowspan="{{ $items->count() }}">Rp. {{ number_format($items->sum('subtotal'), 0, ',', '.') }}</td>
                                <td rowspan="{{ $items->count() }}">Rp. {{ number_format($items->first()->amount_paid, 0, ',', '.') }}</td>
                                <td rowspan="{{ $items->count() }}"><span class="btn bedge bg-success text-white">{{ ucfirst($items->first()->status) }}</span></td>
                            </tr>
    
                            <!-- Menampilkan produk lainnya dalam baris baru, jika ada -->
                            @foreach ($items->slice(1) as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->total_item }}</td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection