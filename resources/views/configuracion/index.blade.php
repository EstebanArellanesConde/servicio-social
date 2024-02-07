@extends('layouts.jefe_documentacion', ['title' => 'Configuración'])

@section('main')
    <div class="pt-4 space-y-4">
        <livewire:configuracion.edit-periodo>
        </livewire:configuracion.edit-periodo>

        <livewire:configuracion.edit-dgose>
        </livewire:configuracion.edit-dgose>
    </div>
@endsection

