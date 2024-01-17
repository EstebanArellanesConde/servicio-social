@extends('layouts.jefe_documentacion', ['title' => 'Configuración'])

@section('main')
    <div class="pt-4 space-y-4">
        @if (session()->has('message'))
            <x-alert type="success">
                <x-slot:title>
                    Exito
                </x-slot:title>
                <x-slot:message>
                    {{ session('message') }}
                </x-slot:message>
            </x-alert>
        @endif

        <livewire:jefe.formulario-periodo>

        </livewire:jefe.formulario-periodo>
    </div>
@endsection

