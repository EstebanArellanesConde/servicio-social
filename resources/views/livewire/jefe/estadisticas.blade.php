<div>
    <form wire:submit.prevent="show">
        <div class="w-full md:w-1/2 my-6 md:mt-0">
            <x-input-label for="departamento" :value="__('Departamento')" />
            <x-select-input
                id="departamento"
                class="block mt-1 w-full"
                wire:model.lazy="departamento_abreviatura"
            >
                <option value="all">Todos</option>
                @foreach($departamentos as $departamento)
                    <option value="{{ $departamento->abreviatura_departamento }}">{{$departamento->departamento}}</option>
                @endforeach
            </x-select-input>
        </div>

        <div class="flex gap-4">
            <x-stats-card class="border-yellow-500">
                <x-slot:title>
                    Pendientes
                </x-slot:title>
                <x-slot:count>
                    {{ $pendientes[$departamento_abreviatura] }}
                </x-slot:count>
                <x-slot:icon>
                    <svg class="w-12 h-12 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" >
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd" />
                    </svg>
                </x-slot:icon>
            </x-stats-card>

            <x-stats-card class="border-indigo-600">
                <x-slot:title>
                    Inscritos
                </x-slot:title>
                <x-slot:count>
                    {{ $incritos[$departamento_abreviatura] }}
                </x-slot:count>
                <x-slot:icon>
                    <svg class="w-12 h-12 text-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" >
                        <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0118 9.375v9.375a3 3 0 003-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 00-.673-.05A3 3 0 0015 1.5h-1.5a3 3 0 00-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6zM13.5 3A1.5 1.5 0 0012 4.5h4.5A1.5 1.5 0 0015 3h-1.5z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625V9.375zm9.586 4.594a.75.75 0 00-1.172-.938l-2.476 3.096-.908-.907a.75.75 0 00-1.06 1.06l1.5 1.5a.75.75 0 001.116-.062l3-3.75z" clip-rule="evenodd" />
                    </svg>
                </x-slot:icon>
            </x-stats-card>

            <x-stats-card class="border-red-500">
                <x-slot:title>
                    Rechazados
                </x-slot:title>
                <x-slot:count>
                    {{ $rechazados[$departamento_abreviatura] }}
                </x-slot:count>
                <x-slot:icon>
                    <svg class="w-12 h-12 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" >
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd" />
                    </svg>

                </x-slot:icon>
            </x-stats-card>

            <x-stats-card class="border-green-500">
                <x-slot:title>
                    Finalizados
                </x-slot:title>
                <x-slot:count>
                    {{ $finalizados[$departamento_abreviatura] }}
                </x-slot:count>
                <x-slot:icon>
                    <svg class="w-12 h-12 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" >
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
                    </svg>
                </x-slot:icon>
            </x-stats-card>
        </div>
    </form>
</div>
