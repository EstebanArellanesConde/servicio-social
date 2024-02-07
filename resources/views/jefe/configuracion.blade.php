@extends('layouts.jefe', ['title' => 'Configuración'])

@section('main')
    <div class="pt-4 space-y-4">
        <livewire:configuracion.edit-rubrica>
        </livewire:configuracion.edit-rubrica>

        <livewire:configuracion.edit-periodo>
        </livewire:configuracion.edit-periodo>
    </div>
@endsection

