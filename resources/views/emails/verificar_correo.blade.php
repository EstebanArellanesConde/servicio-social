@component('mail::message')
# Verifica tu cuenta

Para poder continuar con el proceso para realizar tu servicio social en la Unidad de Computo
Académico es necesario que verifiques tu correo.

<x-mail::button :url="$url">
    Confirmar Cuenta
</x-mail::button>

En caso de no haber creado una cuenta, omite este correo
@endcomponent
