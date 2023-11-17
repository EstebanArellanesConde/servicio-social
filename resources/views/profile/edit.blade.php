{{-- Verifica si es alumno o jefe para mostrar el sidebar indicado --}}
@extends( (auth()->user()->hasRole('jefe') ? 'layouts.jefe' : 'layouts.alumno'), ['title' => ''] )

@section('main')
    <div>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                @role('jefe')
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                @endrole
                @role('alumno')
                    @if(auth()->user()->alumno->hasEstado("ACEPTADO SIN DATOS"))
                    {{-- ALERTA --}}
                    <x-alert type="warn">
                        <x-slot:title>
                            Ingresa tus datos
                        </x-slot:title>
                        <x-slot:message>
                            Para continuar con el proceso del servicio social, es importante que ingreses tu
                            domicilio y las fechas dadas por tu encargado de servicio social
                        </x-slot:message>
                        <span class="text-sm italic">Nota: No es necesario que actualices tu contraseña</span>
                    </x-alert>
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="">
                            <livewire:alumno.formulario-domicilio>

                            </livewire:alumno.formulario-domicilio>
                        </div>
                    </div>
                    @endif
                @endrole
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
