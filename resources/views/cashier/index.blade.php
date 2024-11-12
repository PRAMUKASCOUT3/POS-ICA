@extends('layouts.master')

@push('styles')
    @livewireStyles
@endpush

@section('content')

@livewire('cashier.cashier-table')


@endsection

@push('scripts')
    @livewireScripts
@endpush