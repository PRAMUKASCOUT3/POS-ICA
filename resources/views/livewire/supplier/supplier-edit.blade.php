<div>
    <div class="container">
        <div class="card border">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card-body">
                        <h5 class="card-header bg-primary text-white">Data Lama</h5>
                    </div>
                    <div class="card-body">
                        <div class="md-3">
                            <label for="">Nama Pemasok<i class="fas fa-file-signature"></i></label>
                            <input type="text" class="form-control"  value="{{ $suppliers->name }}" readonly>
                        </div>
                        <div class="md-3">
                            <label for="">Nomor Handphone <i class="fas fa-phone"></i></label>
                            <input type="number" class="form-control"  value="{{ $suppliers->contact_person }}" readonly>
                        </div>
                        <div class="md-3">
                            <label for="">Alamat <i class="fas fa-map-marked-alt"></i></label>
                            <input type="text" class="form-control"  value="{{ $suppliers->address }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card-body">
                        <h5 class="card-header bg-primary text-white">Data Baru</h5>
                    </div>
                    <div class="card-body">
                        <form wire:submit="update">
                            <div class="md-3">
                                <label>Nama Pemasok<i class="fas fa-file-signature"></i></label>
                                <input type="text" class="form-control" wire:model="name" required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="md-3">
                                <label>Nomor Handphone <i class="fas fa-phone"></i></label>
                                <input type="number" class="form-control" wire:model="contact_person" required>
                                @error('contact_person') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="md-3">
                                <label>Alamat <i class="fas fa-map-marked-alt"></i></label>
                                <input type="text" class="form-control" wire:model="address" required>
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>