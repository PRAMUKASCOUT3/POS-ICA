<div>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <!-- Pencarian Barang -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border border-primary">
                            <h5 class="card-header bg-primary text-white"><i class="fas fa-search"></i> Cari Produk </h5>
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="text" id="search-product" class="form-control mt-3"
                                        placeholder="Masukkan nama produk" wire:model.live="search">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border border-primary">
                            <h5 class="card-header bg-primary text-white"><i class="fas fa-list"></i> Hasil Pencarian</h5>
                            <div class="card-body" style="height: 350px; overflow-y: auto;">
                                @if ($product->isNotEmpty())
                                    <ul class="list-group mt-3">
                                        @if ($product->isNotEmpty())
                                        <ul class="list-group mt-3">
                                            @foreach ($product as $item)
                                                @if ($item->stock > 0) <!-- Cek apakah stok lebih dari 0 -->
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span>
                                                            {{ $item->name }} - Rp. {{ number_format($item->price_sell, 0, ',', '.') }} | Stok: {{ $item->stock }}
                                                        </span>
                                                        <button class="btn btn-primary btn-sm" wire:click="addItem({{ $item->id_product }})">
                                                            <i class="fas fa-plus"></i> Tambah
                                                        </button>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    
                                        <!-- Pagination Links -->
                                        <div class="mt-3">
                                            {{ $product->links() }}
                                        </div>
                                    @else
                                        <p class="mt-2">Tidak ada produk ditemukan.</p>
                                    @endif
                                    
                                    </ul>
                                @else
                                    <p class="mt-2">Tidak ada produk ditemukan.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table remains fixed below -->
                <div class="row border border-primary rounded mt-4">
                    <div class="card-header bg-primary rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="text-white">KASIR <i class="fas fa-cash-register"></i></h4>
                            <button class="btn btn-danger" wire:click="clear"><i class="fas fa-sync-alt"></i> RESET KERANJANG</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12">
                                <table class="table table-bordered mt-4">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang <i class="fas fa-file-signature"></i></th>
                                            <th>Jumlah <i class="fab fa-unity"></i></th>
                                            <th>Harga <i class="fas fa-dollar-sign"></i></th>
                                            <th>Total <i class="fas fa-funnel-dollar"></i></th>
                                            <th>Aksi <i class="fas fa-cogs"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $index => $item)
                                            <tr>
                                                <td>{{ $item['name'] }}</td>
                                                <td>
                                                    <input type="number" min="1"
                                                        wire:model.defer="items.{{ $index }}.stock"
                                                        wire:change="updateQuantity({{ $index }}, $event.target.value)"
                                                        class="form-control">
                                                </td>
                                                <td>Rp. {{ number_format($item['price_sell'], 0, ',', '.') }}</td>
                                                <td>Rp.
                                                    {{ number_format($item['price_sell'] * $item['stock'], 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm"
                                                        wire:click="removeItem({{ $index }})">
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Informasi Total Belanja -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <label for="totalSemua">Total Semua</label>
                                        <input id="totalSemua" value="Rp. {{ number_format($subtotal, 0, ',', '.') }}"
                                            class="form-control" readonly>
                                    </div>

                                    <div>
                                        <label for="amountPaid">Bayar</label>
                                        <div class="d-flex align-items-center">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="number" wire:model.live="amount_paid" class="form-control"
                                                id="amountPaid" min="0" placeholder="Masukkan jumlah pembayaran" required>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="kembali">Kembalian</label>
                                        <input type="text" id="kembali"
                                            value="Rp. {{ number_format($change, 0, ',', '.') }}" class="form-control"
                                            readonly>
                                    </div>
                                </div>

                                <!-- Tombol Bayar dan Reset -->
                                <input type="text" wire:model='user_id' hidden>
                                <div class="mt-3 d-flex justify-content-end">
                                   
                                    <button class="btn btn-success me-2" wire:click="saveTransaction">Bayar <i class="fas fa-vote-yea"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
