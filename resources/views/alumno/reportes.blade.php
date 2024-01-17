@extends('layouts.alumno')

@section('main')
    <div
        class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 text-center gap-2 dark:text-white h-1/2">
        @foreach($alumno->reportes as $reporte)
            <x-reporte>
                <x-slot:title>
                    Reporte {{ $reporte->num_reporte }}
                </x-slot:title>

                <x-slot:status>
                    @switch($reporte->estado->id)
                        @case(\App\Enums\EstadoReporte::ESPERA->value)
                            <x-status type="info" class="text-sm rounded-md">
                                EN {{ $reporte->estado->nombre }}
                            </x-status>
                            @break
                        @case(\App\Enums\EstadoReporte::REVISION->value)
                            <x-status type="info" class="text-sm rounded-md">
                                {{ $reporte->estado->nombre }}
                            </x-status>
                            @break
                        @case(\App\Enums\EstadoReporte::CORRECCION->value)
                            <x-status type="warn" class="text-sm rounded-md">
                                {{ $reporte->estado->nombre }}
                            </x-status>
                            @break
                        @case(\App\Enums\EstadoReporte::ACEPTADO->value)
                            <x-status type="success" class="text-sm rounded-md">
                                {{ $reporte->estado->nombre }}
                            </x-status>
                            @break
                        @default
                    @endswitch
                </x-slot:status>


                {{ $reporte->estado->descripcion }}



                @switch($reporte->estado->id)
                    @case( \App\Enums\EstadoReporte::INICIAL->value)
                    @case( \App\Enums\EstadoReporte::REVISION->value)
                        <x-slot:button>
                        </x-slot:button>
                        @break
                    @case( \App\Enums\EstadoReporte::CORRECCION->value)
                        <div class="text-xl">
                            <p class="font-bold">Observaciones: </p>{{ $reporte->observaciones }}
                        </div>
                        <x-slot:button>
                            <x-primary-button
                                class="text-center block w-full"
                                onclick="Livewire.emit('openModal', 'reporte-modal', {{ json_encode(['num_reporte' => $reporte->num_reporte ]) }} )"
                            >
                                CREAR
                            </x-primary-button>
                        </x-slot:button>
                        @break
                    @case( \App\Enums\EstadoReporte::ACEPTADO->value)
                        <x-slot:button>
                            <form action="{{ route('alumno.reportes.download', ['id' => $reporte->id]) }}">
                                <x-primary-button
                                    class="text-center block w-full"
                                >
                                    DESCARGAR
                                </x-primary-button>
                            </form>
                        </x-slot:button>
                        @break
                    @default
                        <x-slot:button>
                            <x-primary-button
                                class="text-center block w-full"
                                onclick="Livewire.emit('openModal', 'reporte-modal', {{ json_encode(['num_reporte' => $reporte->num_reporte ]) }} )"
                            >
                                CREAR
                            </x-primary-button>
                        </x-slot:button>
                @endswitch
            </x-reporte>
        @endforeach
    </div>
@endsection
