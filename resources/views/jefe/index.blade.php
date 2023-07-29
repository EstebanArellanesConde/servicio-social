@extends('layouts.jefe')

@section('main')
    <h1 class="mt-2 ml-2 mb-6">Alumnos Pendientes</h1>
    <div class="flex justify-between items-center">
        <div class="buscador w-2/4">
            <x-text-input class="p-2 w-full" placeholder="Ingresa el nombre del alumno"/>
        </div>
        <div class="flex w-1/4 justify-end gap-2">
            <x-primary-button class="filtros flex gap-2 dark:bg-blue">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                </svg>
                <h2>Filtros</h2>
            </x-primary-button>
            <x-primary-button class="descargas flex gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                <h2>Exportar</h2>
            </x-primary-button>
        </div>
    </div>
    <div class="mt-12 overflow-auto rounded-lg shadow">
        <table class="w-full">
            <thead class="bg-gray-100 border-b-2 border-gray-200">
                <tr>
                    <th class="p-3">Número de Cuenta</th>
                    <th class="p-3">Nombre</th>
                    <th class="p-3">Fecha inicio</th>
                    <th class="p-3">Fecha fin</th>
                    <th class="p-3">Carrera</th>
                    <th class="p-3">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($alumnosPendientes as $alumno)
                    <tr class="{{ $loop->iteration % 2 === 0 ? 'even:bg-gray-50' : 'odd:bg-white' }}">
                        <td class="text-center p-3 text-gray-700">{{ $alumno->numero_cuenta }}</td>
                        <td class="text-center p-3 text-gray-700">{{ $alumno->user->name . ' ' . $alumno->user->apellido_paterno . ' ' . $alumno->user->apellido_materno }}</td>
                        <td class="text-center p-3 text-gray-700">{{ $alumno->fecha_inicio ? $alumno->fecha_inicio : 'Pendiente' }}</td>
                        <td class="text-center p-3 text-gray-700">{{ $alumno->fecha_fin ? $alumno->fecha_fin : 'Pendiente' }}</td>
                        <td class="text-center p-3 text-gray-700">{{ $alumno->escuela->escuela}}</td>
                        <td class="text-center p-3 text-gray-700">
                            <div class="grid md:grid-flow-col gap-2">
                                <button type="button" class="text-white bg-green-700 hover:bg-green-800  font-medium rounded-lg text-sm px-2.5 py-2">Aceptar</button>
                                <button type="button" class="text-white bg-sky-500 hover:bg-sky-600  font-medium rounded-lg text-sm px-4 py-2 showModal" data-modal-id="modal_{{ $alumno->id }}">Datos</button>
                                <button type="button" class="text-white bg-red-700 hover:bg-red-800  font-medium rounded-lg text-sm px-2.5 py-2">Rechazar</button>
                            </div>
                        </td>

                        <!--Modal-->
                        <div class="modal w-full h-screen fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden" id="modal_{{ $alumno->id }}">
                            <div class="bg-white w-4/5 md:w-2/5 h-3/4 rounded-tl-2xl rounded-bl-2xl overflow-auto scrollbar-thin scrollbar-thumb-slate-700">
                                <div class="grid grid-cols-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="closeModal col-start-11 col-end-11 mr-5 mt-5 mb-[-10] h-6 w-6 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none hover:cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </div>
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
                                    <div class="grid xl:grid-cols-8 m-6">
                                        <button type="button" class="xl:col-start-7 xl:col-end-9 closeModal text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-2.5 py-2">Cerrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--Modal-->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@push("scripts")
    <script>
        // Obtener todos los botones que abren el modal
        const showModalButtons = document.querySelectorAll('.showModal');

        // Obtener todos los botones que cierran el modal
        const closeModalButtons = document.querySelectorAll('.closeModal');

        // Obtener todos los modales
        const modals = document.querySelectorAll('.modal');

        // Agregar el evento click a cada botón que abre el modal
        showModalButtons.forEach((button) => {
            button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-id');
            const modal = document.getElementById(modalId);
            modal.classList.add('flex');
            modal.classList.remove('hidden');
            });
        });

        // Agregar el evento click a cada botón que cierra el modal
        closeModalButtons.forEach((button) => {
            button.addEventListener('click', () => {
            const modal = button.closest('.modal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            });
        });
    </script>
@endpush
@endsection