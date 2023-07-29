<?php

namespace App\Http\Controllers;

use App\Models\Jefe;
use App\Models\Alumno;
use Illuminate\Http\Request;

class JefeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnosPendientes = $this->getAlumnos(3);
        return view('jefe.index', ['alumnosPendientes' => $alumnosPendientes]);
    }

    public function inscritos(){
        $alumnosInscritos = $this->getAlumnos(1);
        return view('jefe.inscritos', ['alumnosInscritos' => $alumnosInscritos]);
    }

    public function rechazados(){
        $alumnosRechazados = $this->getAlumnos(2);
        return view('jefe.rechazados', ['alumnosRechazados' => $alumnosRechazados]);
    }

    public function estadisticas(){
        return view('jefe.estadisticas');
    }

    public function getAlumnos($idEstado)
    {
        return Alumno::all()
            ->where("estado_id", $idEstado);

    }
}
