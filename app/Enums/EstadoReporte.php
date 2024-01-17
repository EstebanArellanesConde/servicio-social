<?php

namespace App\Enums;

enum EstadoReporte: int
{
    case INICIAL = 1;
    case ESPERA = 2;
    case REVISION = 3;
    case CORRECCION = 4;

    case ACEPTADO = 5;
}
