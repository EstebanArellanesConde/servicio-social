@extends('layouts.jefe')

@section('main')

    <!-- Datatables -->
    <link rel="preload" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" as="style">
	<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="preload" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" as="style">
	<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

    <div class="flex sm:justify-between sm:items-center sm:flex-row flex-col items-center gap-5 mb-4">
        <h1 class="ml-4 ml">Alumnos Pendientes</h1>
        <div class="flex sm:w-1/4 sm:justify-end gap-2">
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

    <div class="top"></div>
        <!--Contenedor de la tabla-->
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
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
                    @foreach($alumnosPendientes as $alumno)
                    <tr>
                        <td>{{ $alumno->numero_cuenta }}</td>
                        <td>{{ $alumno->user->name . ' ' . $alumno->user->apellido_paterno . ' ' . $alumno->user->apellido_materno }}</td>
                        <td>{{ $alumno->fecha_inicio ? $alumno->fecha_inicio : 'Pendiente' }}</td>
                        <td>{{ $alumno->fecha_fin ? $alumno->fecha_fin : 'Pendiente' }}</td>
                        <td>{{ $alumno->escuela->escuela }}</td>
                        <td>
                            <div class="grid grid-flow-col gap-2 w-full">
                                <button type="button" class=" text-white bg-green-700 hover:bg-green-800  font-medium rounded-lg text-sm px-2.5 py-1.5">Aceptar</button>
                                <button type="button" class="text-white bg-sky-500 hover:bg-sky-600  font-medium rounded-lg text-sm px-4 py-1.5 showModal" data-modal-id="modal_{{ $alumno->id }}">Datos</button>
                                <button type="button" class="text-white bg-red-700 hover:bg-red-800  font-medium rounded-lg text-sm px-2.5 py-1.5">Rechazar</button>
                            </div>
                        </td>
                        <!-- Modal -->
                            <div class="modal w-full h-screen fixed left-0 top-0 justify-center items-center bg-black bg-opacity-50 hidden z-50" id="modal_{{ $alumno->id }}">
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
                        <!-- Modal -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    <div class="bottom"></div>
    <!--Contenedor de la tabla-->

    <style>
        /*Overrides for Tailwind CSS */
		/*Estilos del buscador y del selector*/
		.dataTables_wrapper select,
		.dataTables_wrapper .dataTables_filter input {
            font-size: 15px;
			color: #4a5568;
			padding-left: 1rem;
			padding-right: 2rem;
			padding-top: .5rem;
			padding-bottom: .5rem;
			line-height: 1.25;
			border-width: 2px;
			border-radius: .25rem;
			border-color: #edf2f7;
			background-color: #edf2f7;
		}

        /* Posicionamiento del selector y del buscador de la tabla responsive */
        .top {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.25rem /* 20px */;
        }

        @media (min-width: 960px) {
            .top {
                justify-content: space-between;
                flex-direction: row;
            }
        }

        /* Posicionamiento de la informacion y de la paginacion de la tabla responsive */
        .bottom {
            display: flex;
            flex-direction: column;
            gap: 1.25rem /* 20px */;
            text-align: center;
            margin-top: 10px;
        }
        .dataTables_wrapper .dataTables_paginate {
            text-align: center;
        }
        @media (min-width: 960px) {
            .bottom {
                justify-content: space-between;
                flex-direction: row;
            }
        }

		/*Fila - Hover*/
		table.dataTable.hover tbody tr:hover,
		table.dataTable.display tbody tr:hover {
			background-color: #E8E8E8;
		}

		/*Botones de la paginacion*/
        .dataTables_paginate{
            font-weight: 100;
            color: #dee2e6;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button { 
            margin: 0;
            border-radius: 5px;
        }

        /*Botones de la paginacion - El seleccionado*/
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #fff !important;
            background: #007bff !important;
            border-left: none;
            border-right: none;
        }

        /*Botones de la paginacion - Hover*/
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: #fff !important;
            background: #007bff !important;
            border-left: none;
            border-right: none;
        }

        /*Botones de la paginacion - Hover*/
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #0257B2 !important;
            background: #dee2e6 !important;
            border: 0.5px solid #D1D1D1;
        }

		/*Padding inferior del borde */
		table.dataTable.no-footer {
			border-bottom: 1px solid #e2e8f0;
		}

		/*Change colour of responsive icon*/
		table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
		table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
			background-color: #0C79CE !important;
		}
        /* Estilos del boton al ser una pantalla pequeña */
        table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child:before {
            top: 9px;
            left: 4px;
            height: 16px;
            width: 16px;
            display: block;
            position: absolute;
            color: white;
            border: 2px solid white;
            border-radius: 15px;
            box-shadow: 0 0 3px #444;
            box-sizing: border-box;
            text-align: center;
            text-indent: 0 !important;
            font-family: 'Courier New', Courier, monospace;
            line-height: 14px;
            content: '+';   
        }
        table.dataTable tbody th, table.dataTable tbody td {
            padding: 8px 10px; /* Añadir paddin a cada celda de la tabla */
        }
        table.dataTable tbody tr {
        text-align: center; /* Centrar el texto de toda la tabla */
        }
        table.dataTable thead tr th,
        table.dataTable tbody tr td {
            font-size: 15px; /* Tamaño de fuente de la tabla asi como su interlineado */
            line-height: 1;
        }
        table.dataTable tbody tr td button {
            font-size: 13px; /* Tamaño de fuente del boton */
        }
        table.dataTable>tbody>tr.child span.dtr-title {
            margin-left: -6px; /* Margen corregido al ser responsive en una pantalla pequeña  */
            margin-bottom: 5px;
        }
        .dataTables_scrollHeadInner {
            margin-top: 10px; /* Agrega un margen superior de 10px por encima del buscador y de los filtros */
        }
        .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
            font-size: 15px;
        }
    </style>
    
    @push("scripts")
    <!-- jQuery -->
    <script rel="preload" type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js" as="script"></script>

    <!--Datatables -->
    <script rel="preload" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" as="script"></script>
    <script rel="preload" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" as="script"></script>
    <script rel="preload" type="text/javascript" language="javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/filtering/type-based/accent-neutralise.js" as="script"></script>

    <script>

        $(document).ready(function() {
            // Inicializar la tabla con el complemento DataTables
            var table = $('#example').DataTable({
                responsive: true, // Opción para hacer la tabla responsive
                "scrollY": "430px", // Establecer una altura fija y agregar una barra de desplazamiento vertical
                "columnDefs": [
                    {"orderable": false, "targets": -1} // Definir opciones para las columnas
                ],
                "lengthMenu": [8, 25, 50, 100], // Opciones para la paginación
                "pageLength": 8, // Cantidad de registros mostrados por página de manera predeterminada
                // Traducciones personalizadas para la interfaz de usuario
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros", // Mensaje de cantidad de registros por página
                    "zeroRecords": "No se encontraron resultados", // Mensaje cuando no se encuentran registros
                    "info": "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros", // Mensaje de información de paginación
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros", // Mensaje cuando no hay registros
                    "infoFiltered": "(Filtrado de un total de _MAX_ registros)", // Mensaje de filtrado
                    "sSearch": "Buscar:", // Etiqueta del campo de búsqueda
                    "oPaginate": { // Etiquetas para la paginación
                        "sFirst": "Primero",
                        "sLast": "Ultimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "sProcessing": "Procesando..." // Mensaje mientras se procesa la tabla
                },
                dom: '<"top"lf>rt<"bottom"ip>' // Definir la ubicacion de de los elementos de la tabla
            }).columns.adjust().responsive.recalc(); // Ajustar las columnas y recalcular la responsividad de la tabla

            const tableContainer = document.getElementById('recipients'); // Obtener el contenedor de la tabla

            // Agregar el evento click usando delegación de eventos para abrir los modales
            tableContainer.addEventListener('click', (event) => {
                const button = event.target.closest('.showModal'); // Buscar el botón más cercano con la clase 'showModal'
                if (button) {
                    const modalId = button.getAttribute('data-modal-id'); // Obtener el ID del modal desde el atributo 'data-modal-id' del botón
                    const modal = document.getElementById(modalId); // Obtener el modal usando el ID y mostrarlo
                    modal.classList.add('flex'); // Mostrar el modal cambiando su clase a 'flex'
                    modal.classList.remove('hidden'); // Asegurarse de que no tenga la clase 'hidden'
                }
            });

            // Agregar el evento click usando delegación de eventos para cerrar los modales
            tableContainer.addEventListener('click', (event) => {
                const button = event.target.closest('.closeModal'); // Buscar el botón más cercano con la clase 'closeModal'
                if (button) {
                    const modal = button.closest('.modal'); // Obtener el modal más cercano al botón y ocultarlo
                    modal.classList.remove('flex'); // Ocultar el modal quitando la clase 'flex'
                    modal.classList.add('hidden'); // Asegurarse de que tenga la clase 'hidden'
                }
            });
        });
    </script>
@endpush
@endsection