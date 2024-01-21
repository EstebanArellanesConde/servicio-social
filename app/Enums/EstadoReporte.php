<?php

namespace App\Enums;

enum EstadoReporte: int
{
    case ESPERA = 1;
    case REVISION = 2;
    case CORRECCION = 3;

    case ACEPTADO = 4;
}
