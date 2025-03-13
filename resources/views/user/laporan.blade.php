@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('pengguna.print') }}" class="btn btn-danger mb-3">Unduh PDF <i class="fas fa-file-pdf"></i></a>
            <a href="{{ route('user.excel') }}" class="btn btn-success mb-3">Unduh Excel <i class="fas fa-file-excel"></i></a>
            <h5 class="card-title">Laporan Pengguna / Kasir</h5>
            <table id="example" class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kasir <i class="fas fa-code"></i></th>
                        <th>Nama Pengguna / Kasir <i class="fas fa-users"></i></th>
                        <th>Email <i class="fas fa-envelope"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td class="text-bold-500">{{ $index + 1 }}</td>
                            <td>{{ $user->code }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection