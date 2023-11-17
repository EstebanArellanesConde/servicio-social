@extends('layouts.jefe', ['title' => 'Estadísticas'])


@section('options')
    <x-primary-button>
        Exportar estadísticas
    </x-primary-button>
@endsection

@section('main')
    <div class="pt-8 space-y-4">
        <livewire:jefe.estadisticas>
        </livewire:jefe.estadisticas>

        <form action="{{ route('jefe.solicitud_inicio', 1) }}" method="POST">
            @csrf
            <x-primary-button>
                Descargar SS01 Solicitud De Inicio
            </x-primary-button>
        </form>
        <form action="{{ route('jefe.carta', 1) }}" method="POST">
            @csrf
            <x-primary-button>
                Descargar SS02 Carta Aceptación
            </x-primary-button>
        </form>
    </div>
@endsection

