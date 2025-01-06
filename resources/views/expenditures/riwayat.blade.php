@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Riwayat Data Pengeluaran <i class="fas fa-file-invoice-dollar"></i></h5>
                <div class="table-responsive">
                    <a href="{{ route('expenditures.index') }}" class="btn btn-warning mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal <i class="fas fa-calendar-alt"></i></th>
                                <th>Deskripsi Pengeluaran <i class="fas fa-paragraph"></i></th>
                                <th>Nominal Pengeluaran <i class="fas fa-dollar-sign"></i></th>
                            </tr>
                        </thead>
                        @php
                            use Carbon\Carbon;
                    
                            $expenditures = $expenditures->sortBy('date'); // Urutkan data berdasarkan tanggal
                            $currentMonth = null; // Untuk menyimpan bulan saat ini
                            $currentIndex = 1; // Untuk indeks yang dimulai dari 1 per bulan
                            $totalThisMonth = 0; // Untuk total nominal bulan ini
                        @endphp
                    
                        <tbody>
                            @foreach ($expenditures as $item)
                                @php
                                    $itemMonth = Carbon::parse($item->date)->format('Y-m'); // Format bulan sebagai "Tahun-Bulan"
                                @endphp
                    
                                {{-- Jika bulan berubah, reset indeks dan tampilkan total untuk bulan sebelumnya --}}
                                @if ($currentMonth !== $itemMonth)
                                    @if (!is_null($currentMonth))
                                        {{-- Jika bukan iterasi pertama --}}
                                        <tr>
                                            <td colspan="3" class="text-center"><strong>Total Pengeluaran Bulan
                                                    {{ Carbon::parse($currentMonth . '-01')->translatedFormat('F Y') }}</strong>
                                            </td>
                                            <td colspan="1"><strong>Rp. {{ number_format($totalThisMonth) }}</strong></td>
                                        </tr>
                                        @php
                                            $totalThisMonth = 0; // Reset total untuk bulan baru
                                        @endphp
                                    @endif
                    
                                    {{-- Set bulan saat ini dan reset indeks --}}
                                    @php
                                        $currentMonth = $itemMonth;
                                        $currentIndex = 1;
                                    @endphp
                    
                                    {{-- Header untuk bulan baru --}}
                                    <tr>
                                        <td colspan="4" class="text-center"><strong>Bulan
                                                {{ Carbon::parse($itemMonth . '-01')->translatedFormat('F Y') }}</strong>
                                        </td>
                                    </tr>
                                @endif
                    
                                {{-- Tampilkan data item --}}
                                @php
                                    $totalThisMonth += $item->nominal; // Tambahkan nominal ke total bulan ini
                                @endphp
                                <tr>
                                    <td>{{ $currentIndex++ }}</td>
                                    <td>{{ Carbon::parse($item->date)->format('Y-m-d') }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>Rp. {{ number_format($item->nominal) }}</td>
                                </tr>
                            @endforeach
                    
                            {{-- Total untuk bulan terakhir --}}
                            @if (!is_null($currentMonth))
                                <tr>
                                    <td colspan="3" class="text-center"><strong>Total Pengeluaran Bulan
                                            {{ Carbon::parse($currentMonth . '-01')->translatedFormat('F Y') }}</strong>
                                    </td>
                                    <td colspan="1"><strong>Rp. {{ number_format($totalThisMonth) }}</strong></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
