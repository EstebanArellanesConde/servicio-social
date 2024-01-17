@extends('layouts.jefe_documentacion', ['title' => 'Estadísticas'])

@section('options')
    <x-primary-button>
        Exportar estadísticas
    </x-primary-button>
@endsection

@can('ver estadisticas')
@section('main')
    <div class="pt-8 space-y-4">
        <livewire:jefe.estadisticas>
        </livewire:jefe.estadisticas>
    </div>
@endsection
@endcan
