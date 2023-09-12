@php
    $checkboxContainerClasses = 'flex items-center gap-2';
    $checkboxClasses = 'h-6 w-6'
@endphp

<div>
    <x-primary-button
        class="gap-2 showModal"
        data-modal-id="downloadJefe"
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
        </svg>
        <p>
            Exportar
        </p>
    </x-primary-button>

    <x-modal
        :dataId="'downloadJefe'"
    >
        <form class="flex flex-col space-y-4 ml-2" action="{{ route('jefe.download') }}" method="POST">
            @csrf
            {{-- CAMPOS REQUERIDOS --}}
            <div x-data="{ open: false }" class="rounded-md shadow-md p-3">
                <div x-on:click="open = !open" class="flex justify-between cursor-pointer">
                    <h2 class="text-lg">
                        Campos Requeridos
                    </h2>
                    <svg x-show="!open" x-transition xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                    </svg>
                    <svg x-show="open" x-transition xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                    </svg>
                </div>
                <div x-show="open" x-transition>
                    <x-jefe.filtros
                        class="hidden"
                    >
                        <x-slot:title>
                            Datos Generales
                        </x-slot:title>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="curp" class="{{ $checkboxClasses }}" id="check_curp"/>
                            <x-input-label for="check_curp" :value="__('CURP')"/>
                        </div>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="fecha_nacimiento" class="{{ $checkboxClasses }}" id="check_fecha_nacimiento"/>
                            <x-input-label for="check_fecha_nacimiento" :value="__('Fecha Nacimiento')"/>
                        </div>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="sexo" class="{{ $checkboxClasses }}" id="check_sexo"/>
                            <x-input-label for="check_sexo" :value="__('Sexo')"/>
                        </div>
                    </x-jefe.filtros>

                    <x-jefe.filtros>
                        <x-slot:title>
                            Contacto
                        </x-slot:title>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="telefono_celular" class="{{ $checkboxClasses }}" id="check_telefono_celular"/>
                            <x-input-label for="check_telefono_celular" :value="__('Teléfono Celular')"/>
                        </div>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="telefono_alternativo" class="{{ $checkboxClasses }}" id="check_telefono_alternativo"/>
                            <x-input-label for="check_telefono_alternativo" :value="__('Teléfono Alternativo')"/>
                        </div>
                    </x-jefe.filtros>
                    <x-jefe.filtros>
                        <x-slot:title>
                            Datos UNAM
                        </x-slot:title>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="numero_cuenta" class="{{ $checkboxClasses }}" id="check_numero_cuenta"/>
                            <x-input-label for="check_numero_cuenta" :value="__('Número de Cuenta')"/>
                        </div>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="creditos" class="{{ $checkboxClasses }}" id="check_creditos_pagados"/>
                            <x-input-label for="check_creditos_pagados" :value="__('Créditos Pagados')"/>
                        </div>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="avance" class="{{ $checkboxClasses }}" id="check_avance_porcentaje"/>
                            <x-input-label for="check_avance_porcentaje" :value="__('Avance en Porcentaje')"/>
                        </div>
                    </x-jefe.filtros>


                    <x-jefe.filtros>
                        <x-slot:title>
                            Datos Escolares
                        </x-slot:title>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="promedio" class="{{ $checkboxClasses }}" id="check_promedio"/>
                            <x-input-label for="check_promedio" :value="__('Promedio')"/>
                        </div>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="procedencia" class="{{ $checkboxClasses }}" id="check_procedencia"/>
                            <x-input-label for="check_procedencia" :value="__('Procedencia')"/>
                        </div>
                    </x-jefe.filtros>

                    <x-jefe.filtros>
                        <x-slot:title>
                            UNICA
                        </x-slot:title>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="departamento" class="{{ $checkboxClasses }}" id="check_departamento"/>
                            <x-input-label for="check_departamento" :value="__('Departamento')"/>
                        </div>
                    </x-jefe.filtros>
                </div>
            </div>

            {{-- FILTROS --}}
            <div x-data="{ open: false }" class="rounded-md shadow-md p-3">
                <div x-on:click="open = !open" class="flex justify-between cursor-pointer">
                    <h2 class="text-lg">
                        Filtros
                    </h2>
                    <svg x-show="!open" x-transition xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                    </svg>
                    <svg x-show="open" x-transition xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                    </svg>
                </div>
                <div x-show="open" x-transition>
                    <x-jefe.filtros>
                        <x-slot:title>
                            Datos Generales
                        </x-slot:title>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="mujer" value="M" class="{{ $checkboxClasses }}" id="check_mujer"/>
                            <x-input-label for="check_mujer" value="Mujer"/>
                        </div>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="hombre" value="H" class="{{ $checkboxClasses }}" id="check_hombre"/>
                            <x-input-label for="check_hombre" value="Hombre"/>
                        </div>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="otro" value="O" class="{{ $checkboxClasses }}" id="check_otro"/>
                            <x-input-label for="check_otro" value="Otro(s)"/>
                        </div>
                    </x-jefe.filtros>

                    <x-jefe.filtros>
                        <x-slot:title>
                            Procedencia
                        </x-slot:title>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="facultad_ingenieria" value="FI" class="{{ $checkboxClasses }}" id="check_fi"/>
                            <x-input-label for="check_fi" :value="__('Facultad de Ingeniería')"/>
                        </div>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="unam" value="UNAM" class="{{ $checkboxClasses }}" id="check_unam"/>
                            <x-input-label for="check_unam" :value="__('UNAM')"/>
                        </div>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="externo" value="EXTERNO" class="{{ $checkboxClasses }}" id="check_externo"/>
                            <x-input-label for="check_externo" :value="__('Externo')"/>
                        </div>
                    </x-jefe.filtros>

                    <x-jefe.filtros>
                        <x-slot:title>
                            UNICA
                        </x-slot:title>
                        @foreach($departamentosAbreviaturas as $departamento)
                            <div class="{{ $checkboxContainerClasses }}">
                                <x-checkbox name="{{ $departamento }}" value="{{ $departamento }}" class="{{ $checkboxClasses }}" id="check_{{ $departamento }}"/>
                                <x-input-label for="check_{{ $departamento }}" value="{{ $departamento }}"/>
                            </div>
                        @endforeach
                    </x-jefe.filtros>
                </div>
            </div>

            <x-input-label for="filetype" :value="__('Formato del Archivo')" />
            <x-select-input
                id="filetype"
                class="mt-2 w-full"
                name="filetype"
            >
                <option selected>Seleccione el formato</option>
                {{-- Se utiliza 1 ya que si es de la fi 1 es verdadero == si es interno  --}}
                <option id="filetype_pdf" value="pdf">PDF</option>
                <option id="filetype_excel" value="xlsx">Excel</option>
                <option id="filetype_csv" value="csv">CSV</option>
            </x-select-input>

            <x-primary-button
                class="w-full justify-center">
                {{ __('Descargar') }}
            </x-primary-button>
        </form>
    </x-modal>
</div>
