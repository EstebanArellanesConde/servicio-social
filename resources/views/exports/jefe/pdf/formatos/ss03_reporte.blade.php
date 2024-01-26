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
            font-family: Serif;
            font-size: 11pt;
            padding: 0.5cm 2cm 0.1cm 2cm;
            margin: 0;
        }


        .main_table{
            width: 100%;
        }

        .main_table, .main_td{
            border: solid gray 1px;
        }

        .bold, .titulo{
            font-weight: bold;
        }

        .titulo{
            font-size: 12pt;
        }

        .right{
            text-align: right;
        }

        .center{
            text-align: center;
        }

        .horas{
            width: 2.7cm;
        }

        footer{
            position: absolute;
            bottom: 0.889cm;
            width: 17.61cm;
        }

        footer table{
            width: 16.19cm;
        }

    </style>
</head>
<body>
    <header class="right">
        Número de registro: _______/________
    </header>
    <main>
        <div class="bold">
            {{ $division->getNombreCoordinadorSS() }} <br>
            Coordinador{{ $division->coordinador_ss_genero === 'F' ? 'a' : '' }} del Servicio Social de la <br>
            {{ $division->nombre }} <br>
            Facultad de Ingeniería, UNAM. <br>
        </div>
        <div>
            <p>
                Me permito presentar a la consideración de usted, el {{ $numeroReporte }} Informe Bimestral de <br>
                Actividades correspondientes al período comprendido del {{ $periodoInicio }} al {{ $periodoFin }}.
            </p>
        </div>
        <table class="main_table">
            <tr>
                <td colspan="3" class="main_td">

                <table>
                    <tr>
                        <td colspan="2">
                            Nombre de la dependencia: {{ ucwords(App::DATOS_DEPENDENCIA['ABREVIATURA'] . ', ' .
                                App::DATOS_DEPENDENCIA['DEPARTAMENTO'] . ', ' .
                                App::DATOS_DEPENDENCIA['NOMBRE']) }}
                        </td>
                    </tr >
                    <tr>
                        <td colspan="2">
                            Nombre del programa: {{ App::DATOS_PROGRAMA['NOMBRE'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Clave DGOSE: {{ $claveDGOSE }}
                        </td>
                        <td>
                            Fecha de Inicio:  {{ $fechaInicio }}
                        </td>
                    </tr>
                </table>
                </td>
            </tr>
            <tr>
                <td rowspan="2" class="center reporte main_td titulo">
                    REPORTE DE ACTIVIDADES
                </td>
                <td colspan="2" class="center main_td bold">
                    Horas
                </td>
            </tr>
            <tr>
                <td class="center horas main_td bold">
                    En el bimestre
                </td>
                <td class="center horas main_td bold">
                    Acumuladas
                </td>
            </tr>
            <tr>
                <td class="reporte main_td">
                    <table class="reporte">
                        @foreach($actividades as $actividad)
                            <tr>
                                <td>
                                    {{ $loop->index + 1 }}.- {{ $actividad['breve_descripcion'] }} ({{ $actividad['horas'] }} {{ $actividad['horas'] == '1' ? ' hr.' : ' hrs.' }})
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </td>
                <td class="center horas main_td">
                    {{ $horasBimestre }} Horas
                </td>
                <td class="center horas main_td">
                    {{ $totalAcumuladas }} Horas
                </td>
            </tr>
        </table>
        <br>
        <div>
            <span class="titulo">
                Resultados obtenidos en beneficio de la sociedad:
            </span>
            <p>
                {{ $datos['resultado_sociedad'] }}
            </p>
        </div>
        <br>
        <div>
            <span class="titulo">
                Resultados obtenidos en la propia formación profesional:
            </span>
            <p>
                {{ $datos['resultado_profesional'] }}
            </p>
        </div>
    </main>
    <footer>
        <div class="right">
            México, Cd.Mx., a {{ $fechaHoy }}
        </div>
        <br>
        <table class="center">
            <tr>
                <td>
                    Atentamente:
                </td>
                <td>
                    Vo. Bo.
                </td>
            </tr>
            <tr>
                <td>

                </td>
                <td>

                </td>
            </tr>
            <tr>
                <td>
                    <br>
                    <br>
                    <br>
                    _________________________________
                </td>
                <td>
                    <br>
                    <br>
                    <br>
                    _________________________________
                </td>
            </tr>
            <tr>
                <td>
                    {{ $nombreCompleto }}
                </td>
                <td>
                    {{ $jefeInmediato }}
                </td>
            </tr>
            <tr>
                <td>
                    {{ $alumno->numero_cuenta }}
                </td>
                <td>

                </td>
            </tr>
        </table>
        <div>
            <p>
                c.c.p- El alumno.
            </p>
        </div>
    </footer>
</body>
</html>
