<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @page{
            padding: 0;
            margin: 1.3cm 1.3cm 0.2cm 1.3cm;
        }

        @font-face {
            font-family: 'Arial';
            src: url({{ storage_path("fonts/arial/arial.ttf") }}) format("truetype");
            font-weight: normal;
        }
        @font-face {
            font-family: 'Arial';
            src: url({{ storage_path("fonts/arial/arial_bold.ttf") }}) format("truetype");
            font-weight: bold;
        }

        body{
            /*font-family: 'Arial';*/
            font-size: 9pt;
            width: 100%;
            text-align: center;
        }

        header{
            font-size: 14pt;
            font-weight: bold;
        }

        .datos__titulo{
            font-weight: bold;
            text-transform: uppercase;
        }

        .datos__container{
            border: black 1px outset;
            width: 100%;
        }

        .datos__row{
            display: flex;
        }

        .datos_dato{
            display: inline;
            text-align: left;
        }

        .datos__dato-key{
        }

        .datos__dato-value{
            font-weight: bold;
        }

        #cp_value{
            margin-right: 0.5cm;
        }

        .bold{
            font-weight: bold;
        }

        .solicito{
            font-size: 14pt;
            text-align: left;
        }

        .firmas{
            margin: 0 auto;
        }

        .firmas table {
            width: 100%;
        }

        .firmas table td{
            text-align: center;
        }

        .coordinador{
        }

        footer{
            text-align: right;
            position: absolute;

            bottom: 0;
            right: 0;
        }



    </style>
</head>
<body>
<div class="container">

<header>
    <p>
        Facultad de Ingeniería
    </p>
    <p>
        Departamento de Administración Escolar
    </p>
    <p> </p>
    <p>
        Solicitud de Autorización de Prestación del
    </p>
    <p>
        Servicio Social e Información Estadística
    </p>
