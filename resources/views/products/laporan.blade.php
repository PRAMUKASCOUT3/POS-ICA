@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('product.print') }}" class="btn btn-danger mb-3">Download PDF <i class="fas fa-file-pdf"></i></a>
                <h5 class="card-title">Laporan Produk</h5>
                <table id="example" class="table table-striped mt-2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Produk <i class="fas fa-code"></i></th>
                            <th>Kategori <i class="fas fa-clipboard-list"></i></th>
                            <th>Nama Produk <i class="fas fa-file-signature"></i></th>
                            <th>Merk Produk <i class="fas fa-tag"></i></th>
                            <th>Stok <i class="fas fa-cubes"></i></th>
                            <th>Harga Beli <i class="fas fa-money-check-alt"></i></th>
                            <th>Harga Jual <i class="fas fa-hand-holding-usd"></i></th>
                            <th>Satuan <i class="fab fa-unity"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->brand }}</td>
                                @if ($item->stock == 0)
                                    <span class="badge bg-danger text-white">Stock Habis</span>
                                @else
                                    @php
                                        // Calculate total items sold for this product
                                        $total_sold = $item->cashiers->sum('total_item'); // Using the 'cashiers' relationship
                                        // Calculate the original stock
                                        $original_stock = $item->stock + $total_sold;

                                        $origin_price_buy = $original_stock * $item->price_buy;
                                    @endphp
                                    <td>{{ $original_stock }}</td>
                                @endif
                                @php
                                    // Calculate total items sold for this product
                                    $total_sold = $item->cashiers->sum('total_item'); // Using the 'cashiers' relationship
                                    // Calculate the original stock
                                    $original_stock = $item->stock + $total_sold;

                                    $origin_price_buy = $original_stock * $item->price_buy;
                                    $origin_price_sell = $original_stock * $item->price_sell;
                                @endphp
                                <td>Rp.{{ number_format($origin_price_buy) }}</td>
                                <td>Rp.{{ number_format($origin_price_sell) }}</td>
                                <td>{{ $item->unit }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    @php
                        $total_buy = 0;
                        $total_sell = 0;

                        foreach ($products as $product) {
                            $total_sold = $product->cashiers->sum('total_item'); // Using the 'cashiers' relationship
                            // Calculate the original stock
                            $original_stock = $product->stock + $total_sold;
                            $total_buy += $original_stock * $product->price_buy;
                            $total_sell += $original_stock * $product->price_sell;
                        }
                    @endphp
                    <tr>
                        <td colspan="6"><b>Total</b></td>
                        <td><b>Rp.{{ number_format($total_buy) }}</b></td>
                        <td><b>Rp.{{ number_format($total_sell) }}</b></td>
                        <td></td> <!-- Make sure to leave a cell empty if not used -->
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
