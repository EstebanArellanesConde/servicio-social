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
                {{ __('Cambiar Rubrica') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Ingresa la rubrica con la que se llenarán los formatos generados') }}
            </p>
        </header>

        @if($existeRubrica)
            <div class="flex justify-center items-center font-bold bg-green-600 text-white rounded w-full py-3 mt-2">
                <p>
                    Ya se tiene registrada una rubrica
                </p>
            </div>
        @else
            <div class="flex justify-center items-center font-bold bg-red-500 text-white rounded w-full py-3 mt-2">
                <p>
                    Aún no se ha registrado una rubrica
                </p>
            </div>
        @endif


        <div>
            <div>
                <x-input-error :messages="$errors->get('rubrica')" class="mt-2" />
            </div>
            <div class="mt-4 md:flex md:space-x-2 flex flex-col">
                <x-input-label for="rubrica" :value="__('Rubrica')" />
                <x-signature-pad wire:model="rubrica" id="rubrica">
                </x-signature-pad>
            </div>
            <div class="flex items-center justify-between mt-4">
                <x-primary-button>
                    {{ __('Actualizar Rubrica') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</div>
