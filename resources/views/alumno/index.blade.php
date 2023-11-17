@extends('layouts.alumno')

@section('main')

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-3">

            @if($alumno->hasEstado('aceptado sin datos'))
                {{-- ALERTA --}}
                <x-alert type="warn">
                    <x-slot:title>
                        Ingresa tus datos
                    </x-slot:title>
                    <x-slot:message>
                        Para continuar con el proceso del servicio social actualiza tus datos
                    </x-slot:message>
                    <a href="{{ route('profile.edit') }}">
                        <x-primary-button class="mt-3">
                                Actualizar datos
                        </x-primary-button>
                    </a>
                </x-alert>
            @endif

            <div class="flex flex-col justify-center items-center p-6 space-y-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm md:place-items-stretch md:h-auto sm:rounded-lg">

                <div class="flex flex-col items-center md:justify-between md:flex-row text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl pb-2 md:pb-0 md:text-xl font-bold">{{ auth()->user()->nombre }}</h2>
                    <div class="status_container flex flex-col md:flex-row items-center gap-2">
                        <h2 class="text-xl">Estado</h2>
                        @if($alumno->getEstado() == "PENDIENTE")
                            <div class="flex gap-2 bg-yellow-300 text-black py-2 px-4 rounded-xl uppercase">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p>{{ $alumno->getEstado() }}</p>
                            </div>
                        @elseif($alumno->getEstado() == "ACEPTADO")
                            <div class="flex gap-2 text-white bg-lime-500 py-2 px-4 rounded-xl uppercase">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                <p>{{ $alumno->getEstado() }}</p>
                            </div>
                        @elseif($alumno->getEstado() == "RECHAZO")
                            <div class="flex gap-2 text-white bg-red-500 py-2 px-4 rounded-xl uppercase">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <p>{{ $alumno->getEstado() }}</p>
                            </div>
                        @else
                            <div class="flex gap-2 text-white bg-blue-400 py-2 px-4 rounded-xl uppercase">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                </svg>
                                <p>DESCONOCIDO</p>
                            </div>
                        @endif
                    </div>

                </div>
                <div class="flex flex-col gap-2 items-center justify-center md:flex-row">
                    <x-input-label class="text-xl md:text-lg md:w-1/3" for="fecha_registro" :value="__('Fecha de registro')" />
                    <x-text-input class="md:w-2/3" type="text" value="{{ Carbon\Carbon::parse($alumno->created_at)->toFormattedDateString() }}" disabled/>
                </div>

                <div class="flex flex-col gap-2 items-center justify-center md:flex-row">
                    <x-input-label class="text-xl md:text-lg md:w-1/3" for="fecha_inicio" :value="__('Fecha de inicio')" />
                    @if($alumno->fecha_inicio)
                        <x-text-input class="md:w-2/3" type="text" value="{{ Carbon\Carbon::parse($alumno->fecha_inicio)->toFormattedDateString() }}" disabled/>
                    @else
                        <x-text-input class="md:w-2/3" type="text" value="Sin Asignar" disabled/>
                    @endif
                </div>

                <div class="flex flex-col gap-2 items-center justify-center md:flex-row">
                    <x-input-label class="text-xl md:text-lg md:w-1/3" for="fecha_inicio" :value="__('Fecha de fin')" disabled/>
                    @if($alumno->fecha_fin)
                        <x-text-input class="md:w-2/3" type="text" value="{{ Carbon\Carbon::parse($alumno->fecha_fin)->toFormattedDateString() }}" disabled/>
                    @else
                        <x-text-input class="md:w-2/3" type="text" value="Sin Asignar" disabled/>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
