<form wire:submit.prevent="store">
    <!-- NOMBRES  -->
    <div class="mt-4 md:flex md:space-x-2">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre(s)')" />
            <x-text-input id="name" wire:model.lazy="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus />
        </div>

        <!-- Apellido Paterno -->
        <div class="mt-4 md:mt-0">
            <x-input-label for="apellido_paterno" :value="__('Apellido Paterno')" />
            <x-text-input id="apellido_paterno" class="block mt-1 w-full" type="text" wire:model.lazy="apellido_paterno" :value="old('apellido_paterno')" />
        </div>

        <!-- Apellido Materno -->
        <div class="mt-4 md:mt-0">
            <x-input-label for="apellido_materno" :value="__('Apellido Materno')" />
            <x-text-input id="apellido_materno" class="block mt-1 w-full" type="text" wire:model.lazy="apellido_materno" :value="old('apellido_materno')"/>
        </div>
    </div>
    <div>
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
        <x-input-error :messages="$errors->get('apellido_paterno')" class="mt-2" />
        <x-input-error :messages="$errors->get('apellido_materno')" class="mt-2" />
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
        />
        <x-input-error :messages="$errors->get('curp')" class="mt-2" />
    </div>


    <!-- Genero -->
    <div class="mt-4">
        <x-input-label for="sexo" :value="__('Sexo')" />
        <x-select-input
            id="sexo"
            class="block mt-1 w-full"
            wire:model.lazy="sexo"
        >
            <option selected>Seleccione el sexo</option>
            <option id="sexo_mujer" value="H">Hombre</option>
            <option id="sexo_hombre" value="M">Mujer</option>
            <option id="sexo_otro" value="O">Otro</option>
        </x-select-input>
        <x-input-error :messages="$errors->get('sexo')" class="mt-2" />
    </div>

    <!-- Email -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" wire:model.lazy="email" :value="old('email')" autocomplete="username"/>
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- TELEFONOS  -->
    <div class="mt-4 md:flex md:space-x-2">
        <!-- TELEFONO CELULAR -->
        <div class="mt-4 md:mt-0 md:w-1/2">
            <x-input-label for="telefono_celular" :value="__('Teléfono Celular')" />
            <x-text-input id="telefono_celular" class="block mt-1 w-full" type="tel" wire:model.lazy="telefono_celular" :value="old('telefono_celular')"/>
        </div>

        <!-- TELEFONO ALTERNATIVO -->
        <div class="md:w-1/2">
            <x-input-label for="telefono_alternativo" :value="__('Teléfono Alternativo')" />
            <x-text-input id="telefono_alternativo" class="block mt-1 w-full" type="tel" wire:model.lazy="telefono_alternativo" :value="old('telefono_alternativo')"/>
        </div>
    </div>
    <div>
        <x-input-error :messages="$errors->get('telefono_celular')" class="mt-2" />
        <x-input-error :messages="$errors->get('telefono_alternativo')" class="mt-2" />
    </div>

    <!-- DATOS CARRERA -->
    <div class="mt-4 md:flex md:space-x-2">
        <!-- PROCEDENCIA -->
        <div class="{{ $procedencia == "0" || $procedencia == "1" ? "md:w-1/2" : "md:w-full" }} w-full md:mt-0">
            <x-input-label for="procedencia" :value="__('Indique Procedencia')" />
            <x-select-input
                id="select_procedencia"
                class="block mt-2 w-full"
                wire:model.lazy="procedencia"
            >
                <option selected>Eligir Procendencia</option>
                {{-- Se utiliza 1 ya que si es de la fi 1 es verdadero == si es interno  --}}
                <option id="procedencia_fi" value="1">Facultad de Ingeniería (UNAM)</option>
                <option id="procedencia_unam" value="0">Otras escuelas de la UNAM</option>
                <option id="procedencia_externo" value="2">Externo a la UNAM</option>
            </x-select-input>
        </div>

        <!-- NUMERO DE CUENTA -->
        <div class="{{ $procedencia == "0" || $procedencia == "1" ? "block" : "hidden" }} w-full md:w-1/2 md:mt-0">
            <x-input-label for="numero_cuenta" :value="__('Número de Cuenta')" />
            <x-text-input id="numero_cuenta" wire:model.lazy="numero_cuenta" class="block mt-2 w-full" type="text" wire:model.lazy="numero_cuenta" :value="old('numero_cuenta')"/>
        </div>
    </div>
        <x-input-error :messages="$errors->get('procedencia')" class="mt-2" />
        <x-input-error :messages="$errors->get('numero_cuenta')" class="mt-2" />
    <div>

    </div>

    <!-- CARRERA (si es interna) -->
    <div id="carrera_interna" class="{{ $procedencia === "1" ? "block" : "hidden" }} mt-4">
        <x-input-label for="carrera" :value="__('Carrera')" />
        <x-select-input
            id="select_carrera"
            class="block mt-2 w-full"
            wire:model.lazy="carrera"
        >
            <option selected>Seleccione carrera</option>
            @foreach($carreras as $carrera)
                <option value="{{ $carrera->id }}">{{ $carrera->carrera }}</option>
            @endforeach
        </x-select-input>
        <x-input-error :messages="$errors->get('carrera')" class="mt-2" />
    </div>

    <!-- ESCUELA (si es de la UNAM) -->
    <div class="{{ $procedencia === "0" ? "block" : "hidden" }} mt-4">
        <x-input-label for="escuela" :value="__('Escuela')" />
        <x-select-input
            id="select_escuela"
            class="block mt-2 w-full"
            wire:model.lazy="escuela"
        >
            <option selected>Indique su escuela</option>

            @foreach($escuelas as $escuela)
                <option value="{{ $escuela->id }}">{{ $escuela->escuela }}</option>
            @endforeach
        </x-select-input>
        <x-input-error :messages="$errors->get('escuela')" class="mt-2" />
    </div>

    <!-- ESCUELA (si es externa) -->
    <div class="{{ $procedencia === "2" ? "block" : "hidden" }} mt-4">
        <x-input-label for="escuela_text" :value="__('Escuela')" />
        <x-text-input id="escuela_text" placeholder="Indique su escuela" class="block mt-2 w-full" type="text" wire:model.lazy="escuela_text"/>
        <x-input-error :messages="$errors->get('escuela_text')" class="mt-2" />
    </div>


    {{--    <!-- Fecha de ingreso -->--}}
    {{--    <div class="{{ $procedencia == "1" ? "block" : "hidden" }} mt-4">--}}
    {{--        <x-input-label for="fecha_ingreso_facultad" :value="__('Fecha de Ingreso a la facultad')" />--}}
    {{--        <x-text-input id="fecha_ingreso_facultad" class="block mt-1 w-full" type="date" wire:model.lazy="fecha_ingreso_facultad" :value="old('fecha_ingreso_facultad')"/>--}}
    {{--        <x-input-error :messages="$errors->get('fecha_ingreso_facultad')" class="mt-2" />--}}
    {{--    </div>--}}


    <!-- Creditos -->
    <div class="{{ $procedencia == "0" || $procedencia == "1" ? "md:flex" : "hidden" }} mt-4 md:space-x-2">
        <div class="md:w-1/2">
            <x-input-label for="creditos_pagados" :value="__('Avance de Créditos')" />
            <x-text-input id="creditos_pagados" class="block mt-1 w-full" type="number" min="0" wire:model.lazy="creditos_pagados" :value="old('creditos_pagados')"/>
        </div>
        <div class="mt-4 md:mt-0 md:w-1/2">
            <x-input-label for="avance_porcentaje" :value="__('Porcentaje')" />
            <x-text-input id="avance_porcentaje" class="block mt-1 w-full" type="number" min="0" max="100" wire:model.lazy="avance_porcentaje" :value="old('avance_porcentaje')"/>
        </div>
    </div>
    <div>
        <x-input-error :messages="$errors->get('creditos_pagados')" class="mt-2" />
        <x-input-error :messages="$errors->get('avance_porcentaje')" class="mt-2" />
    </div>

    <!-- Promedio -->
    <div class="mt-4">
        <x-input-label for="promedio" :value="__('Promedio')" />
        <x-text-input id="promedio" class="block mt-1 w-full" type="number" min="0" max="10" step="0.01" wire:model.lazy="promedio" :value="old('promedio')"/>
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
            >
                <option>Seleccione la duración</option>
                <option id="duracion_servicio_seis" value="6">6 Meses</option>
                <option id="duracion_servicio_doce" value="12">12 Meses</option>
            </x-select-input>
        </div>

        <!-- Hora inicio -->
        <div class="w-full md:w-1/3 mt-4 md:mt-0">
            <x-input-label for="hora_inicio" :value="__('Hora Inicio')" />
            <x-text-input
                id="hora_inicio"
                class="block mt-1 w-full"
                type="time"
                wire:change="verificar_duracion"
                wire:model.lazy="hora_inicio"
                :value="old('hora_inicio')"
            />
        </div>

        <!-- Hora fin -->
        <div class="w-full md:w-1/3 mt-4 md:mt-0">
            <x-input-label for="hora_fin" :value="__('Hora Fin')" />
            <x-text-input id="hora_fin" class="shadow-none border-0 block mt-1 w-full" type="time" wire:model.lazy="hora_fin" :value="old('hora_fin')" disabled/>
        </div>
    </div>
    <div class="mt-4 md:flex md:space-x-2">
        <x-input-error :messages="$errors->get('duracion_servicio')" class="mt-2 w-full" />
        <x-input-error :messages="$errors->get('hora_inicio')" class="mt-2 w-full" />
        <x-input-error :messages="$errors->get('hora_fin')" class="mt-2 w-full" />
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
            >
                <option>Seleccione una opción</option>
                <option id="pertenencia_unica_si" value="1">Sí</option>
                <option id="pertenencia_unica_no" value="0">No</option>
            </x-select-input>
        </div>
        @if($pertenencia_unica == "1")
            <div class="w-full md:w-1/2 mt-4 md:mt-0">
                <x-input-label for="departamento_id" :value="__('Interno de UNICA')" />
                <x-select-input
                    id="departamento_id"
                    class="block mt-1 w-full"
                    wire:model.lazy="departamento_id"
                >
                    <option>Seleccione Departamento</option>
                    @foreach($departamentos as $departamento)
                        <option value="{{ $departamento->id }}">{{$departamento->departamento}}</option>
                    @endforeach
                </x-select-input>
            </div>
        @endif
    </div>
    <div>
        <x-input-error :messages="$errors->get('pertenencia_unica')" class="mt-2" />
        <x-input-error :messages="$errors->get('departamento_id')" class="mt-2" />
    </div>



    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />

        <x-text-input id="password" class="block mt-1 w-full"
                      type="password"
                      wire:model.lazy="password"
                      autocomplete="new-password"
        />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                      type="password"
                      wire:model.lazy="password_confirmation" />

        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex gap-2 items-center w-full mt-4">
        <x-checkbox
            class="ml-4"
            wire:model.lazy="aviso_de_privacidad"
            id="aviso_de_privacidad"
        />
        <x-input-label for="aviso_de_privacidad">
            He leído y acepto el
            <x-link
                href="https://www.ingenieria.unam.mx/paginas/aviso_privacidad.php"
                class="text-sky-500 dark:text-sky-500"
                target="_blank"
            >
                Aviso de Privacidad Simplificado de la Facultad de Ingeniería, UNAM
            </x-link>
        </x-input-label>
    </div>
    <x-input-error :messages="$errors->get('aviso_de_privacidad')" class="mt-2" />

    <div class="flex items-center justify-between mt-4">
        <x-link
            :href="route('login')">
            Iniciar Sesión
        </x-link>

        <x-primary-button class="ml-4">
            {{ __('Crear Solicitud') }}
        </x-primary-button>
    </div>
</form>

@push('scripts')
    <script>
        Livewire.on('comprobar_procedencia', () => {
            console.log(document.getElementById('escuela_text'))
            document.getElementById('escuela_text').value = null
        })
    </script>
@endpush
