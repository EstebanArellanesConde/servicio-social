@extends('layouts.jefe')

@section('main')
    <div class="flex justify-between items-center">
        <div class="buscador w-2/4">
            <x-text-input class="p-2 w-full" placeholder="Ingresa el nombre del alumno"/>
        </div>
        <div class="flex w-1/4 justify-end gap-2">
            <x-primary-button class="filtros flex gap-2 dark:bg-blue">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                </svg>
                <h2>Filtros</h2>
            </x-primary-button>
            <x-primary-button class="descargas flex gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                <h2>Exportar</h2>
            </x-primary-button>
        </div>
    </div>
    <div class="mt-8">

    </div>
@endsection

