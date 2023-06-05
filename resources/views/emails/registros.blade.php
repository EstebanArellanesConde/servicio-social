@component('mail::message')
# Registro

Estimado **{{$nombre}}**

Su solicitud para ingresar al programa de servicio social en UNICA dentro del departamento **{{$departamento}}** ha sido aceptada.
Dentro de los próximos días será dado de alta dentro del programa y en la página del servicio social verá que su status pasa de **"PENDIENTE"** a **"ACEPTADO"**.
Cualquier problema, favor de contactar a su jefe de Departamento {{$jefe_departamento}}.

Datos de acceso a la plataforma

<x-mail::panel>
    **Contraseña**: {{$contraseña}}
</x-mail::panel>

Gracias por su atención.
@endcomponent
