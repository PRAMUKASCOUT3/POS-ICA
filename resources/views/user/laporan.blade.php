@extends('layouts.master')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <a href="{{ route('pengguna.print') }}" class="btn btn-danger mb-3">Download PDF <i class="fas fa-file-pdf"></i></a>
            <a href="{{ route('user.excel') }}" class="btn btn-success mb-3">Download Excel <i class="fas fa-file-excel"></i></a>
            <h5 class="card-title">Laporan Pengguna / Kasir</h5>
            <table class="table table-striped mb-0">
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
            <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">
                <p class="block  text-sm antialiased font-normal leading-normal text-blue-gray-900">
                    Page {{ $users->currentPage() }} of {{ $users->lastPage() }}
                </p>
                <div class="flex gap-2">
                    @if ($users->onFirstPage())
                        <button
                            class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle  text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed"
                            type="button" disabled>
                            Previous
                        </button>
                    @else
                        <a href="{{ $users->previousPageUrl() }}">
                            <button
                                class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle  text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
                                type="button">
                                Previous
                            </button>
                        </a>
                    @endif

                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}">
                            <button
                                class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle  text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
                                type="button">
                                Next
                            </button>
                        </a>
                    @else
                        <button
                            class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle  text-xs font-bold uppercase text-gray-900 transition-all opacity-50 cursor-not-allowed"
                            type="button" disabled>
                            Next
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection