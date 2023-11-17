<?php

namespace App\Http\Livewire\Jefe;

use App\Enums\AlumnoEstado;
use App\Models\Alumno;
use App\Models\Departamento;
use Livewire\Component;

class Estadisticas extends Component
{
    public $departamentos;
    public $pendientes;
    public $incritos;
    public $rechazados;
    public $finalizados;
    public $departamento_abreviatura;

    public function getNumeroDeAlumnosByEstadoId($estadoAlumnoId){
        // inicialziar el arreglo con 0 para el contador de todos
        $alumnos = [
            'all' => 0,
        ];

        // obtener departamento por departamento y filtrar a partir del estado dado
        foreach ($this->departamentos as $departamento){
            $alumnos[$departamento->abreviatura_departamento] = Alumno::query()
                ->join('departamento', 'alumno.departamento_id', '=', 'departamento.id')
                ->join('estado_alumno', 'alumno.estado_id', '=', 'estado_alumno.id')
                ->where('departamento.abreviatura_departamento', '=', $departamento->abreviatura_departamento)
                ->where('estado_alumno.id', '=', $estadoAlumnoId)
                ->count()
            ;
            // obtener total de todos los estados para cada departamento
            $alumnos['all'] += $alumnos[$departamento->abreviatura_departamento];
        }

        return $alumnos;
    }

    public function mount(){
        $this->departamento_abreviatura = 'all';
        $this->departamentos = Departamento::all('departamento', 'abreviatura_departamento');
        $this->pendientes = $this->getNumeroDeAlumnosByEstadoId(AlumnoEstado::PENDIENTE);
        $this->incritos = $this->getNumeroDeAlumnosByEstadoId(AlumnoEstado::ACEPTADO);
        $this->rechazados = $this->getNumeroDeAlumnosByEstadoId(AlumnoEstado::RECHAZADO);
        $this->finalizados = $this->getNumeroDeAlumnosByEstadoId(AlumnoEstado::FINALIZADO);
    }

    public function show(){
    }

    public function render()
    {
        $this->departamentos = Departamento::all('departamento', 'abreviatura_departamento');
        return view('livewire.jefe.estadisticas',[
            'departamentos' => $this->departamentos,
            'pendientes' => $this->pendientes,
            'incritos' => $this->incritos,
            'rechazados' => $this->rechazados,
            'finalizados' => $this->finalizados,
        ]);
    }
}
