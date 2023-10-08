<section>
    <form wire:submit.prevent="store">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Actualizar Domicilio') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Es necesario que ingreses tu domicilio para continuar con el proceso del servicio social') }}
            </p>
        </header>

        <!-- DOMICILIO  -->
        <div>
            <div>
                <x-input-error :messages="$errors->get('calle')" class="mt-2" />
                <x-input-error :messages="$errors->get('numero_externo')" class="mt-2" />
                <x-input-error :messages="$errors->get('numero_interno')" class="mt-2" />
                <x-input-error :messages="$errors->get('codigo_postal')" class="mt-2" />
                <x-input-error :messages="$errors->get('colonia')" class="mt-2" />
            </div>
            <div class="mt-4 md:flex md:space-x-2">
                <!-- Calle -->
                <div class="w-1/2">
                    <x-input-label for="calle" :value="__('Calle *')" />
                    <x-text-input id="calle" wire:model.lazy="calle"
                                  oninput="this.value = this.value.toUpperCase()"
                                  class="mt-1 w-full" type="text" id="calle" name="calle" :value="old('calle')" autofocus />
                </div>

                <!-- Numero externo -->
                <div class="w-1/4">
                    <x-input-label for="numero_externo" :value="__('Número Externo *')" />
                    <x-text-input id="numero_externo" class="block mt-1 w-full" type="text" wire:model.lazy="numero_externo" :value="old('numero_externo')" />
                </div>

                <!-- Numero interno -->
                <div class="w-1/4">
                    <x-input-label Interno="numero_interno" :value="__('Número Interno')" />
                    <x-text-input id="numero_interno" class="block mt-1 w-full" type="text" wire:model.lazy="numero_interno" :value="old('numero_interno')" />
                </div>
            </div>
            <div class="w-full md:flex mt-4 space-x-2">
                <!-- Codigo Postal -->
                <div class="w-1/4">
                    <div>
                        <x-input-label for="codigo_postal" :value="__('Código Postal *')" />
                        <x-text-input
                            wire:model.lazy="codigo_postal"
                            id="codigo_postal"
                            class="block mt-1 w-full" type="text" name="codigo_postal" :value="old('codigo_postal')" autofocus />
                    </div>
                </div>
                <div class="w-1/4">
                    <x-input-label for="sexo" :value="__('Colonia *')" />
                    <x-select-input
                        id="colonias"
                        class="block mt-1 w-full"
                        wire:model.lazy="colonia"
                    >
                        @if(count($colonias) === 0)
                            <option selected>Seleccione colonia</option>
                        @else
                            @foreach($colonias as $colonia)
                                <option id="colonia_{{ $colonia->id }}" value="{{$colonia->id}}">{{ strtoupper($colonia->nombre) }}</option>
                            @endforeach
                        @endif
                    </x-select-input>
                    <x-input-error :messages="$errors->get('sexo')" class="mt-2" />
                </div>
                <div class="w-1/4">
                    <x-input-label for="municipio" :value="__('Municipio')" />
                    <x-text-input
                        wire:model.lazy="municipio"
                        id="municipio"
                        class="block mt-1 w-full opacity-70 bg-gray-100"
                        type="text"
                        :value="old('municipio')"
                        disabled
                    />
                </div>

                <div class="w-1/4">
                    <x-input-label for="estado" :value="__('Estado')" />
                    <x-text-input
                        wire:model.lazy="estado"
                        id="estado"
                        class="block mt-1 w-full opacity-70 bg-gray-100"
                        type="text"
                        :value="old('estado')"
                        disabled
                    />
                </div>

            </div>

        </div>

        <div class="mt-4 space-y-4">
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Actualizar Fechas') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Ingresa las fechas dadas por el encargado de tu servicio social') }}
                </p>
            </header>
            <div>
                <x-input-error :messages="$errors->get('fecha_inicio')" class="mt-2" />
                <x-input-error :messages="$errors->get('fecha_fin')" class="mt-2" />
            </div>
            <div class="md:flex space-x-2">
                <div class="w-1/4">
                    <x-input-label for="fecha_inicio" :value="__('Fecha Inicio')" />
                    <x-text-input
                        wire:model.lazy="fecha_inicio"
                        id="fecha_inicio"
                        class="block mt-1 w-full"
                        type="date"
                        :value="old('fecha_inicio')"
                    />
                </div>
                <div class="w-1/4">
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
        </div>

        <div class="flex items-center justify-between mt-4">

            <x-primary-button>
                {{ __('Actualizar Datos') }}
            </x-primary-button>
        </div>
    </form>
</section>

@push('scripts')
    <script>
        function updateColonia(){
            const inputCodigoPostal = document.getElementById('codigo_postal')
            if (inputCodigoPostal.value.length === 5){
                Livewire.emit('getDatosColonia')
            }
        }

        function setFormatStringCalle(){
            const calle = document.getElementById('calle');
            calle.value = calle.value.toUpperCase();
        }

        // document.getElementById('calle')
        //     .addEventListener('keyup', setFormatStringCalle)

        document.getElementById('codigo_postal')
            .addEventListener('change', updateColonia)
    </script>
@endpush
