<form wire:submit.prevent="store">
    <!-- NOMBRES  -->
    <div class="mt-4 md:flex md:space-x-2">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre(s)')" />
            <x-text-input id="name" wire:model.lazy="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Apellido Paterno -->
        <div class="mt-4 md:mt-0">
            <x-input-label for="apellido_paterno" :value="__('Apellido Paterno')" />
            <x-text-input id="apellido_paterno" class="block mt-1 w-full" type="text" wire:model.lazy="apellido_paterno" :value="old('apellido_paterno')" required />
            <x-input-error :messages="$errors->get('apellido_paterno')" class="mt-2" />
        </div>

        <!-- Apellido Materno -->
        <div class="mt-4 md:mt-0">
            <x-input-label for="apellido_materno" :value="__('Apellido Materno')" />
            <x-text-input id="apellido_materno" class="block mt-1 w-full" type="text" wire:model.lazy="apellido_materno" :value="old('apellido_materno')" required />
            <x-input-error :messages="$errors->get('apellido_materno')" class="mt-2" />
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

        <!-- TELEFONO ALTERNATIVO -->
        <div class="md:w-1/2">
            <x-input-label for="telefono_alternativo" :value="__('Teléfono Alternativo')" />
            <x-text-input id="telefono_alternativo" class="block mt-1 w-full" type="tel" wire:model.lazy="telefono_alternativo" :value="old('telefono_alternativo')" required />
            <x-input-error :messages="$errors->get('telefono_alternativo')" class="mt-2" />
        </div>

    </div>

    <!-- DATOS CARRERA -->
    <div class="mt-4 md:flex md:space-x-2">
        <!-- PROCEDENCIA -->
        <div class="{{ $interno == "0" || $interno == "1" || $interno == "2" ? "md:w-1/2" : "md:w-full" }} w-full mt-4 md:mt-0">
            <x-input-label for="interno" :value="__('Indique Procedencia')" />
            <x-select-input
                id="select_interno"
                class="block mt-2 w-full"
                wire:model.lazy="interno"
            >
                <option selected>Eligir Procendencia</option>
                {{-- Se utiliza 1 ya que si es interno 1 es verdadero == si es interno  --}}
                <option id="interno_fi" value="1">Facultad de Ingeniería (UNAM)</option>
                <option id="interno_unam" value="0">Otras escuelas de la UNAM</option>
                <option id="interno_externo" value="2">Externo a la UNAM</option>
            </x-select-input>
            <x-input-error :messages="$errors->get('interno')" class="mt-2" />
        </div>

        <!-- CARRERA (si es interna) -->
        <div id="carrera_interna" class="{{ $interno === "1" ? "block" : "hidden" }} w-full md:w-1/2 mt-4 md:mt-0">
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
        <div class="{{ $interno === "0" ? "block" : "hidden" }} w-full md:w-1/2 mt-4 md:mt-0">
            <x-input-label for="escuela" :value="__('Escuela')" />
            <x-select-input
                id="select_escuela"
                class="block mt-2 w-full"
                wire:model.lazy="escuela"
            >
                <option selected>Indique su escuela</option>
                <option value="69">C.C.H. PLANTEL AZCAPOTZALCO</option><option value="70">C.C.H. PLANTEL NAUCALPAN</option><option value="72">C.C.H. PLANTEL ORIENTE</option><option value="73">C.C.H. PLANTEL SUR</option><option value="71">C.C.H. PLANTEL VALLEJO</option><option value="21">CENTRO DE FISICA APLICADA Y TECNOLOGIA AVANZADA</option><option value="22">CENTRO DE INVESTIGACIONES EN ECOSISTEMAS</option><option value="75">CENTRO DE NANOCIENCIAS Y NANOTECNOLOGIA</option><option value="20">CENTRO PENINSULAR EN HUMANIDADES Y CIENCIAS SOCIAL</option><option value="18">COORDINACION DEL BACHILLERATO A DISTANCIA</option><option value="269">E.N.E.S. JURIQUILLA (CIENCIAS)</option><option value="270">E.N.E.S. JURIQUILLA (CONTADURIA)</option><option value="273">E.N.E.S. JURIQUILLA (ENERGIAS RENOVABLES)</option><option value="272">E.N.E.S. JURIQUILLA (GENOMICAS)</option><option value="271">E.N.E.S. JURIQUILLA (MEDICINA)</option><option value="274">E.N.E.S. JURIQUILLA (TECNOLOGIA)</option><option value="81">E.N.E.S. LEON</option><option value="275">E.N.E.S. LEON</option><option value="80">E.N.E.S. LEON</option><option value="259">E.N.E.S. LEON (CIENCIAS POLITICAS) </option><option value="77">E.N.E.S. LEON (CONTADURIA)</option><option value="78">E.N.E.S. LEON (ECONOMIA)</option><option value="79">E.N.E.S. LEON (FILOSOFIA)</option><option value="82">E.N.E.S. LEON (GENOMICAS)</option><option value="265">E.N.E.S. MERIDA (CIENCIAS)</option><option value="266">E.N.E.S. MERIDA (FILOSOFIA)</option><option value="83">E.N.E.S. MORELIA (ARTES PLASTICAS)</option><option value="85">E.N.E.S. MORELIA (CIENCIAS POLITICAS)</option><option value="84">E.N.E.S. MORELIA (CIENCIAS)</option><option value="86">E.N.E.S. MORELIA (FILOSOFIA)</option><option value="258">E.N.E.S. MORELIA (MUSICA)</option><option value="60">E.N.P. 1 "GABINO BARREDA"</option><option value="61">E.N.P. 2 "ERASMO CASTELLANOS  Q"</option><option value="62">E.N.P. 3 "JUSTO SIERRA"</option><option value="63">E.N.P. 4 "VIDAL CASTAÑEDA Y N."</option><option value="64">E.N.P. 5 "JOSE VASCONCELOS"</option><option value="65">E.N.P. 6 "ANTONIO CASO"</option><option value="66">E.N.P. 7 "EZEQUIEL A. CHAVEZ"</option><option value="67">E.N.P. 8 "MIGUEL E. SCHULZ"</option><option value="68">E.N.P. 9 "PEDRO DE ALBA"</option><option value="267">ESCUELA NACIONAL DE ARTES CINEMATOGRAFICAS</option><option value="280">ESCUELA NACIONAL DE CIENCIAS DE LA TIERRA</option><option value="9">ESCUELA NACIONAL DE ENFERMERIA Y OBSTETRICIA</option><option value="15">ESCUELA NACIONAL DE TRABAJO SOCIAL</option><option value="264">ESCUELA NAL. DE LENGUAS, LINGUISTICA Y TRADUCCION </option><option value="32">F.E.S. ACATLAN (ACTUARIA)</option><option value="30">F.E.S. ACATLAN (ARQUITECTURA)</option><option value="31">F.E.S. ACATLAN (ARTES PLASTICAS)</option><option value="39">F.E.S. ACATLAN (C IDIOMAS)</option><option value="33">F.E.S. ACATLAN (CIENCIAS POLITICAS)</option><option value="38">F.E.S. ACATLAN (COMPUTACION)</option><option value="34">F.E.S. ACATLAN (DERECHO)</option><option value="35">F.E.S. ACATLAN (ECONOMIA)</option><option value="36">F.E.S. ACATLAN (FILOSOFIA)</option><option value="37">F.E.S. ACATLAN (INGENIERIA)</option><option value="40">F.E.S. ACATLAN (LENGUA EXTRANJERA)</option><option value="53">F.E.S. ARAGON (AGROPECUARIO)</option><option value="47">F.E.S. ARAGON (ARQUITECTURA)</option><option value="48">F.E.S. ARAGON (CIENCIAS POLITICAS)</option><option value="49">F.E.S. ARAGON (DERECHO)</option><option value="50">F.E.S. ARAGON (ECONOMIA)</option><option value="51">F.E.S. ARAGON (FILOSOFIA)</option><option value="52">F.E.S. ARAGON (INGENIERIA)</option><option value="28">F.E.S. CUAUTITLAN (AGRICOLA)</option><option value="23">F.E.S. CUAUTITLAN (ARTES PLASTICAS)</option><option value="25">F.E.S. CUAUTITLAN (CONTADURIA)</option><option value="26">F.E.S. CUAUTITLAN (INGENIERIA)</option><option value="24">F.E.S. CUAUTITLAN (QUIMICA)</option><option value="29">F.E.S. CUAUTITLAN (TECNOLOGIA)</option><option value="27">F.E.S. CUAUTITLAN (VETERINARIA)</option><option value="44">F.E.S. IZTACALA</option><option value="41">F.E.S. IZTACALA (BIOLOGIA)</option><option value="42">F.E.S. IZTACALA (ENFERMERIA)</option><option value="43">F.E.S. IZTACALA (MEDICINA)</option><option value="46">F.E.S. IZTACALA (OPTOMETRIA)</option><option value="45">F.E.S. IZTACALA (PSICOLOGIA)</option><option value="58">F.E.S. ZARAGOZA</option><option value="54">F.E.S. ZARAGOZA (BIOLOGIA)</option><option value="56">F.E.S. ZARAGOZA (ENFERMERIA)</option><option value="57">F.E.S. ZARAGOZA (MEDICINA)</option><option value="59">F.E.S. ZARAGOZA (PSICOLOGIA)</option><option value="55">F.E.S. ZARAGOZA (QUIMICAS)</option><option value="76">F.E.S. ZARAGOZA (TRABAJO SOCIAL)</option><option value="16">FAC DE MED VETERINARIA Y ZOOTECNIA</option><option value="1">FACULTAD DE ARQUITECTURA</option><option value="2">FACULTAD DE ARTES Y DISEÑO</option><option value="3">FACULTAD DE CIENCIAS</option><option value="4">FACULTAD DE CIENCIAS POLITICAS Y SOCIALES</option><option value="6">FACULTAD DE CONTADURIA Y ADMON</option><option value="7">FACULTAD DE DERECHO</option><option value="8">FACULTAD DE ECONOMIA</option><option value="10">FACULTAD DE FILOSOFIA Y LETRAS</option><option value="11">FACULTAD DE INGENIERIA</option><option value="12">FACULTAD DE MEDICINA</option><option value="13">FACULTAD DE MUSICA</option><option value="14">FACULTAD DE ODONTOLOGIA</option><option value="17">FACULTAD DE PSICOLOGIA</option><option value="5">FACULTAD DE QUIMICA</option><option value="263">INST. DE INV. EN MATEMATICAS APLICADAS Y SISTEMAS</option><option value="19">INSTITUTO DE BIOTECNOLOGIA</option><option value="74">INSTITUTO DE ENERGIAS RENOVABLES</option>
            </x-select-input>
            <x-input-error :messages="$errors->get('escuela')" class="mt-2" />
        </div>

        <!-- ESCUELA (si es externa) -->
        <div class="{{ $interno === "2" ? "block" : "hidden" }} w-full md:w-1/2 mt-4 md:mt-0">
            <x-input-label for="escuela_text" :value="__('Escuela')" />
            <x-text-input id="escuela_text" placeholder="Indique su escuela" class="block mt-2 w-full" type="text" wire:model.lazy="escuela_text"/>
            <x-input-error :messages="$errors->get('escuela_text')" class="mt-2" />
        </div>


    </div>

    <!-- Fecha de ingreso -->
    <div class="{{ $interno == "1" ? "block" : "hidden" }} mt-4">
        <x-input-label for="fecha_ingreso_facultad" :value="__('Fecha de Ingreso a la facultad')" />
        <x-text-input id="fecha_ingreso_facultad" class="block mt-1 w-full" type="date" wire:model.lazy="fecha_ingreso_facultad" :value="old('fecha_ingreso_facultad')" required />
        <x-input-error :messages="$errors->get('fecha_ingreso_facultad')" class="mt-2" />
    </div>


    <!-- Creditos -->
    <div class="{{ $interno == "0" || $interno == "1" ? "md:flex" : "hidden" }} mt-4 md:space-x-2">
        <div class="md:w-1/2">
            <x-input-label for="creditos_pagados" :value="__('Avance de Créditos')" />
            <x-text-input id="creditos_pagados" class="block mt-1 w-full" type="number" min="0" wire:model.lazy="creditos_pagados" :value="old('creditos_pagados')" required />
            <x-input-error :messages="$errors->get('creditos_pagados')" class="mt-2" />
        </div>
        <div class="mt-4 md:mt-0 md:w-1/2">
            <x-input-label for="avance_porcentaje" :value="__('Porcentaje')" />
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
            >
                <option>Seleccione la duración</option>
                <option id="duracion_servicio_seis" value="6">6 Meses</option>
                <option id="duracion_servicio_doce" value="12">12 Meses</option>
            </x-select-input>
        </div>

        <!-- Hora inicio -->
        <div class="w-full md:w-1/3 mt-4 md:mt-0">
            <x-input-label for="hora_inicio" :value="__('Hora Inicio')" />
            <x-text-input id="hora_inicio" class="block mt-1 w-full" type="time" wire:change="verificar_duracion"  wire:model.lazy="hora_inicio" :value="old('hora_inicio')" required />
        </div>

        <!-- Hora fin -->
        <div class="w-full md:w-1/3 mt-4 md:mt-0">
            <x-input-label for="hora_fin" :value="__('Hora Fin')" />
            <x-text-input id="hora_fin" class="shadow-none border-0 block mt-1 w-full" type="time" wire:model.lazy="hora_fin" :value="old('hora_fin')" required disabled/>


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
            <x-input-error :messages="$errors->get('pertenencia_unica')" class="mt-2" />
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
                      autocomplete="new-password" />

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
        Livewire.on('comprobar_procedencia', () => {
            console.log(document.getElementById('escuela_text'))
            document.getElementById('escuela_text').value = null
        })
    </script>
@endpush
