<div>
<form wire:submit.prevent="store">
    @method('PUT')
    <header>

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Configurar Periodos') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Modifica los periodos necesarios con su fecha de inicio y fecha de fin correspondiente') }}
        </p>
    </header>

    <div>
        <div>
            <x-input-error :messages="$errors->get('periodo')" class="mt-2" />
            <x-input-error :messages="$errors->get('fecha_inicio')" class="mt-2" />
            <x-input-error :messages="$errors->get('fecha_fin')" class="mt-2" />
        </div>
        <div class="mt-4 md:flex md:space-x-2">
            <!-- Periodo -->
            <div class="w-1/4">
                <x-input-label for="periodo" :value="__('Periodo')" />
                <x-select-input
                    id="periodo"
                    class="block mt-1 w-full"
                    wire:model.lazy="periodo"
                    wire:change="setFechas"
                >
                    <option selected>Seleccione el perido</option>
                    @foreach($periodos as $periodo)
                        <option id="{{ 'periodo_' . $periodo->periodo }}" value="{{ $periodo->id }}">{{ $periodo->periodo }}</option>
                    @endforeach
                </x-select-input>
            </div>
            <div class="w-1/3">
                <x-input-label for="fecha_inicio" :value="__('Fecha Inicio')" />
                <x-text-input
                    wire:model.lazy="fecha_inicio"
                    id="fecha_inicio"
                    class="block mt-1 w-full"
                    type="date"
                    :value="old('fecha_inicio')"
                />
            </div>
            <div class="w-1/3">
                <x-input-label for="fecha_fin" :value="__('Fecha Fin')" />
                <x-text-input
                    wire:model.lazy="fecha_fin"
                    id="fecha_fin"
                    class="block mt-1 w-full"
                    type="date"
                    :value="old('fecha_fin')"
                />
            </div>

        </div>
        <div class="flex items-center justify-between mt-4">

            <x-primary-button>
                {{ __('Actualizar Periodo') }}
            </x-primary-button>
        </div>
    </div>
</form>
</div>
