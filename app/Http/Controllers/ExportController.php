<?php

namespace App\Http\Controllers;


use App\Exports\AlumnosExport;
use App\Models\Alumno;
use App\Models\Departamento;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bootstrap\HandleExceptions;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use function Pest\Laravel\instance;

class ExportController extends Controller{

    public $columnasPermitidas;
    public $filtrosPermitidos;
    public $nombreResponsable;
    public $abreviaturaDepartamento;
    public $columnasDefault;

    public function __construct()
    {
        $this->columnasPermitidas = [
            'ID' => 'alumnos.id',
            'Curp' => 'curp',
            'Correo Electrónico' => 'users.email',
            'Fecha Nacimiento' => 'fecha_nacimiento',
            'Sexo' => 'sexo',
            'Teléfono Celular' => 'telefono_celular',
            'Teléfono Alternativo' => 'telefono_alternativo',
            'Número Cuenta' => 'numero_cuenta',
            'Créditos' => 'creditos_pagados',
            'Avance' => 'avance_porcentaje',
            'Promedio' => 'promedio',
            'Escuela' => 'escuelas.escuela',
            'Fecha Inicio' => 'alumnos.fecha_inicio',
            'Fecha Fin' => 'alumnos.fecha_fin',
            'Carrera' => 'carreras.carrera',
            'Departamento' => 'abreviatura_departamento',
        ];

        $this->filtrosPermitidos = [
            'sexo' => [
                'hombre' => null,
                'mujer' => null,
                'otro' => null,
            ],

            'procedencia' => [
                'facultad_ingenieria' => null,
                'unam' => null,
                'externo' => null,
            ],

        ];

        $this->columnasDefault = [
            'Apellido Paterno' => 'users.apellido_paterno',
            'Apellido Materno' => 'users.apellido_materno',
            'Nombre' => 'users.name',
            'Departamento' => 'abreviatura_departamento',
        ];

        // obtener todos los departamentos y agregarlo como filtro
        $departamentos = Departamento::all()->pluck('abreviatura_departamento')->toArray();
        foreach ($departamentos as $departamento){
            $this->filtrosPermitidos[] = $departamento;
        }
    }

