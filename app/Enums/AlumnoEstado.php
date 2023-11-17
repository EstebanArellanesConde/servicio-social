<?php

namespace App\Enums;

enum AlumnoEstado: int
{
    case ACEPTADO = 1;
    case RECHAZADO = 2;
    case PENDIENTE = 3;
    case FINALIZADO = 4;
}
