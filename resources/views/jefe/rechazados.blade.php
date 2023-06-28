@extends('layouts.jefe')

@section('main')
    <h1 class="mt-2 ml-2 mb-6">Alumnos Rechazados</h1>
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
                @foreach($alumnosRechazados as $alumnos)
                <tr class="{{ $loop->iteration % 2 === 0 ? 'even:bg-gray-50' : 'odd:bg-white' }}">
                    <td class="text-center p-3 text-gray-700">{{ $alumnos->numero_cuenta }}</td>
                    <td class="text-center p-3 text-gray-700">{{ $alumnos->name . ' ' . $alumnos->apellido_paterno . ' ' . $alumnos->apellido_materno }}</td>
                    <td class="text-center p-3 text-gray-700">{{ $alumnos->fecha_inicio ? $alumnos->fecha_inicio : 'Pendiente' }}</td>
                    <td class="text-center p-3 text-gray-700">{{ $alumnos->fecha_fin ? $alumnos->fecha_fin : 'Pendiente' }}</td>
                    <td class="text-center p-3 text-gray-700">{{ $alumnos->carrera}}</td>
                    <td class="text-center p-3 text-gray-700">
                        <div className="flex flex-col w-max gap-8">
                            <ButtonGroup>
                                <button type="button" class="text-white bg-green-700 hover:bg-green-800  font-medium rounded-lg text-sm px-2.5 py-2">Volver a dar de alta</button>
                                <button type="button" class="text-white bg-sky-500 hover:bg-sky-600  font-medium rounded-lg text-sm px-3.5 py-2">Datos</button>
                            </ButtonGroup>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

