<div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Pengeluaran <i class="fas fa-file-invoice-dollar"></i></h5>
                <div class="table-responsive">
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createSupplierModal"><i class="fas fa-plus"></i> Tambah Pengeluaran</button>
                    {{-- <a href="{{ route('expenditures.history') }}" class="btn btn-warning mb-3"><i class="fas fa-history"></i> Riwayat pengeluaran</a> --}}
                    <table id="example" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal <i class="fas fa-calendar-alt"></i></th>
                                <th>Deskripsi Pengeluaran <i class="fas fa-paragraph"></i></th>
                                <th>Nominal Pengeluaran <i class="fas fa-dollar-sign"></i></th>
                                <th>Aksi <i class="fas fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Menginisialisasi total nominal untuk bulan ini dan variabel tambahan
                                $totalThisMonth = 0;
                                $lastMonth = null;
                                $number = 0; // Inisialisasi nomor urut
                            @endphp
                        
                            @foreach ($expenditures as $item)
                                @php
                                    $itemMonth = Carbon\Carbon::parse($item->date)->format('Y-m'); // Mendapatkan bulan dari tanggal
                                @endphp
                        
                                @if ($itemMonth !== $lastMonth)
                                    @php
                                        // Reset nomor urut jika bulan berubah
                                        $lastMonth = $itemMonth;
                                        $number = 1;
                                    @endphp
                                @else
                                    @php
                                        // Menambahkan nomor urut
                                        $number++;
                                    @endphp
                                @endif
                        
                                @if (Carbon\Carbon::parse($item->date)->isCurrentMonth())
                                    @php
                                        // Menambahkan nominal ke total bulan ini
                                        $totalThisMonth += $item->nominal;
                                    @endphp
                                    <tr>
                                        <td>{{ $number }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>Rp. {{ number_format($item->nominal) }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('expenditures.edit', $item->id_expenditure) }}" class="btn btn-info btn-sm" style="margin-right: 5px">Edit</a>
                                                <form id="deleteForm{{ $item->id_expenditure }}" class="d-inline"
                                                    action="{{ route('expenditures.delete', $item->id_expenditure) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $item->id_expenditure }})">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        
                        </tbody>
                        @if ($totalThisMonth > 0)
                            <tr>
                                <td colspan="3" class="text-center"><strong>Total Pengeluaran Bulan Ini</strong></td>
                                <td colspan="2"><strong>Rp. {{ number_format($totalThisMonth) }}</strong></td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="5" class="text-center"><em>Tidak ada pengeluaran untuk bulan ini</em></td>
                            </tr>
                        @endif
                            
                            
                    </table>

                     <!-- Modal Create Supplier -->
                     <div class="modal fade" id="createSupplierModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <livewire:expenditures.expenditures-create/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
