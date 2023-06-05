@component('mail::message')
# Cambio de contraseña

Estimad@ **{{$nombre}}**.

Se le escribe para informarle que su contraseña fue cambiada exitosamene.
Si no reconoce este movimiento, favor de realizar un nuevo cambio.

Datos de acceso a la plataforma

<x-mail::panel>
    **Contraseña**: {{$contraseña}}
</x-mail::panel>

Gracias por su atención.
@endcomponent
