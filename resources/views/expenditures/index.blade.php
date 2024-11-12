@extends('layouts.master')

@push('styles')
    @livewireStyles
@endpush

@section('content')

@livewire('expenditures.expenditures-table')


@endsection

@push('scripts')
    @livewireScripts
@endpush