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
                            <label for="">Nama Kategori <i class="fas fa-file-signature"></i></label>
                            <input type="text" class="form-control" value="{{ $category->name }}" readonly>
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
                                <label>Nama Kategori <i class="fas fa-file-signature"></i></label>
                                <input type="text" class="form-control" wire:model="name" required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>