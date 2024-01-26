<?php

namespace App\Http\Controllers\Jefe;


use App\Exports\AlumnosExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\datos;
use App\Models\Departamento;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller{

    public $columnasPermitidas;
    public $filtrosPermitidos;
    public $nombreResponsable;
    public $abreviaturaDepartamento;
    public $columnasDefault;

    public function __construct()
    {
        $this->columnasPermitidas = [
            'ID' => 'alumno.id',
            'Nombre' => "CONCAT(users.apellido_paterno, ' ', users.apellido_materno, ' ', users.nombre) as nombre",
            'Departamento' => 'departamento.abreviatura_departamento',
            'Procedencia' => "(CASE WHEN escuela.is_unam = true THEN 'UNAM' ELSE 'EXTERNO' END) as procedencia",
            'Curp' => 'alumno.curp',
            'Correo Electrónico' => 'users.email',
            'Fecha Nacimiento' => 'alumno.fecha_nacimiento',
            'Sexo' => 'sexo',
            'Teléfono Celular' => 'alumno.telefono_celular',
            'Teléfono Alternativo' => 'alumno.telefono_alternativo',
            'Número Cuenta' => 'alumno.numero_cuenta',
            'Créditos' => 'alumno.creditos_pagados',
            'Avance' => 'alumno.avance_porcentaje',
            'Promedio' => 'alumno.promedio',
            'Escuela' => 'escuela.escuela',
            'Fecha Inicio' => 'alumno.fecha_inicio',
            'Fecha Fin' => 'alumno.fecha_fin',
            'Carrera' => 'carrera.carrera',
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
            'Nombre' => $this->columnasPermitidas['Nombre'],
            'Procedencia' => $this->columnasPermitidas['Procedencia'],
            'Departamento' => $this->columnasPermitidas['Departamento'],
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
        $this->nombreResponsable = auth()->user()->nombre . ' ' .
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
        return DB::table('jefe')
                ->join('departamento', 'jefe.id', '=', 'departamento.jefe_id')
                ->where('departamento.jefe_id', '=', $jefeId)
                ->first();
    }

    public function getJefeByUserId($userId){
        return DB::table('users')
            ->join('jefe', 'jefe.user_id', '=', 'users.id')
            ->where('jefe.user_id', '=', $userId)
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
        $possibleValues = $this->getDepartamentosArray();

        foreach($userData as $key => $value){
            // Verificar si se puede aplicar como columna
            if (in_array($value, $possibleValues)){
                // agregar a las columnas seleccionadas por el usuario
                $filterDepartamentos[] = $value;
            }
        }

        return $filterDepartamentos;
    }

    public function getDepartamentosArray(){
        $departamentosArray = [];
        $departamentos = Departamento::query()
            ->select('departamento.abreviatura_departamento')
            ->get()
        ;

        foreach($departamentos->toArray() as $departamento){
            $departamentosArray[] = $departamento['abreviatura_departamento'];
        }

        return $departamentosArray;
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
