<div>
    <div class="modal-header bg-primary">
        <h4 class="modal-title text-white">Data Baru</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">
        <form wire:submit.prevent="save">
            <input type="text" wire:model="code" hidden>
            <div class="mb-3">
                <label>Nama Pengguna / Kasir <i class="fas fa-users"></i></label>
                <input type="text" class="form-control" wire:model="name" required>
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label>Email <i class="fas fa-envelope"></i></label>
                <input type="email" class="form-control" wire:model="email" required>
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label>Password <i class="fas fa-key"></i></label>
                <input type="password" class="form-control" wire:model="password" required>
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-2">Simpan</button>
        </form>
    </div>
</div>
