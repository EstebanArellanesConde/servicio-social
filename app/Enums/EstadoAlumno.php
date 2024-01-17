<?php

namespace App\Enums;

enum EstadoAlumno: int
{
    /**
     * el alumno se registro pero no se le ha asignado fecha de inicio ni fin
     */
    case REGISTRADO = 1;

    /**
     * se asigno fecha de inicio y fin, se le solicita ingresar domicilio para generar formatos
     */
    case PREACEPTADO = 2;
    /**
     * el alumno genero ya sus documetos, se encargo de subirlos a la plataforma correspondiente
     * y aunque no se sabe si fueron aceptados en su coordinación puede comenzar a generar los
     * reportes 2 meses después de la fecha de inicio
     */
    case ACEPTADO = 3;

    /**
     * El alumno genero todos sus reportes, ya puede solicitar su carta de finalización
     */
    case FINALIZADO = 4;

    /**
     * Por algún motivo se ha rechazado solicitud (se mantiene por si acaso este estado)
     */
    case RECHAZADO = 5;
}
