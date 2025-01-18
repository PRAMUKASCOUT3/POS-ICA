<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 12px;
            }
    
            .container {
                margin: 20px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                border: 1px solid #ddd;
            }
    
            .card-header {
                background-color: #007bff;
                color: white;
                padding: 10px;
                border-radius: 5px;
                text-align: center;
                font-size: 18px;
            }
    
            .table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
    
            .table th,
            .table td {
                border: 1px solid #dee2e6;
                padding: 8px;
                text-align: center;
                vertical-align: middle;
            }
    
            .table th {
                background-color: #f8f9fa;
                font-weight: bold;
            }
    
            .tfoot td {
                font-weight: bold;
                background-color: #f1f1f1;
            }
    
            .signature {
                margin-top: 30px;
                text-align: right;
            }
    
            .signature span {
                display: inline-block;
            }
    
            .signature u {
                margin-top: 30px;
                display: block;
                font-weight: bold;
            }
        </style>
        
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-4">{{ $title }}</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped mt-2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Produk</th>
                            <th>Kategori</th>
                            <th>Nama Produk</th>
                            <th>Merk Produk</th>
                            <th>Stok</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Satuan</th>
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
                                        $total_sold = $item->transaction->sum('total_item'); // Using the 'transaction' relationship
                                        // Calculate the original stock
                                        $original_stock = $item->stock + $total_sold;

                                        $origin_price_buy = $original_stock * $item->price_buy 
                                    @endphp
                                    <td>{{ $original_stock }}</td>
                                @endif
                                @php
                                // Calculate total items sold for this product
                                $total_sold = $item->transaction->sum('total_item'); // Using the 'transaction' relationship
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
                            $total_sold = $product->transaction->sum('total_item'); // Using the 'transaction' relationship
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

                <div class="signature">
                    @php
                        $tanggal = \Carbon\Carbon::now()->format('Y-m-d');
                    @endphp
                    <span>{{ $tanggal }}</span>, <span>Jambi</span>
                    <br><br><br><br><br>
                    <span><u>{{ $user->name }}</u></span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>