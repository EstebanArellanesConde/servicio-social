<?php

namespace App;

use Carbon\Carbon;

class app
{
    // Hora de entrada y de salida para el servicio social en unica
    const HORA_ENTRADA = "09:00";
    const HORA_SALIDA = "20:00";

    const DATOS_DEPENDENCIA = [
        'NOMBRE' => 'UNAM',
        'DEPARTAMENTO' => 'Facultad de Ingeniería',
        'OFICINA' => 'Unidad de Servicios de Cómputo Académico (UNICA)',
        'ABREVIATURA' => 'UNICA',
        'DIRECCION' => 'Circuito exterior s/n',
        'COLONIA' => 'Ciudad universitaria',
        'CP' => '04510',
        'MUNICIPIO' => 'Coyoacán',
        'ESTADO' => 'México, CDMX',
        'TELEFONO' => '56220951',
    ];

    const DATOS_PROGRAMA = [
        'NOMBRE' => 'Capacitación en Cómputo',
        'TIPO_PROGRAMA' => 3,
    ];

    const RESPONSABLE_PROGRAMA = [
        "NOMBRE_COMPLETO" => "ENRIQUE BARRANCO VITE",
        "TITULO" => "ING",
        "NOMBRE" => "ENRIQUE",
        "APELLIDO_PATERNO" => "BARRANCO",
        "APELLIDO_MATERNO" => "VITE",
        "FIRMA_PATH" => "firmas/firma_responsable.png",
    ];

    const DIRECTOR = [
        "NOMBRE" => "DR. JOSÉ ANTONIO HERNÁNDEZ ESPRIÚ",
        "GENERO" => "M",
    ];

    const FORMATOS = [
        "SS01" => [
            "FORMA_REMUNERACION" => 6
        ]
    ];

    const NUMERO_ORDINAL = [
        "1" =>  "Primer",
        "2" =>  "Segundo",
        "3" =>  "Tercer",
        "4" =>  "Cuarto",
        "5" =>  "Quinto",
        "6" =>  "Sexto",
        "7" =>  "Séptimo",
        "8" =>  "Octavo",
        "9" =>  "Noveno",
        "10" => "Décimo",
    ];
}
