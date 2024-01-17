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
            margin: 0;
        }

        body{
            padding: 2cm 2cm 0cm 2.5cm;
            font-family: Serif;
            margin: 0;
        }

        .header__space{
            width: 8.5cm;
        }

        .header__logo{
            width: 3.5cm;
        }

        .unam_logo{
            width: 3.5cm;
        }

        .header__mensaje{
            width: 6cm;
            text-align: right;
        }

        .director{
            width: 100%;
            display: block;
            margin-top: 2cm;
            font-size: 14px;
        }

        .director__mensaje{
            font-weight: bold;
        }

        .director__mensaje span{
            display: block;
        }

        .director__presente{
            letter-spacing: 3px;
        }

        .asunto{
            position: relative;
            font-size: 12px;
            top: 0.61cm;
            width: 10.10cm;
            text-align: right;
            left: 6.96cm;
        }

        .asunto__space{
            width: 1.5cm;
            display: block;
        }

        .nombre{
            font-weight: bold;
        }


        .texto{
            position: relative;
            font-size: 12px;
            top: 0.6cm;
            text-size-adjust: none;
        }

        .bold{
            font-weight: bold;
        }

        .upper{
            text-transform: uppercase;
        }

        .lista_actividades li{
            margin-bottom: 0.05cm;
        }

        .atentamente{
            font-size: 16px;
            margin-top: 0.8cm;
        }

        .firma__responsable-imagen{
            width: 4.2cm;
        }

        #firma__responsable-nombre{
            text-align: left;
            position: relative;
            top: -0.5cm;
        }

        .firma__responsable{
            width: 10cm;
            display: flex;
            justify-content: center;
        }

        .cpp{
            font-size: 10px;
        }

        .firma__jefe-container{
            position: relative;
        }

        #cpp_firma_imagen{
            position: absolute;
            max-width: 2cm;
        }

        .iniciales{
            position: absolute;
            top: 0.5cm;
            font-size: 12px;
        }

        footer{
            text-align: right;
            font-family: sans-serif;
        }


    </style>
</head>
<body>
<header>
    <table>
        <tr>
            <th class="header__logo" colspan="2">
                <img width="120" class="unam_logo" src="data:image/png;base64,<?php echo base64_encode(file_get_contents(base_path('resources/img/unam.png'))); ?>">
            </th>
            <th class="header__space" colspan="2">
            </th>
            <th class="header__mensaje" colspan="1">
                FACULTAD DE INGENIERÍA
                SECRETARÍA GENERAL
                UNIDAD DE SERVICIOS DE
                CÓMPUTO ACADÉMICO
                FING/SG/UNICA/SS/{{ $numAlumno }}/{{ $currentYear }}
            </th>
        </tr>
    </table>
</header>
<main>
    <section class="director">
        <div class="director__mensaje">
            <span>
                {{ App::DIRECTOR['NOMBRE'] }}
            </span>
            <span>
                Director{{ App::DIRECTOR['GENERO'] === 'F' ? 'a' : '' }}
            </span>
            <span>
                Facultad de Ingeniería, UNAM
            </span>
            <span class="director__presente">
                Presente
            </span>
        </div>
    </section>
    <section class="asunto">
        <table>
            <tr>
                <td class="asunto__titulo">Asunto:</td>
                <td class="asunto__mensaje">Carta de aceptación para la prestación del Servicio Social del</td>
            </tr>
            <tr>
                <td class="asunto__space">
                </td>
                <td class="asunto__nombre">
                    <span class="asunto__nombre-prefijo">
                        C.
                    </span>
                    <span class="nombre" id="nombre">
                        <span>{{ $nombreCompleto }}</span>.
                    </span>
                </td>
            </tr>
        </table>
    </section>

    <section class="texto">
        <p>
            Me permito informar a usted nuestra conformidad para que el C. <span class="nombre">{{ $nombreCompleto }}</span>, con número de cuenta <span class="bold" id="numero_cuenta">{{ $numeroCuenta }}</span>, de
            la carrera <span class="bold" id="carrera">{{ $carrera }}</span>, que se imparte en la Facultad a su digno cargo, preste su Servicio Social en esta
            Dependencia durante un período de <span class="bold" id="duracion_meses">{{ $duracionMeses }} meses</span>, a partir del <span class="bold" id="fecha_inicio">{{ $fechaInicio }}</span> al <span class="bold" id="fecha_fin">{{ $fechaFin }}</span>, colaborando <span class="bold" id="horas_semana">{{ $horasSemanales }}</span>
            horas a la semana, con horario de <span class="bold" id="horario">{{ $horaInicio }}-{{ $horaFin }}hrs</span>, en el programa de trabajo {{ Helper::capitalize(App::DATOS_PROGRAMA['NOMBRE']) }} número <span class="bold" id="numero_programa">{{ $claveDGOSE }}</span>,
            desarrollando las siguientes actividades fundamentales:
        </p>
        <ul class="lista_actividades">
            <li>
                Asesoría en lenguajes de programación y paquetes de biblioteca.
            </li>
            <li>
                Dar mantenimiento preventivo al equipo de cómputo.
            </li>
            <li>
                Impartición de cursos de computación y uso de paquetes.
            </li>
            <li>
                Participación en proyectos académicos y académico-administrativos.
            </li>
            <li>
                Revisión y actualización constante del software instalado en el equipo.
            </li>
            <li>
                Administración y mantenimiento de servidores.
            </li>
        </ul>

        <div class="responsables">
            <p>
                Siendo responsable del programa el <span id="responsable">Ing. Enrique Barranco Vite</span> y quien supervisará directamente las actividades del prestador el
                <br>
                <span id="jefe_departamento">{{ $jefeInmediato }}</span>
            </p>
        </div>
    </section>

    <section>
        <p class="atentamente bold">
            A t e n t a m e n t e <br>
            “POR MI RAZA HABLARÁ EL ESPÍRITU” <br>
            Ciudad Universitaria, Cd. Mx., a <span id="fecha_hoy">{{ $fechaHoy }}</span><br>
            COORDINADOR DE LA UNIDAD DE <br>
            SERVICIOS DE CÓMPUTO ACADÉMICO <br>
        </p>
    </section>

    <section class="firmas">
        <div class="firma__responsable">
            <img width="120" class="firma__responsable-imagen" src="data:image/png;base64,<?php echo base64_encode(file_get_contents(base_path($jefeUNICAFirmaPath))); ?>">
            <p class="upper bold" id="firma__responsable-nombre">
                {{ App::RESPONSABLE_PROGRAMA['NOMBRE_COMPLETO'] }}
            </p>
            <p class="cpp">
                c.c.p. Alumno
            </p>
            <div class="firma__jefe">
                <div class="firma__jefe-container">
                    <img width="120" id="cpp_firma_imagen" src="data:image/png;base64,<?php echo base64_encode(file_get_contents(base_path('resources/img/firma_ejemplo.png'))); ?>">
                    <div class="iniciales">
                        EBV/MRBP/igfm
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br>
    <footer>
        <p id="SS" class="bold">
            S.S. 02
        </p>
    </footer>
</main>
</body>
</html>
