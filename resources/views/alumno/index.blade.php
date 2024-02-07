@extends('layouts.alumno')

@section('main')
    <div>
        <div class="max-w-7xl">
            @if($alumno->estado_id == \App\Enums\EstadoAlumno::REGISTRADO->value)
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

            <div class="flex flex-col justify-center items-center p-6 space-y-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm md:place-items-stretch md:h-auto sm:rounded-lg dark:text-white">
                @if($alumno->estado_id == \App\Enums\EstadoAlumno::ACEPTADO->value)
                <div>
                    <h2 class="font-bold text-xl">
                        Formatos
                    </h2>
                    <p class="font-light text-gray-400">
                        Descarga los formatos necesarios para iniciar tu servicio social, firmalos y entregalos a la coordinación encargada del servicio social en tu escuela
                    </p>
                    <div class="flex flex-col justify-center sm:flex-row text-center">
                        <x-card class="w-full sm:w-1/2 space-y-4">
                            <form class="space-y-4" action="{{ route('alumno.solicitud_inicio.store', [ 'alumno' => $alumno]) }}" method="POST">
                                @csrf
                                <h2 class="font-bold uppercase">
                                    SS01 - Solicitud de Inicio
                                </h2>
                                <x-primary-button class="w-full justify-center">
                                    DESCARGAR
                                </x-primary-button>
                            </form>
                        </x-card>
                        <x-card class="w-full sm:w-1/2">
                            <form class="space-y-4" action="{{ route('alumno.carta_aceptacion.store', ['alumno' => $alumno]) }}" method="POST">
                                @csrf
                                <h2 class="font-bold uppercase">
                                    SS02 - Carta de Aceptación
                                </h2>
                                <x-primary-button class="w-full justify-center">
                                    DESCARGAR
                                </x-primary-button>
                            </form>
                        </x-card>
                    </div>
                </div>
                @elseif($alumno->estado_id == \App\Enums\EstadoAlumno::ACEPTADO->value)
                <div>
                    <h2 class="font-bold text-xl">
                        Carta de Finalización
                    </h2>
                    <p class="font-light text-gray-400">
                        Haz cumplido con todos tus reportes, ahora puedes solicitar tu carta de finalización
                    </p>
                    <div>
                        <x-card>
                            <form class="space-y-4" method="POST">
                                @csrf
                                <h2 class="font-bold uppercase">
                                    SS04 - Carta de Finalización
                                </h2>
                                <x-primary-button class="w-full justify-center">
                                    DESCARGAR
                                </x-primary-button>
                            </form>
                        </x-card>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
