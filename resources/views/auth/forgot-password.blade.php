<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Si olvidaste tu contraseña ingresa el correo con el que te registraste, te enviaremos un correo para restablecerla.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" novalidate>
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>


        <div class="flex items-center justify-between mt-4">
            <x-link :href="route('login')">
                Iniciar Sesión
            </x-link>

            <x-primary-button>
                {{ __('Enviar Correo') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
