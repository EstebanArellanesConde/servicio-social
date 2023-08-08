@extends('layouts.jefe')

@section('main')
    <x-jefe.opciones />
    <x-crud
        :alumnos="$alumnosFinalizados"
    />
@endsection
