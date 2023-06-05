@extends('layouts.app')

@section('content')
    <x-sidebar>
        <x-side-bar-link :href="route('alumno.index')" :active="request()->routeis('alumno.index')">
            Datos
        </x-side-bar-link>
        <x-side-bar-link :href="route('alumno.index')">
            Informes
        </x-side-bar-link>
    </x-sidebar>
    <main class="w-full">
        @yield('main')
    </main>
@endsection