    public function store(Request $request){
        // almacenamos todos los datos
        $data = $request->all();
        $defaultFilename='alumnos';

        // Nombre completo del responsable
        $this->nombreResponsable = auth()->user()->name . ' ' .
                             auth()->user()->apellido_paterno . ' ' .
                             auth()->user()->apellido_materno;



        $columnasSeleccionadas = $this->getSelectedColumnas($data);
        $sexosSeleccionados = $this->getSelectedSexos($data);
        $departamentosSeleccionados = $this->getSelectedDepartamentos($data);
        $procedenciasSeleccionadas = $this->getSelectedProcedencias($data);

        $alumnos = new AlumnosExport($columnasSeleccionadas);

        $jefeId = $this->getJefeByUserId(auth()->user()->id)->id;
        $this->abreviaturaDepartamento = $this->getDepartamentoByJefeId($jefeId)->abreviatura_departamento;

        $alumnos
            ->forSexo($sexosSeleccionados)
            ->forDepartamento($departamentosSeleccionados)
            ->forProcedencia($procedenciasSeleccionadas);


        if($data['filetype'] === "pdf"){
            $pdf = PDF::loadView(
                'exports.jefe.pdf.tabla_alumnos',
                [
                    'columnas' => $alumnos->heading,
                    'alumnos' => $alumnos->query()->get(),
                    'nombreResponsable' => $this->nombreResponsable,
                    'abreviaturaDepartamento' => $this->abreviaturaDepartamento,
                ],
            )->setPaper('letter', $data['orientacion'] === 'landscape' ? 'landscape' : 'portrait');

            /**
             * Agregar footer con
             * - Fecha
             * - Numero de pagina
             * - Codigo de departamento (control de calidad)
             */
            $pdf->render();
            $canvas = $pdf->getCanvas();
            $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {
                $today = Carbon::today()->format('d/m/Y');
                $codigoDocumento= 'DSA21382130921';
                $pageNumber = "$pageNumber / $pageCount";
                $font = $fontMetrics->getFont('helvetica');
                $color = [
                    0,
                    0,
                    0,
                    "0.8"
                ];
                $pageWidth = $canvas->get_width();
                $pageHeight = $canvas->get_height();
                $size = 12;
                $pageNumberWidth = $fontMetrics->getTextWidth($pageNumber, $font, $size);
                $todayTextWidth = $fontMetrics->getTextWidth($today, $font, $size);
                $codigoDocumentoWidth = $fontMetrics->getTextWidth($codigoDocumento, $font, $size);
                $canvas->text($todayTextWidth - 20, $pageHeight - 20, $today, $font, $size, $color);
                $canvas->text($pageWidth/2 - $pageNumberWidth + 20, $pageHeight - 20, $pageNumber, $font, $size, $color);
                $canvas->text($pageWidth - $codigoDocumentoWidth - 40, $pageHeight - 20, $codigoDocumento, $font, $size, $color);
            });

            // abrir pdf en nueva pestaña
            return $pdf->stream();
        }
        else if (
            $data['filetype'] === "xlsx" ||
            $data['filetype'] === "csv"
        )
        {

            return $alumnos->download(
                $data['filetype'] === "xlsx" ?
                    $defaultFilename . '.xlsx' :
                    $defaultFilename . '.csv',
            );
        } else {
            // quitar dd
            dd("Ha ocurrido un error");
        }
    }

    public function getDepartamentoByJefeId($jefeId){
        return DB::table('jefes')
                ->join('departamentos', 'jefes.id', '=', 'departamentos.jefe_id')
                ->where('departamentos.jefe_id', '=', $jefeId)
                ->first();
    }

    public function getJefeByUserId($userId){
        return DB::table('users')
            ->join('jefes', 'jefes.user_id', '=', 'users.id')
            ->where('jefes.user_id', '=', $userId)
            ->first();
    }


    /**
     * Permite obtener los campos seleccionados por el
     * usuario en el modal de exportar jefe
     * @param $userData datos de la vista, contiene los campos seleccionados y filtros
     * @return array
     */
    public function getSelectedColumnas($userData){
        $filterColumnas = $this->columnasDefault;

        foreach($userData as $key => $value){
            $keyWithoutDashAndCapitalize = ucwords(str_replace('_', ' ', $key));
            // Verificar si se puede aplicar como columna a partir de las columnas permitidas
            if (in_array($keyWithoutDashAndCapitalize, array_keys($this->columnasPermitidas))){
                // agregar a las columnas seleccionadas por el usuario
                $filterColumnas[$keyWithoutDashAndCapitalize] = $this->columnasPermitidas[$keyWithoutDashAndCapitalize];
            }
        }

        return $filterColumnas;
    }


    public function getSelectedSexos($userData){
        $filterSexos = [];
        $possibleValues = ['H', 'M', 'O'];

        foreach($userData as $key => $value){
            // Verificar si se puede aplicar como columna
            if (in_array($value, $possibleValues)){
                // agregar a las columnas seleccionadas por el usuario
                $filterSexos[] = $value;
            }
        }

        return $filterSexos;
    }

    public function getSelectedDepartamentos($userData){
        $filterDepartamentos = [];
        $possibleValues = ['DSA', 'DID', 'DSC', 'DROS', 'Salas'];

        foreach($userData as $key => $value){
            // Verificar si se puede aplicar como columna
            if (in_array($value, $possibleValues)){
                // agregar a las columnas seleccionadas por el usuario
                $filterDepartamentos[] = $value;
            }
        }

        return $filterDepartamentos;
    }

    /**
     * Obtiene si se selecciono un filtro de procedencia
     * y los compara con los valores que si son posibles
     * @param $userData
     * @return array
     */
    public function getSelectedProcedencias($userData)
    {
        $filterProcedencias = [];
        $possibleValues = ['UNAM', 'EXTERNO', 'FI'];

        foreach ($userData as $key => $value) {
            // Verificar si se puede aplicar como columna
            if (in_array($value, $possibleValues)) {
                // agregar a las columnas seleccionadas por el usuario
                $filterProcedencias[] = $value;
            }
        }

        return $filterProcedencias;
    }

}
