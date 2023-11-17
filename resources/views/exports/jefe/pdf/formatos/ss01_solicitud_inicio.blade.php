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
            margin: 1.3cm 1.3cm 0.5cm 1.3cm;
        }

        @font-face {
        }

        html{
            font-size: 12px;
            line-height: 0.3cm;
        }

        body{
            width: 100%;
            text-align: center;
        }

        header{
            line-height: 10px;
            font-size: 14px;
        }

        .datos__titulo{
            font-weight: bold;
            text-transform: uppercase;
        }


        .datos__container{
            border: black 1px solid;
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
            font-size: 18px;
            text-align: left;
        }

        .firmas{
            margin: 0 auto;
        }

        /*table, th, td {*/
        /*    border: 1px solid black;*/
        /*    border-collapse: collapse;*/
        /*}*/

        .firmas table {
            width: 100%;
        }

        .firmas table td{
            text-align: center;
        }

        footer{
            text-align: right;
        }



    </style>
</head>
<body>
<div class="container">

<header>
    <h2>
        Facultad de Ingeniería
    </h2>
    <h2>
        Departamento de Administración Escolar
    </h2>
    <h2>
        Solicitud de Autorización de Prestación del
    </h2>
    <h2>
        Servicio Social e Información Estadística
    </h2>
</header>
<main>
    <section class="datos">
        <h3 class="datos__titulo">
            DATOS DEL ALUMNO
        </h3>
        <table class="datos__container">
            <tr>
                <td class="datos__dato" colspan="4">
                    <span class="datos__dato-key">Nombre: </span><span class="datos__dato-value">{{ $nombreCompleto }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato" colspan="4">
                    <span class="datos__dato-key">Dirección: </span><span class="datos__dato-value">{{ $direccion }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Colonia: </span><span class="datos__dato-value">{{ $domicilio->colonia->nombre }}</span>
                </td>
                <td class="datos__dato" colspan="2">
                    <span class="datos__dato-key">Alcaldía (municipio): </span><span class="datos__dato-value">{{ $domicilio->colonia->municipio->nombre }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">CP: </span><span id="cp_value" class="datos__dato-value">{{ $domicilio->colonia->codigo_postal }}</span>
                    <span class="datos__dato-key">Estado: </span><span class="datos__dato-value">{{ $domicilio->colonia->municipio->estado->nombre }}</span>
                </td>
                <td class="datos__dato">
                    <span class="datos__dato-key">Teléfono: </span><span class="datos__dato-value">{{ $telefono }}</span>
                </td>
                <td class="datos__dato">
                    <span class="datos__dato-key">Celular: </span><span class="datos__dato-value">{{ $celular }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">e-mail: </span><span class="datos__dato-value">{{ $correo }}</span>
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
                    <span class="datos__dato-key">Fecha de ingreso: </span><span class="datos__dato-value"></span>
                </td>
            </tr>
            <br>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Clave de la carrera: </span><span class="datos__dato-value">{{ $claveCarrera }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Número de créditos pagados: </span><span class="datos__dato-value">{{ $creditosPagados }}</span>
                </td>
                <td class="datos__dato">
                    <span class="datos__dato-key">Avance: </span><span class="datos__dato-value">{{ $avancePorcentaje }}%</span>
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
                    <span class="datos__dato-key">Duración en: </span><span class="datos__dato-value">{{ $alumno->duracion_servicio }} meses</span>
                </td>
                <td class="datos__dato">
                    <span class="datos__dato-key">Horas/semana: </span><span class="datos__dato-value">{{ $horasSemanales }}</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Forma de remuneración: </span><span class="datos__dato-value">6</span>
                </td>
                <td class="datos__dato">
                    <span class="datos__dato-key">Percepción mensual: $__________</span><span class="datos__dato-value"></span>
                </td>
                <td class="datos__dato">
                    @if($alumno->sexo === 'O' || $alumno->sexo === 'M')
                        {{-- Si es femenino u otro --}}
                        <span class="datos__dato-key">Género: M/<span class="datos__dato-value">F</span></span>
                    @else
                        {{-- Si masculino --}}
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
        <h3 class="datos__titulo">
            DATOS DE LA DEPENDENCIA
        </h3>
        <table class="datos__container">
            <tr>
                <td class="datos__dato" colspan="4">
                    <span class="datos__dato-key">Nombre de la dependencia: </span><span class="datos__dato-value">UNAM</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato" colspan="4">
                    <span class="datos__dato-key">Subdirección o Departamento: </span><span class="datos__dato-value">FACULTAD DE INGENIERÍA</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato" colspan="2">
                    <span class="datos__dato-key">Oficina o Sección: </span><span class="datos__dato-value">UNIDAD DE SERVICIOS DE CÓMPUTO ACADÉMICO (UNICA)</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Dirección: </span><span class="datos__dato-value">CIRCUITO EXTERIOR S/N</span>
                </td>
                <td class="datos__dato" colspan="2">
                    <span class="datos__dato-key">Colonia: </span><span class="datos__dato-value">CIUDAD UNIVERSITARIA</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">CP: </span><span id="cp_value" class="datos__dato-value">04510</span>
                </td>
                <td>
                    <span class="datos__dato-key">Estado: </span><span class="datos__dato-value">COYOACAN</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Estado: </span><span id="cp_value" class="datos__dato-value">MÉXICO D.F.</span>
                </td>
                <td>
                    <span class="datos__dato-key">Teléfono: </span><span class="datos__dato-value">56220951</span>
                </td>
            </tr>
        </table>
    </section>
    <section class="datos">
        <h3 class="datos__titulo">
            DATOS DEL PROGRAMA
        </h3>
        <table class="datos__container">
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Nombre del programa: </span><span class="datos__dato-value">CAPACITACIÓN EN CÓMPUTO</span>
                </td>
                <td class="datos__dato">
                    <span class="datos__dato-key">Clave DGOSE: </span><span class="datos__dato-value">2023-12/81-9</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Nombre del responsable del Programa: </span><span class="datos__dato-value">ING. ENRIQUE BARRANCO VITE</span>
                </td>
            </tr>
            <tr>
                <td class="datos__dato">
                    <span class="datos__dato-key">Nombre del jefe inmediato: </span><span class="datos__dato-value">{{ $jefeDepartamento }}</span>
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
                    <span class="datos__dato-key">Tipo de programa: </span><span class="datos__dato-value">3</span>
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
                    Ciudad Universitaria, Cd. Mx. a {{ $fechaHoy }}
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
                    _______________________________________________________
                </td>
                <td>
                    _______________________________________________________
                </td>
            </tr>
            <tr>
                <td>
                    <span class="bold">
                        {{ $nombreCompleto }}
                    </span>
                </td>
                <td rowspan="3">
                    <span class="bold">
                        Lic. Angélica Gutiérrez Vázquez.
                    </span>
                    <br>
                    Coordinadora del Servicio Social de la
                    <br>
                    División de Ingeniería Eléctrica
                    <br>
                    Facultad de Ingeniería, UNAM
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
