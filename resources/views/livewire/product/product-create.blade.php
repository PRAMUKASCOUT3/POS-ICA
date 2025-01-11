<div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-header bg-primary text-white">Form Tambah Produk</h5>
                <form wire:submit="save">
                    <input type="text" wire:mode="code" hidden>
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <select wire:model="id_category" id="category" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($category as $cat)
                                <option value="{{ $cat->id_category }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('id_category') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-3">
                        <label for="name">Nama Produk <i class="fas fa-file-signature"></i></label>
                        <input type="text" class="form-control" wire:model="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="brand">Merk Produk <i class="fas fa-tag"></i></label>
                        <input type="text" class="form-control" wire:model="brand">
                        @error('brand')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="stock">Stok <i class="fas fa-cubes"></i></label>
                        <input type="number" class="form-control" wire:model="stock">
                        @error('stock')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="price_buy">Harga Beli <i class="fas fa-money-check-alt"></i></label>
                        <input type="number" class="form-control" wire:model="price_buy">
                        @error('price_buy')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="price_sell">Harga Jual <i class="fas fa-hand-holding-usd"></i></label>
                        <input type="number" class="form-control" wire:model="price_sell">
                        @error('price_sell')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="unit">Pilih Satuan Barang <i class="fab fa-unity"></i></label>
                        <select class="form-control" id="unit" wire:model="unit">
                            <option value="">==Pilih Satuan Barang==</option>
                            <option value="Pcs (Pieces)">Pcs (Pieces)</option>
                            <option value="Kg (Kilogram)">Kg (Kilogram)</option>
                            <option value="L (Liter)">L (Liter)</option>
                            <option value="Dus (Box)">Dus (Box)</option>
                            <option value="Meter">Meter</option>
                            <option value="Pack">Pack</option>
                            <option value="Lusin">Lusin (Dozen)</option>
                            <option value="Gram">Gram</option>
                            <option value="Kodi">Kodi</option>
                            <option value="Gross">Gross</option>
                        </select>
                        @error('unit')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
