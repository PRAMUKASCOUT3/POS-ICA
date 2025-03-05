<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Labar Rugi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body onload = "window.print()">
    <div class="container py-4">
        <div class="card shadow-lg rounded-3">
            <div class="card-body">
                <div class="text-center mb-4">
                    <h4 class="fw-bold">Laporan Laba Rugi</h4>
                    <p class="mb-1">MEUBEL LE'KOYO</p>
                    <p class="text-muted">Periode {{ $periode }}</p>
                </div>
                <table class="table table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Keterangan</th>
                            <th class="text-end">Jumlah (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-success">
                            <td><strong>Total Penjualan</strong></td>
                            <td class="text-end">{{ number_format($total_penjualan) }}</td>
                        </tr>
                        <tr>
                            <td>Penjualan Bersih</td>
                            <td class="text-end">{{ number_format($penjualan_bersih) }}</td>
                        </tr>
                        <tr class="table-info">
                            <td><strong>Total Pendapatan</strong></td>
                            <td class="text-end fw-bold">{{ number_format($total_pendapatan) }}</td>
                        </tr>
                        <tr class="table-warning">
                            <td><strong>Total Beban</strong></td>
                            <td class="text-end">{{ number_format($total_beban) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Laba Sebelum Pajak</strong></td>
                            <td class="text-end fw-bold">{{ number_format($laba_sebelum_pajak) }}</td>
                        </tr>
                        <tr>
                            <td>Pajak (11%)</td>
                            <td class="text-end">{{ number_format($pajak) }}</td>
                        </tr>
                        <tr class="table-success">
                            <td><strong>Laba Bersih</strong></td>
                            <td class="text-end fw-bold">{{ number_format($laba_bersih) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
