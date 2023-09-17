@extends('layouts.jefe')

@section('main')
    <div class="top"></div>
    <!--Contenedor de la tabla-->
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
        <table id="example" class="stripe hover w-full">
            <thead>
            <tr>
                <th data-priority="1">Número de Cuenta</th>
                <th data-priority="2">Nombre</th>
                <th data-priority="3">Fecha Inicio</th>
                <th data-priority="4">Fecha Fin</th>
                <th data-priority="5">Escuela</th>
                <th data-priority="6">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($alumnosFinalizados as $alumno)
                @php
                    $data_modal_id = "modal_" .  $alumno->id;
                    $reportes_modal_id = "modal_reporte_" . $alumno->id;
                @endphp
                <tr>
                    @if($alumno->numero_cuenta == null)
                        <td>S/N</td>
                    @else
                        <td>{{ $alumno->numero_cuenta }}</td>
                    @endif
                    <td>{{ $alumno->user->apellido_paterno . ' ' . $alumno->user->apellido_materno . ' ' . $alumno->user->name }}</td>
                    <td>{{ $alumno->fecha_inicio }}</td>
                    <td>{{ $alumno->fecha_fin }}</td>
                    <td>{{ $alumno->escuela->escuela }}</td>
                    <td>
                        <div class="grid grid-flow-col gap-2 w-full">
                            <button
                                type="button"
                                class="text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-lg text-sm px-4 py-1.5 showModal"
                                data-modal-id="modal_reporte_{{ $alumno->id }}"
                            >
                                Reportes
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
                                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->user->name }}" disabled>
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
                                    <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" value="{{ $alumno->departamento->abreviatura_departamento}}" disabled>
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
                        :dataId="$reportes_modal_id"
                        class="w-full"
                    >
                        <div class="flex flex-row w-full">
                            <div class="w-1/2">
                                <img src="{{ asset('img/hoja_prueba.png') }}" alt="" width="800">
                            </div>
                            <div class="w-1/2 flex flex-col items-center gap-4 justify-center">
                                <!-- Name -->
                                <div>
                                    <x-input-label for="name" :value="__('Observaciones')" />
                                    <textarea name="" id="" cols="40" rows="10"
                                              class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-sky-500 dark:focus:border-sky-600 focus:ring-sky-500 dark:focus:ring-sky-600 rounded-md shadow-sm"
                                    >

                                        </textarea>
                                </div>

                                <div class="mt-4 md:mt-0">
                                    <x-primary-button>
                                        Marcar como Revisado
                                    </x-primary-button>
                                </div>
                            </div>
                        </div>
                    </x-modal>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    <div class="bottom"></div>
    <!--Contenedor de la tabla-->
@endsection

