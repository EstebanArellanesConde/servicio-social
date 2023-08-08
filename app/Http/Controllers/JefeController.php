<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Jefe;
use App\Models\Alumno;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function finalizados(){
        $alumnosFinalizados = $this->getAlumnos(4);
        return view('jefe.finalizados', ['alumnosFinalizados' => $alumnosFinalizados]);
    }

    public function estadisticas(){
        return view('jefe.estadisticas');
    }

    public function getAlumnos($idEstado)
    {
        return Alumno::all()
            ->where("estado_id", $idEstado);
    }
    public function pendiente($id){
        $this->cambiarEstadoAlumno($id, 3);
        return redirect()->back();
    }
    public function aceptar($id){
        $this->cambiarEstadoAlumno($id, 1);
        return redirect()->back();
    }
    public function rechazar($id){
        $this->cambiarEstadoAlumno($id, 2);
        return redirect()->back();
    }

    public function finalizar($id){
        $this->cambiarEstadoAlumno($id, 4);
        return redirect()->back();
    }

    public function cambiarEstadoAlumno($idAlumno, $idEstado){
        $alumno = Alumno::where('id', $idAlumno)->first();
        $alumno->estado_id = $idEstado;
        $alumno->save();
    }

    public function download($filetype){
        $alumno = Alumno::with([
            'user',
            'escuela',

        ])->first();
        if ($filetype === "pdf"){
            $pdf = Pdf::loadView('pdf.tabla_alumnos', ['alumnos' => $alumnos]);
            return $pdf->download("document.pdf");
        } else{
            dd("No pdf");
        }
    }

}
