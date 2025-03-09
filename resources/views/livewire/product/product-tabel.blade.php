<div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Produk</h5>
                <div class="table-responsive">
                    <a href="{{ route('product.create') }}" class="btn btn-primary">Tambah Data</a>
                    <table id="example" class="table table-striped mt-2" style="width: 120%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Produk <i class="fas fa-code"></i></th>
                                <th>Kategori <i class="fas fa-clipboard-list"></i></th>
                                <th>Nama Produk <i class="fas fa-file-signature"></i></th>
                                <th>Merk Produk <i class="fas fa-tag"></i></th>
                                <th>Stok <i class="fas fa-cubes"></i></th>
                                <th>Harga Modal <i class="fas fa-money-check-alt"></i></th>
                                <th>Harga Jual <i class="fas fa-hand-holding-usd"></i></th>
                                <th>Satuan <i class="fab fa-unity"></i></th>
                                <th>Aksi <i class="fas fa-cogs"></i></th>
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
                                    <td>
                                        @if ($item->stock == 0)
                                            <span class="badge bg-danger text-white">Stock Habis</span>
                                        @else
                                            {{ $item->stock }}
                                        @endif
                                    </td>
                                    <td>Rp.{{ number_format($item->price_buy) }}</td>
                                    <td>Rp.{{ number_format($item->price_sell) }}</td>
                                    <td>{{ $item->unit }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">

                                            <a href="{{ route('product.edit', $item->id_product) }}"
                                                class="btn btn-info btn-sm me-2">Edit</a>
                                            <form id="deleteForm{{ $item->id_product }}" class="d-inline"
                                                action="{{ route('product.delete', $item->id_product) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $item->id_product }})">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @php
                            $total_buy = 0;
                            $total_sell = 0;

                            foreach ($products as $product) {
                                $total_buy += $product->stock * $product->price_buy;
                                $total_sell += $product->stock * $product->price_sell;
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
    </div>
</div>
