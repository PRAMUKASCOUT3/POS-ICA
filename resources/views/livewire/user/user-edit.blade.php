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
                            <label for="">Nama Pengguna / Kasir <i class="fas fa-users"></i></label>
                            <input type="text" class="form-control"  value="{{ $user->name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="">Email <i class="fas fa-envelope"></i></label>
                            <input type="text" class="form-control"  value="{{ $user->email }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="">Password <i class="fas fa-key"></i></label>
                            <input type="password" class="form-control"  value="{{ $user->password }}" readonly>
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
                                <label for="">Nama Pengguna / Kasir <i class="fas fa-users"></i></label>
                                <input type="text" class="form-control"  wire:model="name" >
                            </div>
                            <div class="mb-3">
                                <label for="">Email <i class="fas fa-envelope"></i></label>
                                <input type="email" class="form-control"  wire:model="email" >
                            </div>
                            <div class="mb-3">
                                <label for="">Password <i class="fas fa-key"></i></label>
                                <input type="password" class="form-control"  wire:model="password" >
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>