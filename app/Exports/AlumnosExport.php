<?php

namespace App\Exports;

use App\Models\Alumno;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlumnosExport implements FromQuery, Responsable, WithHeadings
{
    use Exportable;

    private $sexo;
    private $departamento;
    private $escuela;
    private $procedencia;
    private $isUnam;
    public $heading;
    private $queryColumns;

    public function __construct($heading = [])
    {
        $this->sexo = [];
        $this->departamento = [];
        $this->escuela = [];
        $this->procedencia = [];
        $this->isUnam = [];
        $this->setHeading($heading);
        $this->setQueryColumns($heading);
    }

    public function forSexo($sexo)
    {
        $this->sexo = $sexo;
        return $this;
    }

    public function forDepartamento($departamento)
    {
        $this->departamento = $departamento;
        return $this;
    }

    public function forEscuela($escuela)
    {
        $this->escuela = $escuela;
        return $this;
    }

    public function forProcedencia($procedencia)
    {
        /*
         * FI
         * UNAM
         * EXTERNO
         */
        $this->procedencia = $procedencia;
        return $this;
    }


    public function query(){
        $alumnos = Alumno::query()
            ->join('users', 'users.id', '=', 'alumno.user_id')
            ->join('escuela', 'escuela.id', '=', 'alumno.escuela_id')
            ->join('departamento', 'departamento.id', '=', 'alumno.departamento_id')
            ->leftJoin('carrera', 'carrera.id', '=', 'alumno.carrera_id')
            ->when(!$this->containsOnlyNull($this->sexo) ,function ($q){
                return $q->whereIn('sexo', $this->sexo);
            })
            ->when(!$this->containsOnlyNull($this->departamento) , function ($q){
                return $q->whereIn('abreviatura_departamento', $this->departamento);
            })
            ->when(!$this->containsOnlyNull($this->escuela), function ($q){
                return $q->whereIn('escuela', $this->escuela);
            })
            ->when(!$this->containsOnlyNull($this->procedencia), function ($q){
                $query = $q;
                $unam = in_array('UNAM', $this->procedencia);
                $externo = in_array('EXTERNO', $this->procedencia);
                $fi = in_array('FI', $this->procedencia);

                if($unam && $externo){
                    $query->whereIn('is_unam', [0, 1]);
                }
                else if($fi && $externo){
                    $query->where('is_unam', '=', 0)
                          ->orWhere('escuelas.id', '=', 1)
                    ;
                }
                else
                {
                    if($unam){
                        $query->where('is_unam', '=', 1);
                    }

                    else if($fi){
                        $query->where('escuela_id', '=', 1);
                    }

                    else if($externo){
                        $query->where('is_unam', '=', 0);
                    }
                }

                return $query;
            })
            ->selectRaw(
                 implode(", ", array_values($this->queryColumns)))
            ->orderBy('users.apellido_paterno', 'asc')
        ;


        return $alumnos;
    }

   public function setQueryColumns($heading){
       // si solo hay un campo y ese campo es el ID mostrar todos los campos
       if (count($heading) <= 1 && array_key_exists('ID', $heading)){
           $this->queryColumns = ['*'];
       } else {
           // en caso de que no este vacia colocar las columnas seleccionadas
           $this->queryColumns = array_values($heading);
       }
    }

    public function setHeading($heading){
        // si solo hay un campo y ese campo es el ID mostrar todos los campos
        if (count($heading) <= 1 && array_key_exists('ID', $heading)){
            $this->heading = ['All'];
        } else {
            // en caso de que no este vacia colocar las columnas seleccionadas
            $this->heading = array_keys($heading);
        }
    }
    public function headings(): array
    {
        return $this->heading;
    }

    function containsOnlyNull($input)
    {
        return empty(array_filter($input, function ($a) { return $a !== null;}));
    }

}
