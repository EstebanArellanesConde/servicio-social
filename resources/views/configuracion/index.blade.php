@extends('layouts.jefe_documentacion', ['title' => 'Configuración'])

@section('main')
    <div class="pt-4 space-y-4">
        <livewire:configuracion.formulario-periodo>
        </livewire:configuracion.formulario-periodo>


        <livewire:configuracion.edit-dgose>
        </livewire:configuracion.edit-dgose>
    </div>
@endsection

