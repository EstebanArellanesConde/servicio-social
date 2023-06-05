<form wire:submit.prevent="store">
    <!-- NOMBRES  -->
    <div class="mt-4 md:flex md:space-x-2">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre(s)')" />
            <x-text-input id="name" wire:model.lazy="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            @error('name')
                <livewire:mostrar-alerta :message="$message"/>
            @enderror
        </div>

        <!-- Apellido Paterno -->
        <div class="mt-4 md:mt-0">
            <x-input-label for="apellido_paterno" :value="__('Apellido Paterno')" />
            <x-text-input id="apellido_paterno" class="block mt-1 w-full" type="text" wire:model.lazy="apellido_paterno" :value="old('apellido_paterno')" required />
            @error('apellido_paterno')
            <livewire:mostrar-alerta :message="$message"/>
            @enderror
        </div>

        <!-- Apellido Materno -->
        <div class="mt-4 md:mt-0">
            <x-input-label for="apellido_materno" :value="__('Apellido Materno')" />
            <x-text-input id="apellido_materno" class="block mt-1 w-full" type="text" wire:model.lazy="apellido_materno" :value="old('apellido_materno')" required />
            @error('apellido_materno')
            <livewire:mostrar-alerta :message="$message"/>
            @enderror
        </div>
    </div>

    <!-- CURP -->
    <div class="mt-4">
        <x-input-label for="curp" :value="__('CURP')" />
        <x-text-input
            id="curp"
            wire:model.lazy="curp"
            class="block mt-1 w-full"
            type="text"
            :value="old('curp')"
            required
        />
        <x-input-error :messages="$errors->get('curp')" class="mt-2" />
    </div>

    <!-- Numero de Cuenta -->
    <div class="mt-4">
        <x-input-label for="numero_cuenta" :value="__('Número de Cuenta')" />
        <x-text-input id="numero_cuenta" wire:model.lazy="numero_cuenta" class="block mt-1 w-full" type="text" wire:model.lazy="numero_cuenta" :value="old('numero_cuenta')" required />
        <x-input-error :messages="$errors->get('numero_cuenta')" class="mt-2" />
    </div>


    <!-- Genero -->
    <div class="mt-4">
        <x-input-label for="genero" :value="__('Género')" />
        <x-select-input
            id="genero"
            class="block mt-1 w-full"
            wire:model.lazy="genero"
            required
        >
            <option selected>Seleccione un Género</option>
            <option id="genero_mujer" value="H">Hombre</option>
            <option id="genero_hombre" value="M">Mujer</option>
            <option id="genero_otro" value="O">Otro</option>
        </x-select-input>
        <x-input-error :messages="$errors->get('genero')" class="mt-2" />
    </div>

    <!-- Email -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" wire:model.lazy="email" :value="old('email')" required />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- TELEFONOS  -->
    <div class="mt-4 md:flex md:space-x-2">
        <!-- TELEFONO CELULAR -->
        <div class="mt-4 md:mt-0 md:w-1/2">
            <x-input-label for="telefono_celular" :value="__('Teléfono Celular')" />
            <x-text-input id="telefono_celular" class="block mt-1 w-full" type="tel" wire:model.lazy="telefono_celular" :value="old('telefono_celular')" required />
            <x-input-error :messages="$errors->get('telefono_celular')" class="mt-2" />
        </div>

        <!-- TELEFONO DE CASA -->
        <div class="md:w-1/2">
            <x-input-label for="telefono_casa" :value="__('Teléfono de Casa')" />
            <x-text-input id="telefono_casa" class="block mt-1 w-full" type="tel" wire:model.lazy="telefono_casa" :value="old('telefono_casa')" required />
            <x-input-error :messages="$errors->get('telefono_casa')" class="mt-2" />
        </div>

    </div>


    <!-- DATOS CARRERA -->
    <div class="mt-4 md:flex md:space-x-2">

        <!-- PROCEDENCIA -->
        <div class="{{ $interno == "1" || $interno == "0" ? "md:w-1/2" : "md:w-full" }} w-full mt-4 md:mt-0">
            <x-input-label for="interno" :value="__('¿Es interno o externo a la FI?')" />
            <x-select-input
                id="select_interno"
                class="block mt-2 w-full"
                wire:model.lazy="interno"
                required
            >
                <option selected>Eligir Procendencia</option>
                <option id="interno_interno" value="0">Externo</option>
                <option id="interno_externo" value="1">Interno</option>
            </x-select-input>
            <x-input-error :messages="$errors->get('interno')" class="mt-2" />
        </div>

            <!-- CARRERA (si es externa) -->
            <div id="carrera_externa" class="{{ $interno == "0" ? "block" : "hidden" }} w-full md:w-1/2 mt-4 md:mt-0">
                <x-input-label for="carera" :value="__('Carrera')" />
                <x-text-input placeholder="Indique su carrera" class="block mt-2 w-full" type="text" wire:model.lazy="carrera" :value="old('carrera')" required />
                <x-input-error :messages="$errors->get('carrera')" class="mt-2" />
            </div>

        <!-- CARRERA (si es interna) -->
        <div id="carrera_interna" class="{{ $interno == "1" ? "block" : "hidden" }} w-full md:w-1/2 mt-4 md:mt-0">
            <x-input-label for="carrera" :value="__('Carrera')" />
            <x-select-input
                id="select_carrera"
                class="block mt-2 w-full"
                wire:model.lazy="carrera"
                required
            >
                <option selected>Seleccione una opción</option>
                @foreach($carreras as $carrera)
                    <option value="{{ $carrera->id }}">{{ $carrera->carrera }}</option>
                @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('carrera')" class="mt-2" />
        </div>
    </div>

    <!-- Fecha de ingreso -->
    <div class="mt-4">
        <x-input-label for="fecha_ingreso_facultad" :value="__('Fecha de Ingreso a la facultad')" />
        <x-text-input id="fecha_ingreso_facultad" class="block mt-1 w-full" type="date" wire:model.lazy="fecha_ingreso_facultad" :value="old('fecha_ingreso_facultad')" required />
        <x-input-error :messages="$errors->get('fecha_ingreso_facultad')" class="mt-2" />
    </div>


    <!-- Creditos -->
    <div class="mt-4 md:flex md:space-x-2">
        <div class="md:w-1/2">
            <x-input-label for="creditos_pagados" :value="__('Créditos Pagados')" />
            <x-text-input id="creditos_pagados" class="block mt-1 w-full" type="number" min="0" wire:model.lazy="creditos_pagados" :value="old('creditos_pagados')" required />
            <x-input-error :messages="$errors->get('creditos_pagados')" class="mt-2" />
        </div>
        <div class="mt-4 md:mt-0 md:w-1/2">
            <x-input-label for="avance_porcentaje" :value="__('Avance en Porcentaje')" />
            <x-text-input id="avance_porcentaje" class="block mt-1 w-full" type="number" min="0" max="100" wire:model.lazy="avance_porcentaje" :value="old('avance_porcentaje')" required />
            <x-input-error :messages="$errors->get('avance_porcentaje')" class="mt-2" />
        </div>
    </div>

    <!-- Promedio -->
    <div class="mt-4">
        <x-input-label for="promedio" :value="__('Promedio')" />
        <x-text-input id="promedio" class="block mt-1 w-full" type="number" min="0" max="10" step="0.01" wire:model.lazy="promedio" :value="old('promedio')" required />
        <x-input-error :messages="$errors->get('promedio')" class="mt-2" />
    </div>

    <!-- DATOS SERVICIO SOCIAL -->
    <div class="mt-4 md:flex md:space-x-2">
        <!-- DURACION -->
        <div class="w-full md:w-1/3 mt-4 md:mt-0">
            <x-input-label for="duracion_servicio" :value="__('Duración en Meses')" />
            <x-select-input
                id="duracion_servicio"
                class="block mt-1 w-full"
                wire:change="verificar_duracion"
                wire:model.lazy="duracion_servicio"
                required
            >
                <option>Seleccione la duración</option>
                <option id="duracion_servicio_seis" value="6">6 Meses</option>
                <option id="duracion_servicio_doce" value="12">12 Meses</option>
            </x-select-input>
            <x-input-error :messages="$errors->get('duracion_servicio')" class="mt-2" />
        </div>

        <!-- Hora inicio -->
        <div class="w-full md:w-1/3 mt-4 md:mt-0">
            <x-input-label for="hora_inicio" :value="__('Hora Inicio')" />
            <x-text-input id="hora_inicio" class="block mt-1 w-full" type="time" wire:change="verificar_duracion"  wire:model.lazy="hora_inicio" :value="old('hora_inicio')" required />
            <x-input-error :messages="$errors->get('hora_inicio')" class="mt-2" />
        </div>

        <!-- Hora fin -->
        <div class="w-full md:w-1/3 mt-4 md:mt-0">
            <x-input-label for="hora_fin" :value="__('Hora Fin')" />
            <x-text-input id="hora_fin" class="shadow-none border-0 block mt-1 w-full" type="time" wire:model.lazy="hora_fin" :value="old('hora_fin')" required disabled/>

            <x-input-error :messages="$errors->get('hora_fin')" class="mt-2" />

        </div>

    </div>

    <!-- Parte de UNICA -->
    <div class="mt-4 md:flex md:space-x-2">
        <!-- INTERNO -->
        <div class="{{ $pertenencia_unica == "1" ? "md:w-1/2" : "md:w-full" }} w-full mt-4 md:mt-0">
            <x-input-label for="pertenencia_unica" :value="__('¿Formas parte de UNICA?')" />
            <x-select-input
                id="interno_unica"
                class="block mt-1 w-full"
                wire:model.lazy="pertenencia_unica"
                required
            >
                <option>Seleccione una opción</option>
                <option id="pertenencia_unica_si" value="1">Sí</option>
                <option id="pertenencia_unica_no" value="0">No</option>
            </x-select-input>
            <x-input-error :messages="$errors->get('pertenencia_unica')" class="mt-2" />
        </div>
        @if($pertenencia_unica == "1")
            <div class="w-full md:w-1/2 mt-4 md:mt-0">
                <x-input-label for="departamento_id" :value="__('Interno de UNICA')" />
                <x-select-input
                    id="departamento_id"
                    class="block mt-1 w-full"
                    wire:model.lazy="departamento_id"
                    required
                >
                    <option>Seleccione Departamento</option>
                    @foreach($departamentos as $departamento)
                        <option value="{{ $departamento->id }}">{{$departamento->departamento}}</option>
                    @endforeach
                </x-select-input>
                <x-input-error :messages="$errors->get('departamento_id')" class="mt-2" />
            </div>
        @endif
    </div>



    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />

        <x-text-input id="password" class="block mt-1 w-full"
                      type="password"
                      wire:model.lazy="password"
                      required autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                      type="password"
                      wire:model.lazy="password_confirmation" required autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex items-center justify-between mt-4">
        <x-link :href="route('login')">
            Iniciar Sesión
        </x-link>

        <x-primary-button class="ml-4">
            {{ __('Crear Solicitud') }}
        </x-primary-button>
    </div>
</form>

@push('scripts')
    <script>
        function comprobar_interno(){
            let interno = document.getElementById('select_interno')
            // mostrar select para carreras
            if (interno.value === "interno")
            {
                document.getElementById("carrera_interna").classList.remove("hidden")
                document.getElementById("carrera_interna").classList.add("block")
            }
            else if (interno.value === "externo")
            {
                console.log("externo");
            }
        }
    </script>
@endpush
