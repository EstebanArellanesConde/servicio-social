<?php

namespace App\Http\Controllers\Jefe;

use App\Enums\EstadoAlumno;
use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Jefe;

class JefeController extends Controller
{
    /**
     * NOTA: laravel v10.0 no se puede acceder a auth() user
     * desde el constructor, es por eso que lo he declarado
     * en cada método
     */

    public function inscritos(){
        $jefe = $this->getJefeByUserId(auth()->user()->id);
        $departamentos = $this->getJefeDepartamentos($jefe);
        $alumnosInscritos = $this->getAlumnos(EstadoAlumno::ACEPTADO, $departamentos);

        return view('jefe.inscritos', ['alumnosInscritos' => $alumnosInscritos]);
    }

    public function rechazados(){
        $jefe = $this->getJefeByUserId(auth()->user()->id);
        $departamentos = $this->getJefeDepartamentos($jefe);
        $alumnosRechazados = $this->getAlumnos(EstadoAlumno::RECHAZADO, $departamentos);

        return view('jefe.rechazados', ['alumnosRechazados' => $alumnosRechazados]);
    }

    public function finalizados(){
        $jefe = $this->getJefeByUserId(auth()->user()->id);
        $departamentos = $this->getJefeDepartamentos($jefe);
        $alumnosFinalizados = $this->getAlumnos(EstadoAlumno::FINALIZADO, $departamentos);

        return view('jefe.finalizados', ['alumnosFinalizados' => $alumnosFinalizados]);
    }


    public function estadisticas(){
        return view('jefe.estadisticas');
    }

    public function configuracion(){
        return view('jefe.configuracion');
    }

    private function getJefeByUserId($userId) {
        return Jefe::where('user_id', '=', $userId)->first();
    }

    private function getJefeDepartamentos($jefe){
        $departamentos = [];
        foreach($jefe->abreviaturaDepartamentos->toArray() as $departamento){
            $departamentos[] = $departamento['abreviatura_departamento'];
        }

        return $departamentos;
    }

    public function getAlumnos($estadoId, $departamentos)
    {
        $alumnos = Alumno::query()
            ->join('estado_alumno', 'estado_alumno.id', 'alumno.estado_id')
            ->join('departamento', 'departamento.id', 'alumno.departamento_id')
            ->where("estado_alumno.id", '=', $estadoId)
            ->where(function ($query) use ($departamentos) {
                // obtiene los alumnos de varios departamentos si es el caso,
                // si al arreglo de $departamentos solo se coloca un departamento
                // solo obtiene de un solo departamento, pero hay casos
                // donde el jefe administra dos departamentos
                foreach ($departamentos as $departamento)
                {
                    $query->orWhere('departamento.abreviatura_departamento', $departamento);
                }
            })
            ->get();
        return $alumnos;
    }
    public function pendiente($id){
        $this->cambiarEstadoAlumno($id, EstadoAlumno::PENDIENTE);
        return redirect()->back();
    }
    public function aceptar($id){
        $this->cambiarEstadoAlumno($id, EstadoAlumno::ACEPTADO);
        return redirect()->back();
    }
    public function rechazar($id){
        $this->cambiarEstadoAlumno($id, EstadoAlumno::RECHAZADO);
        return redirect()->back();
    }

    public function finalizar($id){
        $this->cambiarEstadoAlumno($id, EstadoAlumno::FINALIZADO);
        return redirect()->back();
    }

    public function cambiarEstadoAlumno($idAlumno, $idEstado){
        $alumno = Alumno::where('id', $idAlumno)->first();
        $alumno->estado_id = $idEstado;
        $alumno->save();
    }

}
