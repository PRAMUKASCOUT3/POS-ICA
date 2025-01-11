@extends('layouts.master')

@section('content')
    @php
        $user = \App\Models\User::where('isAdmin', 0)->count();
        $product = \App\Models\Product::count();
        $category = \App\Models\Category::count();
        $supplier = \App\Models\Supplier::count();

    @endphp

    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                </div>
            </div>
            @if (Auth()->user()->isAdmin == 2)
                <div class="row row-card-no-pd">
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4><b>Pengguna/Kasir</b></h4>
                                    </div>
                                    <h4 class="text-info fw-bold">
                                        <li class="fas fa-users"></li> {{ $user }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4><b>Produk</b></h4>
                                    </div>
                                    <h4 class="text-success fw-bold">
                                        <li class="fas fa-boxes"></li> {{ $product }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4><b>Kategori</b></h4>
                                    </div>
                                    <h4 class="text-danger fw-bold">
                                        <li class="fas fa-clipboard-list"></li> {{ $category }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4><b>Supplier</b></h4>
                                    </div>
                                    <h4 class="text-secondary fw-bold">
                                        <li class="fas fa-dolly-flatbed"></li> {{ $supplier }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Statistik Transaksi</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Keuntungan penjualan <i class="fas fa-calendar"></i></div>
                            </div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="mb-4 mt-2">
                                <h1>Rp. {{ number_format($profitThisMonth) }}</h1>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        var options = {
            chart: {
                type: 'bar',
            },
            series: [{
                name: 'Jumlah Transaksi',
                data: [{{ implode(',', $completedPercentages) }}]
            }],
            xaxis: {
                categories: [
                    '{{ now()->subMonths(11)->format('M') }}',
                    '{{ now()->subMonths(10)->format('M') }}',
                    '{{ now()->subMonths(9)->format('M') }}',
                    '{{ now()->subMonths(8)->format('M') }}',
                    '{{ now()->subMonths(7)->format('M') }}',
                    '{{ now()->subMonths(6)->format('M') }}',
                    '{{ now()->subMonths(5)->format('M') }}',
                    '{{ now()->subMonths(4)->format('M') }}',
                    '{{ now()->subMonths(3)->format('M') }}',
                    '{{ now()->subMonths(2)->format('M') }}',
                    '{{ now()->subMonths(1)->format('M') }}',
                    '{{ now()->format('M') }}'
                ]
            },
            title: {
                text: 'Persentase Penyelesaian Transaksi (12 Bulan Terakhir)',
                align: 'left'
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endsection
