@extends('layouts.master')

@section('content')
<div class="container mt-2">
    <div class="card">
        <div class="card-header">
            <h4>Ubah Profil Admin</h4>
        </div>
        <div class="card-body">
            <!-- Form Update Profile -->
            <form method="POST" action="{{ route('pengguna.update' , $user->id_user ) }}">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" 
                           value="{{ old('name', auth()->user()->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" 
                           value="{{ old('email', auth()->user()->email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <small class="text-muted">Jika Tidak Merubah Password Silahkan Keluar Halaman</small>
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
</div>

@endsection