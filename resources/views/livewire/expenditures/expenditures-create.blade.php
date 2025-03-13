<div>
    <div class="modal-header bg-primary">
        <h4 class="modal-title text-white">Data Baru</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">
        <form wire:submit.prevent="save">
            <div class="md-3">
                <label>Tanggal <i class="fas fa-calendar-alt"></i></label>
                <input type="date" class="form-control" wire:model="date" required>
                @error('date') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="md-3">
                <label>Deskripsi Pengeluaran <i class="fas fa-paragraph"></i></label>
                <textarea wire:model='description' class="form-control" cols="10"></textarea>
                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="md-3">
                <label>Nominal Pengeluaran <i class="fas fa-dollar-sign"></i></label>
                <input type="number" class="form-control" wire:model="nominal" required>
                @error('nominal') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-2">Simpan</button>
        </form>
    </div>
</div>
