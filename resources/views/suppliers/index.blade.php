@extends('layouts.master')

@push('styles')
    @livewireStyles
@endpush

@section('content')

@livewire('supplier.supplier-tabel')


@endsection

@push('scripts')
    @livewireScripts
    <script>
        window.addEventListener('close-modal', event => {
    $('#createSupplierModal').modal('hide');
});
    </script>
@endpush