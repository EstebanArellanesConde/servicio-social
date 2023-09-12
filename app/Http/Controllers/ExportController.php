<?php

namespace App\Http\Controllers;


use App\Exports\AlumnosExport;
use App\Models\Alumno;
use App\Models\Departamento;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bootstrap\HandleExceptions;
use Maatwebsite\Excel\Facades\Excel;
use function Pest\Laravel\instance;

class ExportController extends Controller{

    public $campos;
    public $allowHeadings;

    public $filtros;
    public $camposSeleccionados;
    public $filtrosSeleccionados;
    public $alumnosFiltrados;

    public function __construct()
    {
        $this->allowHeadings = [
            'ID' => 'alumnos.id',
            'Curp' => 'curp',
            'Fecha Nacimiento' => 'fecha_nacimiento',
            'Sexo' => 'sexo',
            'Telefono Celular' => 'telefono_celular',
            'Telefono Alternativo' => 'telefono_alternativo',
            'Numero cuenta' => 'numero_cuenta',
            'Creditos' => 'creditos_pagados',
            'Avance' => 'avance_porcentaje',
            'Promedio' => 'promedio',
            'Procedencia' => 'is_unam',
            'Departamento' => 'abreviatura_departamento',
        ];

        $this->campos = [
            'numero_cuenta' => 'numero_cuenta',
            'curp' => 'curp',
            'apellido_paterno' => 'apellido_paterno',
            'correo' => 'email',
            'escuela' => 'escuela',
            'departamento' => 'abreviatura_departamento',
            'sexo' => 'sexo',
            'procedencia' => 'is_unam',
        ];

        $this->filtros = [
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

        $departamentos = Departamento::all()->pluck('abreviatura_departamento')->toArray();

        foreach ($departamentos as $departamento){
            $this->filtros[] = $departamento;
        }

        $this->camposSeleccionados = [
        ];
        $this->filtrosSeleccionados = [
        ];

        $this->alumnosFiltrados = [];
    }

    public function store(Request $request){
        // almacenamos todos los datos
        $data = $request->all();
        $defaultFilename='alumnos';

        $selectedHeadings = $this->getSelectedHeadings($data);
        $selectedSexos = $this->getSelectedSexos($data);
        $selectedDepartamentos = $this->getSelectedDepartamentos($data);
        $selectedProcedencias = $this->getSelectedProcedencias($data);

        $alumnos = new AlumnosExport($selectedHeadings);

        $alumnos
            ->forSexo($selectedSexos)
            ->forDepartamento($selectedDepartamentos)
            ->forProcedencia($selectedProcedencias);


        if($data['filetype'] === "pdf"){
            $pdf = PDF::loadView(
                'exports.jefe.pdf.tabla_alumnos',
                [
                    'columnas' => $alumnos->heading,
                    'alumnos' => $alumnos->query()->get(),
                ],
            );
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

    public function getSelectedHeadings($userData){
        $filterHeadings = [
            // valores por defecto de columnas
            'ID' => $this->allowHeadings['ID'],
        ];

        foreach($userData as $key => $value){
            $keyWithoutDashAndCapitalize = ucwords(str_replace('_', ' ', $key));
            // Verificar si se puede aplicar como columna
            if (in_array($keyWithoutDashAndCapitalize, array_keys($this->allowHeadings))){
                // agregar a las columnas seleccionadas por el usuario
                $filterHeadings[$keyWithoutDashAndCapitalize] = $this->allowHeadings[$keyWithoutDashAndCapitalize];
            }
        }

        return $filterHeadings;
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
