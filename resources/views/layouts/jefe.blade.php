@extends('layouts.app')

@section('content')
    <x-sidebar>
        <x-side-bar-link
            :href="route('jefe.index')"
            :active="request()->routeis('jefe.index')"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Alumnos Pendientes
        </x-side-bar-link>
        <x-side-bar-link :href="route('jefe.inscritos')" :active="request()->routeis('jefe.inscritos')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
            Alumnos Inscritos
        </x-side-bar-link>
        <x-side-bar-link :href="route('jefe.rechazados')" :active="request()->routeis('jefe.rechazados')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Alumnos Rechazados
        </x-side-bar-link>
        {{-- ESTADISTICAS - unicamente accesible por jefe de dsa y coordinador   --}}
        @hasanyrole('jefe_dsa|coordinador')
            <x-side-bar-link :href="route('jefe.estadisticas')" :active="request()->routeis('jefe.estadisticas')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                </svg>
                Estadísticas
            </x-side-bar-link>
        @else
            <span></span>
       @endhasanyrole
    </x-sidebar>
    <main class="w-full">
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @yield('main')
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
