@extends('layouts.jefe')

@section('main')
    <x-jefe.opciones />
    <x-crud
        :alumnos="$alumnosRechazados"
        :acciones="[
            'pendiente'
        ]"
    />
@endsection

