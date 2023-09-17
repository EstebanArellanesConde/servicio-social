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
                <th data-priority="5">Causa de baja</th>
                <th data-priority="6">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($alumnosRechazados as $alumno)
                @php
                    $data_modal_id = "modal_" .  $alumno->id;
                    $causa_modal_id = "modal_causa_" . $alumno->id;
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
                    <td>Nunca fue Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam assumenda autem beatae enim, eum expedita fugiat itaque iusto laboriosam necessitatibus nostrum obcaecati, odio ratione sapiente temporibus tenetur unde voluptates?</td>
                    <td>
                        <div class="grid grid-flow-col gap-2 w-full">
                            <button
                                type="button"
                                class="text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-lg text-sm px-4 py-1.5 showModal"
                                data-modal-id="modal_causa_{{ $alumno->id }}"
                            >
                                Causa
                            </button>
                            <button
                                type="button"
                                class="text-white bg-sky-500 hover:bg-sky-600  font-medium rounded-lg text-sm px-4 py-1.5 showModal"
                                data-modal-id="modal_{{ $alumno->id }}"
                            >
                                Datos
                            </button>
                            <button
                                type="button"
                                class="btn-accion text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm ml-6 px-4 py-1.5"
                                onclick="aceptar('{{$alumno->id}}', '{{$alumno->user->apellido_paterno}} {{ $alumno->user->apellido_materno }} {{ $alumno->user->name }}')"
                            >
                                Alta
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
                        :dataId="$causa_modal_id"
                        class="w-1/3"
                    >
                        <div class="flex flex-col w-full justify-center items-center gap-4">
                                <div>
                                    <h3>Causa de baja</h3>
                                    <textarea name="" id="" cols="30" rows="10" disabled
                                              class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-sky-500 dark:focus:border-sky-600 focus:ring-sky-500 dark:focus:ring-sky-600 rounded-md shadow-sm"
                                    >
                                        Nunca fue Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquam assumenda autem beatae enim, eum expedita fugiat itaque iusto laboriosam necessitatibus nostrum obcaecati, odio ratione sapiente temporibus tenetur unde voluptates?
                                    </textarea>
                                </div>

                                <div>
                                    <x-primary-button>
                                        Marcar como Revisado
                                    </x-primary-button>
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


