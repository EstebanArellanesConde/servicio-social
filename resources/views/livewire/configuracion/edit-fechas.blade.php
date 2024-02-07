<form method="POST" action={{ route('jefe_documentacion.aceptar', ['id' => $alumno->id]) }}>
    @method('PUT')
    @csrf
    <div>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Asignar Fechas de Inicio y Fin') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Asigne fecha de inicio y fin, se le asociará al alumno una clave DGOSE') }}
        </p>

        <p>
            Duración de servicio del alumno: <span class="font-bold uppercase">{{$alumno->duracion_servicio}} meses</span>
        </p>
    </div>
    <div class="space-y-4">
        <div>
            <x-input-error :messages="$errors->get('fecha_inicio')" class="mt-2" />
            <x-input-error :messages="$errors->get('fecha_fin')" class="mt-2" />
        </div>
        <div class="mt-4 md:flex md:space-x-2">
            <div class="w-full space-y-2">
                <x-input-label for="fecha_inicio" :value="__('Fecha Inicio')" />
                <input
                    class="w-full dark:bg-gray-700"
                    type="date" name="fecha_inicio" id="fecha_inicio">
            </div>
        </div>
        <div class="mt-4 md:flex md:space-x-2">
            <div class="w-full space-y-2">
                <x-input-label for="fecha_fin" :value="__('Fecha Fin')" />
                <input
                    class="w-full dark:bg-gray-700"
                    type="date" name="fecha_fin" id="fecha_fin">
            </div>
        </div>
        <div class="flex items-center justify-between">
            <x-primary-button>
                {{ __('CONFIRMAR FECHAS') }}
            </x-primary-button>
        </div>
    </div>
</form>
