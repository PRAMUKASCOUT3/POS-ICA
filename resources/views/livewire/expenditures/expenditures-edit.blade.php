<div>
    <div class="container">
        <div class="card border">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card-body">
                        <h5 class="card-header bg-primary text-white">Data Lama</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Tanggal <i class="fas fa-calendar-alt"></i></label>
                            <input type="date" class="form-control" value="{{ $expenditure->date }}" readonly>
                            @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi Pengeluaran <i class="fas fa-paragraph"></i></label>
                            <textarea  class="form-control" cols="10" readonly>{{ $expenditure->description }}</textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Nominal Pengeluaran <i class="fas fa-dollar-sign"></i></label>
                            <input type="number" class="form-control" value="{{ $expenditure->nominal }}" readonly>
                            @error('nominal') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card-body">
                        <h5 class="card-header bg-primary text-white">Data Baru</h5>
                    </div>
                    <div class="card-body">
                        <form wire:submit="update">
                            <div class="mb-3">
                                <label>Tanggal <i class="fas fa-calendar-alt"></i></label>
                                <input type="date" class="form-control" wire:model="date" required>
                                @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label>Deskripsi Pengeluaran <i class="fas fa-paragraph"></i></label>
                                <textarea wire:model='description' class="form-control" cols="10"></textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label>Nominal Pengeluaran <i class="fas fa-dollar-sign"></i></label>
                                <input type="number" class="form-control" wire:model="nominal" required>
                                @error('nominal') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>