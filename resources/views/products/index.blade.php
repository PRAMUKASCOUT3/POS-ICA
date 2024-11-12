@extends('layouts.master')

@push('styles')
    @livewireStyles
@endpush

@section('content')

@livewire('product.product-tabel')


@endsection

@push('scripts')
    @livewireScripts
@endpush