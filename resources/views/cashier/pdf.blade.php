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
    <div class="container">
        <div class="card" style="margin: 20px 0; padding: 15px;">
            <div class="card-header">
                <h2>{{ $title }}</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Kasir</th>
                            <th>Kode Transaksi</th>
                            <th>Tanggal</th>
                            <th>Nama Produk</th>
                            <th>Jumlah Produk</th>
                            <th>Subtotal</th>
                            <th>Bayar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $groupedCashier = $cashier->groupBy('code');
                        @endphp
                        @foreach ($groupedCashier as $code => $items)
                            <tr>
                                <td rowspan="{{ $items->count() }}">{{ $items->first()->user->name }}</td>
                                <td rowspan="{{ $items->count() }}">{{ $code }}</td>
                                <td rowspan="{{ $items->count() }}">{{ $items->first()->date }}</td>
                                <td>{{ $items->first()->product->name }}</td>
                                <td>{{ $items->first()->total_item }}</td>
                                <td rowspan="{{ $items->count() }}">Rp.
                                    {{ number_format($items->sum('subtotal'), 0, ',', '.') }}</td>
                                <td rowspan="{{ $items->count() }}">Rp.
                                    {{ number_format($items->first()->amount_paid, 0, ',', '.') }}</td>
                                <td rowspan="{{ $items->count() }}">
                                    <span class="badge bg-success">{{ ucfirst($items->first()->status) }}</span>
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
                            <td colspan="5" class="text-end">Total Pendapatan</td>
                            <td>Rp. {{ number_format($total_pendapatan, 2, ',', '.') }}</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-end">Pengeluaran</td>
                            <td>Rp. {{ number_format($total_pengeluaran, 2, ',', '.') }}</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-end">Total Penjualan Bersih</td>
                            <td>Rp. {{ number_format($total_keseluruhan, 2, ',', '.') }}</td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
                <div class="signature">
                    @php
                        $tanggal = \Carbon\Carbon::now()->format('Y-m-d');
                    @endphp
                    <span>{{ $tanggal }}, Jambi</span>
                    <br><br><br>
                    <u>{{ $user->name }}</u>
                </div>
            </div>
        </div>
    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>

</html>