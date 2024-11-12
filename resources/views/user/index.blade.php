@extends('layouts.master')

@push('styles')
    @livewireStyles
@endpush

@section('content')
@livewire('user.user-table')
@endsection

@push('scripts')
    @livewireScripts
@endpush