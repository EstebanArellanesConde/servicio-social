@extends('layouts.jefe_documentacion', ['title' => 'Pendientes'])

@section('main')
    @if(isset($alumnos) && isset($clave_dgose))
        @isset($clave_dgose)
            <div class="border-l-4 border-sky-500 pl-2 flex items-center gap-4">
                <p>
                    CLAVE DGOSE: <span>{{ $clave_dgose }}</span>
                </p>
                <div class="rounded px-2 py-1 bg-sky-700 text-white">
                    <p>
                        ACTIVA
                    </p>
                </div>
            </div>
        @endisset
    <div>
        <x-input-error :messages="$errors->get('fecha_inicio')" class="mt-2" />
        <x-input-error :messages="$errors->get('fecha_fin')" class="mt-2" />
    </div>
    <div class="top"></div>
    <!--Contenedor de la tabla-->
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
        <table id="example" class="stripe hover w-full">
            <thead>
            <tr>
                <th data-priority="1">Número de Cuenta</th>
                <th data-priority="2">Nombre</th>
                <th data-priority="3">Escuela</th>
                <th data-priority="4">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($alumnos as $alumno)
                @php
                    $data_modal_id = "modal_" .  $alumno->id;
                    $fechas_modal_id = "modal_asignar_fechas_" . $alumno->id;
                @endphp
                <tr>
                    @if($alumno->numero_cuenta == null)
                        <td>S/N</td>
                    @else
                        <td>{{ $alumno->numero_cuenta }}</td>
                    @endif
                    <td>{{ $alumno->user->apellido_paterno . ' ' . $alumno->user->apellido_materno . ' ' . $alumno->user->nombre }}</td>
                    <td>{{ $alumno->escuela->escuela }}</td>
                    <td>
                        <div class="grid grid-flow-col gap-2 w-full">
                            <button
                                type="button"
                                class="text-white bg-amber-500 hover:bg-amber-600 font-medium rounded-lg text-sm px-4 py-1.5 showModal"
                                data-modal-id="modal_asignar_fechas_{{ $alumno->id }}"
                            >
                                Asignar Fecha
                            </button>
                            <button
                                type="button"
                                class="text-white bg-sky-500 hover:bg-sky-600  font-medium rounded-lg text-sm px-4 py-1.5 showModal"
                                data-modal-id="modal_{{ $alumno->id }}"
                            >
                                Datos
                            </button>
                        </div>
                    </td>
                    <!-- Modal -->
                    <x-modal
                        :dataId="$data_modal_id"
                    >
                        <form>
                            <div class="grid xl:grid-cols-3">
                                <div class="pt-4 px-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre(s)</label>
                                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->user->nombre }}" disabled>
                                </div>
                                <div class="pt-4 px-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido Paterno</label>
                                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->user->apellido_paterno }}" disabled>
                                </div>
                                <div class="pt-4 px-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido Materno</label>
                                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->user->apellido_materno }}" disabled>
                                </div>
                            </div>
                            <div class="pt-5 px-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CURP</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->curp }}" disabled>
                            </div>
                            <div class="pt-5 px-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de cuenta</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->numero_cuenta }}" disabled>
                            </div>
                            <div class="pt-5 px-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexo</label>
                                @php
                                    $sexualidad = $alumno->sexo;
                                    if($sexualidad == 'H') {
                                        $sexualidad = "Hombre";
                                    } else if ($sexualidad == "M") {
                                        $sexualidad = "Mujer";
                                    } else {
                                        $sexualidad = "Otro";
                                    }
                                @endphp
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"  value="{{ $sexualidad }}" disabled>
                            </div>
                            <div class="pt-5 px-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->user->email }}" disabled>
                            </div>
                            <div class="grid xl:grid-cols-2">
                                <div class="pt-5 px-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono Celular</label>
                                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->telefono_celular }}" disabled>
                                </div>
                                <div class="pt-5 px-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono Alternativo</label>
                                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->telefono_alternativo }}" disabled>
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-2">
                                <div class="pt-5 px-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Procedencia</label>
                                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->escuela->is_unam == 1 ? 'Interno' : 'Externo' }}" disabled>
                                </div>
                                <div class="pt-5 px-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Escuela</label>
                                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->escuela->escuela }}" disabled>
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-2">
                                <div class="pt-5 px-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Forma parte de UNICA</label>
                                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->pertenencia_unica == 1 ? 'Si' : 'No' }}" disabled>
                                </div>
                                <div class="pt-5 px-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departamento</label>
                                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->abreviatura_departamento}}" disabled>
                                </div>
                            </div>
                            <div class="pt-5 px-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Promedio</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->promedio }}" disabled>
                            </div>
                            <div class="grid xl:grid-cols-3">
                                <div class="pt-5 px-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duración en Meses</label>
                                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->duracion_servicio }}" disabled>
                                </div>
                                <div class="pt-5 px-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora Inicio</label>
                                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->hora_inicio }}" disabled>
                                </div>
                                <div class="pt-5 px-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora Fin</label>
                                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->hora_fin }}" disabled>
                                </div>
                            </div>
                        </form>
                    </x-modal>

                    <x-modal
                        :dataId="$fechas_modal_id"
                    >
                        <form method="POST" action={{ route('jefe_documentacion.aceptar', ['id' => $alumno->id]) }}>
                            @method('PUT')
                            @csrf
                            <div>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Asignar Fechas de Inicio y Fin') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Asigne fecha de inicio y fin, se le asociará al alumno una clave DGOSE') }}
                                </p>

                                <p>
                                    Duración de servicio del alumno: <span class="font-bold uppercase">{{$alumno->duracion_servicio}} meses</span>
                                </p>
                            </div>
                            <div class="space-y-4">
                                <div class="mt-4 md:flex md:space-x-2">
                                    <div class="w-full space-y-2">
                                        <x-input-label for="fecha_inicio" :value="__('Fecha Inicio')" />
                                        <input
                                            class="w-full dark:bg-gray-700"
                                            type="date" name="fecha_inicio" id="fecha_inicio">
                                    </div>
                                </div>
                                <div class="mt-4 md:flex md:space-x-2">
                                    <div class="w-full space-y-2">
                                        <x-input-label for="fecha_fin" :value="__('Fecha Fin')" />
                                        <input
                                            class="w-full dark:bg-gray-700"
                                            type="date" name="fecha_fin" id="fecha_fin">
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <x-primary-button>
                                        {{ __('CONFIRMAR FECHAS') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        </form>
                    </x-modal>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    <div class="bottom"></div>
    @endif
@endsection

@section('messages')
    @if(!isset($clave_dgose))
        <x-alert type="error">
            <x-slot:title>
                No existe clave DGOSE activa para el año {{ now()->year }}
            </x-slot:title>
            <x-slot:message>
                Para dar de alta a alumnos pendientes agrega una clave DGOSE para el año 2024
            </x-slot:message>
            <a href="{{ route('configuracion.index') }}">
                <x-primary-button type="button">
                    AGREGAR CLAVE
                </x-primary-button>
            </a>
        </x-alert>
    @endif
@endsection
