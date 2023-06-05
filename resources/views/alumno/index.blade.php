@extends('layouts.alumno')

@section('main')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col justify-center items-center p-6 space-y-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm md:place-items-stretch md:h-auto sm:rounded-lg">
                <div class="flex flex-col items-center md:justify-between md:flex-row text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl pb-2 md:pb-0 md:text-xl font-bold">{{ auth()->user()->name }}</h2>
                    <div class="status_container flex flex-col md:flex-row items-center gap-2">
                        <h2 class="text-xl">Estado</h2>
                        <div class="flex gap-2 bg-yellow-300 text-black py-2 px-4 rounded-xl uppercase">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p>En Espera</p>
                        </div>
                    </div>

                </div>
                <div class="flex flex-col md:gap-2 items-center justify-center md:flex-row">
                    <x-input-label class="text-xl md:text-lg md:w-1/3" for="fecha_registro" :value="__('Fecha de registro')" />
                    <x-text-input class="md:w-2/3" type="date" value="{{ Carbon\Carbon::parse($alumno->created_at)->toDateString() }}" disabled/>
                </div>

                <div class="flex flex-col md:gap-2 items-center justify-center md:flex-row">
                    <x-input-label class="text-xl md:text-lg md:w-1/3" for="fecha_inicio" :value="__('Fecha de inicio')" />
                    @if($alumno->fecha_inicio)
                        <x-text-input class="md:w-2/3" type="date" value="{{ Carbon\Carbon::parse($alumno->fecha_inicio)->toDateString() }}" disabled/>
                    @else
                        <x-text-input class="md:w-2/3" type="text" value="Sin Asignar" disabled/>
                    @endif
                </div>

                <div class="flex flex-col md:gap-2 items-center justify-center md:flex-row">
                    <x-input-label class="text-xl md:text-lg md:w-1/3" for="fecha_inicio" :value="__('Fecha de fin')" disabled/>
                    @if($alumno->fecha_fin)
                        <x-text-input class="md:w-2/3" type="date" value="{{ Carbon\Carbon::parse($alumno->fecha_fin)->toDateString() }}" disabled/>
                    @else
                        <x-text-input class="md:w-2/3" type="text" value="Sin Asignar" disabled/>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
