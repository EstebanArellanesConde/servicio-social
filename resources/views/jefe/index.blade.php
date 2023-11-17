@extends('layouts.jefe', ['title' => 'Pendientes'])

@section('options')
    <x-jefe.opciones />
@endsection

@section('main')

    <div class="top"></div>
    <!--Contenedor de la tabla-->
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
    <table id="example" class="stripe hover w-full">
        <thead>
        <tr>
            <th data-priority="1">Número de Cuenta</th>
            <th data-priority="2">Nombre</th>
            <th data-priority="3">Escuela</th>
            <th data-priority="4">Departamento</th>
            <th data-priority="5">Promedio</th>
            <th data-priority="7">UNICA (interno)</th>
            <th data-priority="8">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($alumnosPendientes as $alumno)
            @php
                $data_modal_id = "modal_" .  $alumno->id;
                $departamento_modal_id = "modal_departamento_" .  $alumno->id;
            @endphp
            <tr>
                @if($alumno->numero_cuenta == null)
                    <td>S/N</td>
                @else
                    <td>{{ $alumno->numero_cuenta }}</td>
                @endif
                <td>{{ $alumno->user->apellido_paterno . ' ' . $alumno->user->apellido_materno . ' ' . $alumno->user->nombre }}</td>
                <td>{{ $alumno->escuela->escuela }}</td>
                <td>{{ $alumno->abreviatura_departamento }}</td>
                <td>{{ $alumno->promedio }}</td>
                @if($alumno->pertenencia_unica)
                    <td>Sí</td>
                @else
                    <td>No</td>
                @endif
                <td>
                    <div class="grid grid-flow-col gap-2 w-full">
                        <button
                            type="button"
                            class="btn-accion text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-2.5 py-1.5 showModal"
                            data-modal-id="modal_departamento_{{ $alumno->id }}"
                        >
                            Aceptar
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
                <!-- Modal DATOS -->
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

                <!-- Modal DEPARTAMENTO -->
                <x-modal
                    :dataId="$departamento_modal_id"
                >
                    <form>
                        @method('PUT')
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Asignar Departamento') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Asigne un departamento para poder dar de alta al alumno') }}
                            </p>
                        </header>

                        <div>
                            <div>
                                <x-input-error :messages="$errors->get('departamento')" class="mt-2" />
                            </div>
                            <div class="mt-4 md:flex md:space-x-2">
                                <!-- Periodo -->
                                <div class="w-full">
                                    <x-input-label for="departamento" :value="__('Departamento')" />
                                    <x-select-input
                                        id="departamento"
                                        class="block mt-1 w-full"
                                        name="departamento"
                                    >
                                        <option>Seleccione Departamento</option>
                                        @foreach($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}">{{$departamento->departamento}}</option>
                                        @endforeach
                                    </x-select-input>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mt-4">
                                <x-primary-button type="button"  onclick="aceptar('{{$alumno->id}}', '{{$alumno->user->apellido_paterno}} {{ $alumno->user->apellido_materno }} {{ $alumno->user->nombre }}')" >
                                    {{ __('Asignar departamento y aceptar') }}
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
    <!--Contenedor de la tabla-->
@endsection
