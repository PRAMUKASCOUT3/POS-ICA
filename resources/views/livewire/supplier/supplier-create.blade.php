<div>
    <div class="modal-header bg-primary">
        <h4 class="modal-title text-white">Data Baru</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">
        <form wire:submit.prevent="save">
            <div class="mb-3">
                <label>Nama Pemasok<i class="fas fa-file-signature"></i></label>
                <input type="text" class="form-control" wire:model="name" required>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label>Nomor Handphone <i class="fas fa-phone"></i></label>
                <input type="number" class="form-control" wire:model="contact_person" required>
                @error('contact_person') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label>Alamat <i class="fas fa-map-marked-alt"></i></label>
                <input type="text" class="form-control" wire:model="address" required>
                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-2">Simpan</button>
        </form>
    </div>
</div>
