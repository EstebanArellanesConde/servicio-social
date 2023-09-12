@push('styles')
    <!-- Datatables -->
    <link rel="preload" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" as="style">
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="preload" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" as="style">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush

<div>
    <div class="top"></div>
    <!--Contenedor de la tabla-->
    <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
        <table id="example" class="stripe hover w-full">
            <thead>
            <tr>
                <th data-priority="1">Número de Cuenta</th>
                <th data-priority="2">Nombre</th>
                <th data-priority="3">Fecha inicio</th>
                <th data-priority="4">Fecha fin</th>
                <th data-priority="5">Carrera</th>
                <th data-priority="6">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($alumnos as $alumno)
                @php
                    $data_modal_id = "modal_" .  $alumno->id
                @endphp
                <tr>
                    <td>{{ $alumno->numero_cuenta }}</td>
                    <td>{{ $alumno->user->name . ' ' . $alumno->user->apellido_paterno . ' ' . $alumno->user->apellido_materno }}</td>
                    <td>{{ $alumno->fecha_inicio ? $alumno->fecha_inicio : 'Pendiente' }}</td>
                    <td>{{ $alumno->fecha_fin ? $alumno->fecha_fin : 'Pendiente' }}</td>
                    <td>{{ $alumno->escuela->escuela }}</td>
                    <td>
                        <div class="grid grid-flow-col gap-2 w-full">
                            @empty(!$acciones)
                                @foreach($acciones as $accion)
                                    <button
                                        type="button"
                                        class="text-white bg-{{ $accion->color }}-500 hover:bg-{{ $accion->color }}-600 font-medium rounded-lg text-sm px-2.5 py-1.5"
                                    >
                                        <a href="{{ route($accion->route, $alumno->id) }}">
                                            {{ $accion->accion }}
                                        </a>
                                    </button>
                                @endforeach
                            @endempty
                            <button
                                type="button"
                                class="text-white bg-sky-500 hover:bg-sky-600  font-medium rounded-lg text-sm px-4 py-1.5 showModal"
                                data-modal-id="{{ $data_modal_id }}"
                            >
                                Datos
                            </button>
                        </div>
                    </td>
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
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="bottom"></div>
    <!--Contenedor de la tabla-->
</div>
@push("scripts")
    <!-- jQuery -->
    <script rel="preload" type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js" as="script"></script>
    <!--Datatables -->
    <script rel="preload" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" as="script"></script>
    <script rel="preload" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" as="script"></script>
    <script rel="preload" type="text/javascript" language="javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/filtering/type-based/accent-neutralise.js" as="script"></script>
@endpush

