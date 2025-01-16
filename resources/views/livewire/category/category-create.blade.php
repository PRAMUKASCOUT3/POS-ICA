<div>
    <div class="modal-header bg-primary">
        <h4 class="modal-title text-white">Data Baru</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">
        <form wire:submit.prevent="save">
            <div class="md-3">
                <label>Nama Kategori <i class="fas fa-file-signature"></i></label>
                <input type="text" class="form-control" wire:model="name" required>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-2">Simpan</button>
        </form>
    </div>
</div>
