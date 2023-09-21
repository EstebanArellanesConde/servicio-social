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
    </x-primary-button>

    <x-modal
        :dataId="'downloadJefe'"
        class="w-1/2"
    >
        <form class="flex flex-col space-y-4 ml-2" action="{{ route('jefe.download') }}" method="POST">
            @csrf

            <div x-data="{showPDFOptions: false}">
                <x-input-label for="filetype" :value="__('Formato del Archivo')" />
                <x-select-input
                    id="filetype"
                    class="mt-2 w-full"
                    name="filetype"
                    x-on:change="showPDFOptions = $event.target.value == 'pdf'"
                >
                    <option value="" selected>Seleccione el formato</option>
                    {{-- Se utiliza 1 ya que si es de la fi 1 es verdadero == si es interno  --}}
                    <option id="filetype_pdf" value="pdf">PDF</option>
                    <option id="filetype_excel" value="xlsx">Excel</option>
                    <option id="filetype_csv" value="csv">CSV</option>
                </x-select-input>

                {{-- ORIENTACION --}}
                <div x-show="showPDFOptions" class="flex flex-col">
                    <x-input-label class="py-4" :value="__('Orientación')" />
                    <div class="flex justify-start gap-10">
                        <div
                             class="flex gap-2 items-center"
                        >
                                <input type="radio" name="orientacion" id="orientacion_vertical" value="portrait"/>
                                <x-input-label
                                    class="flex gap-2 items-center"
                                    for="orientacion_vertical"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                    </svg>
                                    Vertical
                                </x-input-label>
                        </div>

                        <div
                             class="flex gap-2 items-center"
                        >
                            <input type="radio" name="orientacion" id="orientacion_horizontal" value="landscape"/>
                            <x-input-label
                                class="flex gap-2 items-center"
                                for="orientacion_horizontal"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 rotate-90">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                                Horizontal
                            </x-input-label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CAMPOS REQUERIDOS --}}
            <div x-data="{ open: false }" class="rounded-md shadow-md p-3">
                <div class="flex justify-between">
                    <h2 class="text-lg">
                        Campos Requeridos
                    </h2>
                    {{-- OPCIONES GENERALES --}}
                    <fieldset class="flex gap-5 justify-end w-1/2">
                        <div class="{{ $checkboxContainerClasses }}">
                            <input name="radio_campos" id="radio_campos_default" type="radio" value="campos_default" checked/>
                            <x-input-label for="radio_campos_default" :value="__('Por Defecto')"/>
                        </div>
                        <div class="{{ $checkboxContainerClasses }}">
                            <input name="radio_campos" id="radio_campos_all" type="radio" value="campos_todos"/>
                            <x-input-label for="radio_campos_all" :value="__('Todos')"/>
                        </div>
                    </fieldset>
                    <svg x-on:click="open = !open" x-show="!open" x-transition xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                    </svg>
                    <svg x-on:click="open = !open" x-show="open" x-transition xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
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
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="correo_electrónico" class="{{ $checkboxClasses }}" id="check_correo"/>
                            <x-input-label for="check_correo" :value="__('Correo')"/>
                        </div>
                    </x-jefe.filtros>

                    <x-jefe.filtros>
                        <x-slot:title>
                            Contacto
                        </x-slot:title>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="teléfono_celular" class="{{ $checkboxClasses }}" id="check_telefono_celular"/>
                            <x-input-label for="check_telefono_celular" :value="__('Teléfono Celular')"/>
                        </div>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="teléfono_alternativo" class="{{ $checkboxClasses }}" id="check_telefono_alternativo"/>
                            <x-input-label for="check_telefono_alternativo" :value="__('Teléfono Alternativo')"/>
                        </div>
                    </x-jefe.filtros>
                    <x-jefe.filtros>
                        <x-slot:title>
                            Datos UNAM
                        </x-slot:title>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="número_cuenta" class="{{ $checkboxClasses }}" id="check_numero_cuenta"/>
                            <x-input-label for="check_numero_cuenta" :value="__('Número de Cuenta')"/>
                        </div>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="créditos" class="{{ $checkboxClasses }}" id="check_creditos_pagados"/>
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
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="escuela" class="{{ $checkboxClasses }}" id="check_escuela" checked/>
                            <x-input-label for="check_escuela" :value="__('Escuela')"/>
                        </div>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="carrera" class="{{ $checkboxClasses }}" id="check_carrera"/>
                            <x-input-label for="check_carrera" :value="__('Carrera')"/>
                        </div>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="fecha_inicio" class="{{ $checkboxClasses }}" id="check_fecha_inicio" checked/>
                            <x-input-label for="check_fecha_inicio" :value="__('Fecha Inicio')"/>
                        </div>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="fecha_fin" class="{{ $checkboxClasses }}" id="check_fecha_fin" checked/>
                            <x-input-label for="check_fecha_fin" :value="__('Fecha Fin')"/>
                        </div>
                    </x-jefe.filtros>

                    <x-jefe.filtros>
                        <x-slot:title>
                            UNICA
                        </x-slot:title>
                        <div class="{{ $checkboxContainerClasses }}">
                            <x-checkbox name="departamento" class="{{ $checkboxClasses }}" id="check_departamento" checked/>
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

            <x-primary-button
                class="w-full justify-center">
                {{ __('Descargar') }}
            </x-primary-button>
        </form>
    </x-modal>
</div>