</header>
<main>
    <section class="datos">
        <p class="datos__titulo">
            DATOS DEL ALUMNO
        </p>
        <table class="datos__container">
            <tr>
                <td class="datos__dato" colspan="4">
                    <span class="datos__dato-key">Nombre: </span><span class="datos__dato-value">{{ Helper::capitalize($nombreCompleto) }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato" colspan="4">
                    <span class="datos__dato-key">Dirección: </span><span class="datos__dato-value">{{ Helper::capitalize($direccion) }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Colonia: </span><span class="datos__dato-value">{{ Helper::capitalize($domicilio->colonia->nombre) }}</span>
                </td>
                <td class="datos__dato" colspan="2">
                    <span class="datos__dato-key">Delegación (municipio): </span><span class="datos__dato-value">{{ Helper::capitalize($domicilio->colonia->municipio->nombre) }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">CP: </span><span id="cp_value" class="datos__dato-value">{{ Helper::capitalize($domicilio->colonia->codigo_postal) }}</span>
                    <span class="datos__dato-key">Estado: </span><span class="datos__dato-value">{{ Helper::capitalize($domicilio->colonia->municipio->estado->nombre) }}</span>
                </td>
                <td class="datos__dato">
                    <span class="datos__dato-key">Teléfono: </span><span class="datos__dato-value">{{ $alumno->telefono_alternativo }}</span>
                </td>
                <td class="datos__dato">
                    <span class="datos__dato-key">Celular: </span><span class="datos__dato-value">{{ $alumno->telefono_celular }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">e-mail: </span><span class="datos__dato-value">{{ $alumno->user->email }}</span>
                </td>
                <td class="datos__dato">
                    <span class="datos__dato-key">Fecha de nacimiento: </span><span class="datos__dato-value">{{ $fechaNacimiento }}</span>
                </td>
            </tr>
            <br>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Número de cuenta: </span><span class="datos__dato-value">{{ $numeroCuenta }}</span>
                </td>
                <td class="datos__dato">
                    <span class="datos__dato-key">Ingreso a la F.I.: </span><span class="datos__dato-value"></span>
                </td>
            </tr>
            <br>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Clave de la carrera: </span><span class="datos__dato-value">{{ $alumno->carrera->clave_carrera }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Número de créditos pagados: </span><span class="datos__dato-value">{{ $alumno->creditos_pagados }}</span>
                </td>
                <td class="datos__dato">
                    <span class="datos__dato-key">Avance: </span><span class="datos__dato-value">{{ $alumno->avance_porcentaje }}%</span>
                </td>
                <td class="datos__dato">
                    <span class="datos__dato-key">Promedio: </span><span class="datos__dato-value">{{ $alumno->promedio }}</span>
                </td>
            </tr>
            <br>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Fecha de inicio: </span><span class="datos__dato-value">{{ $fechaInicio }}</span>
                </td>
                <td class="datos__dato">
                    <span class="datos__dato-key">Duración en meses: </span><span class="datos__dato-value">{{ $alumno->duracion_servicio }}</span>
                </td>
                <td class="datos__dato">
                    <span class="datos__dato-key">Horas/semana: </span><span class="datos__dato-value">{{ $horasSemanales }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Forma de remuneración: </span><span class="datos__dato-value">{{ App::FORMATOS['SS01']['FORMA_REMUNERACION'] }}</span>
                </td>
                <td class="datos__dato">
                    <span class="datos__dato-key">Percepción mensual: $__________</span><span class="datos__dato-value"></span>
                </td>
                <td class="datos__dato">
                    @if($alumno->sexo === 'M')
                        {{-- Si es mujer --}}
                        <span class="datos__dato-key">Género: M/<span class="datos__dato-value">F</span></span>
                    @else
                        {{-- Si es hombre --}}
                        <span class="datos__dato-key">Género: <span class="datos__dato-value">M</span>/F</span>
                    @endif
                </td>
            </tr>
            <br>
            <tr>
                <td class="datos__dato" colspan="4">
                    <p>
                        1.- Sueldo, 2.- Honorarios, 3.- Ayuda económica, 4.- Beca,
                    </p>
                </td>
            </tr>
            <tr class="datos__dato">
                <td colspan="4">
                    5.- Otro: ________________________________ 6.- No remunerado
                </td>
            </tr>
        </table>
    </section>
    <section class="datos">
        <p class="datos__titulo">
            DATOS DE LA DEPENDENCIA
        </p>
        <table class="datos__container">
            <tr>
                <td class="datos__dato" colspan="4">
                    <span class="datos__dato-key">Nombre de la dependencia: </span><span class="datos__dato-value">{{ App::DATOS_DEPENDENCIA['NOMBRE'] }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato" colspan="4">
                    <span class="datos__dato-key">Subdirección o Departamento: </span><span class="datos__dato-value">{{ App::DATOS_DEPENDENCIA['DEPARTAMENTO'] }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato" colspan="2">
                    <span class="datos__dato-key">Oficina o Sección: </span><span class="datos__dato-value">{{ App::DATOS_DEPENDENCIA['OFICINA'] }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Dirección: </span><span class="datos__dato-value">{{ App::DATOS_DEPENDENCIA['DIRECCION'] }}</span>
                </td>
                <td class="datos__dato" colspan="2">
                    <span class="datos__dato-key">Colonia: </span><span class="datos__dato-value">{{ App::DATOS_DEPENDENCIA['COLONIA'] }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">CP: </span><span id="cp_value" class="datos__dato-value">{{ App::DATOS_DEPENDENCIA['CP'] }}</span>
                </td>
                <td>
                    <span class="datos__dato-key">Delegación(Municipio): <span class="datos__dato-value">{{ App::DATOS_DEPENDENCIA['MUNICIPIO'] }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Estado: </span><span id="cp_value" class="datos__dato-value">{{ App::DATOS_DEPENDENCIA['ESTADO'] }}</span>
                </td>
                <td>
                    <span class="datos__dato-key">Teléfono: </span><span class="datos__dato-value">{{ App::DATOS_DEPENDENCIA['TELEFONO'] }}</span>
                </td>
            </tr>
        </table>
    </section>
    <section class="datos">
        <p class="datos__titulo">
            DATOS DEL PROGRAMA
        </p>
        <table class="datos__container">
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Nombre del programa: </span><span class="datos__dato-value">CAPACITACIÓN EN CÓMPUTO</span>
                </td>
                <td class="datos__dato">
                    <span class="datos__dato-key">Clave DGOSE: </span><span class="datos__dato-value">{{ $claveDGOSE }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Nombre del responsable del Programa: </span><span class="datos__dato-value">{{ App::RESPONSABLE_PROGRAMA['NOMBRE_COMPLETO'] }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Nombre del jefe inmediato: </span><span class="datos__dato-value">{{ $jefeInmediato }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Cargo: </span><span class="datos__dato-value">{{ $jefe->cargo }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Teléfono: </span><span class="datos__dato-value">{{ $jefe->telefono }}</span>
                </td>
                <td class="datos__dato">
                    <span class="datos__dato-key">e-mail: </span><span class="datos__dato-value">{{ $jefe->user->email }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Tipo de programa: </span><span class="datos__dato-value">{{ App::DATOS_PROGRAMA['TIPO_PROGRAMA'] }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato" colspan="2">
                    <p>
                        1.- Investigación, 2.- Académico-Administrativo, 3.- Servicios, 4.- Administración Pública, 5.- Docencia
                    </p>
                </td>
            </tr>
        </table>
    </section>
    <p>

    </p>
    <section class="solicito">
        <p>
            Solicito se me autorice cumplir con la prestación del servicio social en el programa
        </p>
        <p>
            mencionado.
        </p>

    </section>
    <section class="firmas">
        <table>
            <tr>
                <td>
                    {{App::DATOS_DEPENDENCIA['ESTADO']}}. a {{ $fechaHoy }}
                </td>
                <td>
                    Válido a partir del {{ $fechaHoy }}
                </td>
            </tr>
            <tr>
                <td>
                    {{-- Firma Alumno --}}
                </td>
                <td>
                    {{-- Firma Coordinador del servicio social --}}
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <p>____________________________________</p>
                </td>
                <td>
                    <p>____________________________________</p>
                </td>
            </tr>
            <tr class="coordinador">
                <td>
                    <span class="bold">
                        {{ $nombreCompleto }}
                    </span>
                </td>
                <td rowspan="3">
                    <p class="bold">
                        {{ $division->getNombreCoordinadorSS() }}
                    </p>
                    <p>
                        Coordinador{{ $division->coordinador_ss_genero === 'F' ? 'a' : '' }} del Servicio Social de la
                    </p>
                    <p>
                        {{ $division->nombre }}
                    </p>
                    <p>
                        Facultad de Ingeniería, UNAM.
                    </p>
                </td>
            </tr>
        </table>
    </section>
</main>
<footer>
    <p class="bold">
        S.S. 01
    </p>
</footer>
</div>
</body>
</html>
