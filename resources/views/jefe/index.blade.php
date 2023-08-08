@extends('layouts.jefe')

@section('main')
    <x-jefe.opciones />
    <x-crud
        :alumnos="$alumnosPendientes"
        :acciones="[
            'aceptar',
            'rechazar',
        ]"
    />
@endsection
