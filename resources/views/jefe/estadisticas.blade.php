@extends('layouts.jefe')

@section('main')
    <h1>Estadísticas</h1>

    <div class="pt-8">
        <form action="{{ route('jefe.carta', 1) }}" method="POST">
            @csrf
            <x-primary-button>
                Descargar formato
            </x-primary-button>
        </form>
    </div>
@endsection

