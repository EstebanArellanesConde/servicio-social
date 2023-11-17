@extends('layouts.app')

@push("styles")
    <link rel="preload" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" as="style">
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="preload" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" as="style">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endpush


@section('content')
    <x-sidebar>
        <p class="font-bold text-sm text-gray-400 mt-4 px-4">
            Alumnos
        </p>
        <x-side-bar-link
            :href="route('jefe.index')"
            :active="request()->routeis('jefe.index')"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
            </svg>
            Pendientes
        </x-side-bar-link>
        <x-side-bar-link :href="route('jefe.inscritos')" :active="request()->routeis('jefe.inscritos')">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path d="M11.644 1.59a.75.75 0 01.712 0l9.75 5.25a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.712 0l-9.75-5.25a.75.75 0 010-1.32l9.75-5.25z" />
                <path d="M3.265 10.602l7.668 4.129a2.25 2.25 0 002.134 0l7.668-4.13 1.37.739a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.71 0l-9.75-5.25a.75.75 0 010-1.32l1.37-.738z" />
                <path d="M10.933 19.231l-7.668-4.13-1.37.739a.75.75 0 000 1.32l9.75 5.25c.221.12.489.12.71 0l9.75-5.25a.75.75 0 000-1.32l-1.37-.738-7.668 4.13a2.25 2.25 0 01-2.134-.001z" />
            </svg>
            Inscritos
        </x-side-bar-link>
        <x-side-bar-link :href="route('jefe.rechazados')" :active="request()->routeis('jefe.rechazados')">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path d="M10.375 2.25a4.125 4.125 0 100 8.25 4.125 4.125 0 000-8.25zM10.375 12a7.125 7.125 0 00-7.124 7.247.75.75 0 00.363.63 13.067 13.067 0 006.761 1.873c2.472 0 4.786-.684 6.76-1.873a.75.75 0 00.364-.63l.001-.12v-.002A7.125 7.125 0 0010.375 12zM16 9.75a.75.75 0 000 1.5h6a.75.75 0 000-1.5h-6z" />
            </svg>
            Rechazados
        </x-side-bar-link>
        <x-side-bar-link :href="route('jefe.finalizados')" :active="request()->routeis('jefe.finalizados')">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z" />
                <path d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.255 4.285a.75.75 0 01-.46.71 47.878 47.878 0 00-8.105 4.342.75.75 0 01-.832 0 47.877 47.877 0 00-8.104-4.342.75.75 0 01-.461-.71c.035-1.442.121-2.87.255-4.286A48.4 48.4 0 016 13.18v1.27a1.5 1.5 0 00-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.661a6.729 6.729 0 00.551-1.608 1.5 1.5 0 00.14-2.67v-.645a48.549 48.549 0 013.44 1.668 2.25 2.25 0 002.12 0z" />
                <path d="M4.462 19.462c.42-.419.753-.89 1-1.394.453.213.902.434 1.347.661a6.743 6.743 0 01-1.286 1.794.75.75 0 11-1.06-1.06z" />
            </svg>
            Finalizados
        </x-side-bar-link>
        {{-- ESTADISTICAS - unicamente accesible por jefe de dsa y coordinador   --}}
        @hasanyrole('dsa|coordinador')
            <p class="font-bold text-sm text-gray-400 mt-4 px-4">
                Administrador
            </p>
            <x-side-bar-link :href="route('jefe.estadisticas')" :active="request()->routeis('jefe.estadisticas')">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z" clip-rule="evenodd" />
                </svg>
                Estadísticas
            </x-side-bar-link>
            <x-side-bar-link :href="route('jefe.configuracion')" :active="request()->routeis('jefe.configuracion')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                </svg>
                Configuración
            </x-side-bar-link>
       @endhasanyrole
    </x-sidebar>
    <main class="w-full overflow-x-auto">
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div id="recipients" class="p-6 space-y-5 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between">
                            <h3 class="text-2xl font-bold tracking-wider text-gray-700">
                                {{ $title }}
                            </h3>
                            @yield('options')
                        </div>
                        @if (session()->has('success'))
                            <x-alert type="success">
                                <x-slot:title>
                                    Exito
                                </x-slot:title>
                                <x-slot:message>
                                    {{ session('success') }}
                                </x-slot:message>
                            </x-alert>
                        @endif
                        @yield('main')
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push("scripts")
    <!-- jQuery -->
    <script rel="preload" type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js" as="script"></script>

    <!--Datatables -->
    <script rel="preload" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" as="script"></script>
    <script rel="preload" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" as="script"></script>
    <script rel="preload" type="text/javascript" language="javascript" src="https://cdn.datatables.net/plug-ins/1.12.1/filtering/type-based/accent-neutralise.js" as="script"></script>

    <script>

        function finalizar(id, nombre){
            Swal.fire({
                title: `¿Seguro que deseas finalizar el servicio del alumno ${nombre}?`,
                text: "Se colocará en la sección de Finalizados",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, seguro',
                cancelButtonText: 'Cancelar',
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/jefe/finalizar/${id}`;
                }
            })
        }

        function aceptar(id, nombre){
            Swal.fire({
                title: `¿Seguro que deseas aceptar al alumno ${nombre}?`,
                text: "Se colocará en la sección de inscritos",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, seguro',
                cancelButtonText: 'Cancelar',
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/jefe/aceptar/${id}`;
                }
            })
        }

        function baja(id, nombre){
            Swal.fire({
                title: `¿Seguro que deseas dar de baja al alumno ${nombre}?`,
                text: "Se colocará en la sección de rechazados",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, seguro',
                cancelButtonText: 'Cancelar',
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/jefe/rechazar/${id}`;
                }
            })
        }
    </script>
@endpush

