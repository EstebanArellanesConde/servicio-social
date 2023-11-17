<!DOCTYPE HTML>
<html lang="es">
<head>
    <!-- Se copiaron y pegaron estilos por compatibilidad-->
    <style>
.container{flex-direction:column;width:1000px}.header{border:1px solid grey;border-collapse:collapse;margin:20px auto;width:90%}.header td,.header th{border:1px solid grey}.header__title{color:grey;font-size:18px;font-weight:700}.header__datos{padding-left:8px}.header__datos-title{color:grey;font-size:14px;font-weight:700}.header__datos-info{color:grey;font-size:16px;text-align:center}.table{border-collapse:collapse;font-size:14px;margin:25px auto;min-width:400px;overflow:hidden;width:90%}.table td,.table th{padding:8px 15px;text-align:center}.table__campos tr{background-color:#4f81bd;color:#fff;font-weight:700}.table__registros tr{border-bottom:1px solid #ddd}.table__registros tr:nth-last-of-type(2n){background-color:#f3f3f3}.table__registros tr:last-of-type{border-bottom:1px solid #000}

/*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{-webkit-text-size-adjust:100%;line-height:1.15}body{margin:0}main{display:block}h1{font-size:2em;margin:.67em 0}hr{box-sizing:content-box;height:0;overflow:visible}pre{font-family:monospace,monospace;font-size:1em}a{background-color:transparent}abbr[title]{border-bottom:none;text-decoration:underline;-webkit-text-decoration:underline dotted;text-decoration:underline dotted}b,strong{font-weight:bolder}code,kbd,samp{font-family:monospace,monospace;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}img{border-style:none}button,input,optgroup,select,textarea{font-family:inherit;font-size:100%;line-height:1.15;margin:0}button,input{overflow:visible}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button}[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner,button::-moz-focus-inner{border-style:none;padding:0}[type=button]:-moz-focusring,[type=reset]:-moz-focusring,[type=submit]:-moz-focusring,button:-moz-focusring{outline:1px dotted ButtonText}fieldset{padding:.35em .75em .625em}legend{box-sizing:border-box;color:inherit;display:table;max-width:100%;padding:0;white-space:normal}progress{vertical-align:baseline}textarea{overflow:auto}[type=checkbox],[type=radio]{box-sizing:border-box;padding:0}[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}[type=search]::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}details{display:block}summary{display:list-item}[hidden],template{display:none}html{box-sizing:border-box;font-size:62.5%}*,:after,:before{box-sizing:inherit;margin:0;padding:0}body{font-family:Open Sans,sans-serif,Arial;font-size:1.6rem}p{color:#191919;font-size:2rem}a{text-decoration:none}h1{font-size:4rem}h2{font-size:3.6rem}h3{font-size:3rem}.container{display:flex;height:100vh;margin:0;width:100%}img{display:block;max-width:100%}
/*# sourceMappingURL=alumnosEstadisticas.css.map */

    @page {
        margin: 0cm 0cm;
    }

    /** Define now the real margins of every page in the PDF **/
    body {
        margin-top: 180px;
        margin-bottom: 14px;
    }

    .header {
        position: fixed;
        top: 10px;
        background: white;
        text-align: center;
        height: 100px;
    }

    </style>
</head>
<body>
        <table class="header">
            <tr>
                <td rowspan="3">
                    <picture>
                        <img
                            class="unica_logo"
                            src="data:image/png;base64,<?php echo base64_encode(file_get_contents(base_path('public/assets/img/unica.png'))); ?>"
                            width="250"
                            height="120"
                        >
                    </picture>
                </td>

                <th rowspan="3" class="header__title">
                    RELACIÓN DE ALUMNOS DE SERVICIO SOCIAL EN UNICA
                </th>
                <td class="header__datos">
                    <p class="header__datos-title">Responsable:</p>
                    <p class="header__datos-info">{{ $nombreResponsable }}</p>
                </td>
            </tr>
            <tr>
                <td class="header__datos">
                    <p class="header__datos-title">Departamento:</p>
                    <p class="header__datos-info">{{ $abreviaturaDepartamento }}</p>
                </td>
            </tr>
            <tr>
                <td class="header__datos">
                    <p class="header__datos-title">Periodo:</p>
                    <p class="header__datos-info">Semestre 2024-1</p>
                </td>
            </tr>
        </table>

        <main>
            <table class="table" id="TablaAlumnos">
            <thead class="table__campos">
                <tr>
                        <th>

                        </th>
                    @foreach($columnas as $columna)
                        <th>
                            {{ $columna }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="table__registros">
                @php
                    $rowCounter = 1;
                @endphp
                @foreach($alumnos as $alumno)
                    <tr>
                            <td>
                                {{ $rowCounter }}
                            </td>
                        @foreach($alumno->toArray() as $clave => $valor)
                            @if(strtolower($clave) === "nombre")
                                <td style="text-align: left; max-width: 12em">
                                    {{ $valor }}
                                </td>
                            @elseif(strtolower($clave) === "numero_cuenta" && $valor == null)
                                <td>
                                    S/N
                                </td>
                            @elseif($valor == null && $clave !== "domicilio")
                                <td>
                                    S/D
                                </td>
                            @elseif ($valor !== null)
                                <td>
                                    {{ $valor }}
                                </td>
                            @endif

                        @endforeach
                    </tr>
                    @php
                        $rowCounter++;
                    @endphp
                @endforeach
            </tbody>
            </table>
        </main>
</body>
</html>
