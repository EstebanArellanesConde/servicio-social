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
            :href="route('jefe_documentacion.index')"
            :active="request()->routeis('jefe_documentacion.index')"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
            </svg>
            Pendientes
        </x-side-bar-link>
        @can('ver estadisticas', 'configurar')
            <p class="font-bold text-sm text-gray-400 mt-4 px-4">
                Administrador
            </p>
        @endcan
        @can('ver estadisticas')
            <x-side-bar-link :href="route('jefe_documentacion.estadisticas')" :active="request()->routeis('jefe_documentacion.estadisticas')">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z" clip-rule="evenodd" />
                </svg>
                Estadísticas
            </x-side-bar-link>
        @endcan
        @can('configurar')
            <x-side-bar-link :href="route('jefe_documentacion.configuracion')" :active="request()->routeis('jefe_documentacion.configuracion')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                </svg>
                Configuración
            </x-side-bar-link>
        @endcan
    </x-sidebar>
    <main class="w-full overflow-x-auto">
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div id="recipients" class="p-6 space-y-5 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between">
                            <h3 class="text-2xl font-bold tracking-wider text-gray-700 dark:text-white">
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
    <!-- Datatables -->
    <script rel="preload" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" as="script"></script>
    <script rel="preload" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" as="script"></script>
    <script rel="preload" type="text/javascript"  src="https://cdn.datatables.net/plug-ins/1.12.1/filtering/type-based/accent-neutralise.js" as="script"></script>

    @livewire('livewire-ui-modal')
    @vite(['resources/js/jefe.js'])
@endpush

