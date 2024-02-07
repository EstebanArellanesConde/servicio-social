<div>
    @if (session()->has('message'))
        <x-alert type="success">
            <x-slot:title>
                Exito
            </x-slot:title>
            <x-slot:message>
                {{ session('message') }}
            </x-slot:message>
        </x-alert>
    @endif
    <form wire:submit.prevent="store">
        @method('PUT')
        <header>

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Configurar Clave DGOSE') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Selecciona un año e ingresa una clave') }}
            </p>
        </header>

        <div>
            <div class="text-black dark:text-white">
                <x-input-warning :messages="$errors->get('no-clave')" class="mt-2" />
                <x-input-error :messages="$errors->get('clave')" class="mt-2" />
            </div>
            <div class="mt-4 md:flex md:space-x-2">
                <!-- Periodo -->
                <div class="w-1/4">
                    <x-input-label for="anio" :value="__('Año')" />
                    <x-select-input
                        id="anio"
                        class="block mt-1 w-full"
                        wire:model.lazy="anio"
                        wire:change="setClave"
                    >
                        <option selected>Seleccione el año</option>
                        @foreach($claves as $clave)
                            <option id="{{ 'clave_' . $clave->anio }}" value="{{ $clave->anio }}">{{ $clave->anio }}</option>
                        @endforeach
                    </x-select-input>
                </div>
                <div class="w-1/3">
                    <x-input-label for="clave" :value="__('Clave')" />
                    <x-text-input
                        wire:model.lazy="clave"
                        id="clave"
                        class="block mt-1 w-full"
                        type="text"
                        placeholder="Ingresa una clave"
                        :value="old('clave')"
                    />
                </div>

            </div>
            <div class="flex items-center justify-between mt-4">

                <x-primary-button>
                    {{ __('Actualizar Clave') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</div>
