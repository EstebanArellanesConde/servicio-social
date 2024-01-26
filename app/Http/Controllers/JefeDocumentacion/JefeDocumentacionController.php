<?php

namespace App\Http\Controllers\JefeDocumentacion;

use App\Enums\EstadoAlumno;
use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\ClaveDGOSE;
use Illuminate\Http\Request;

class JefeDocumentacionController extends Controller
{
    /**
     * Alumnos que se registraron pero aun no se les asigna una fecha de inicio y
     * una clave dgose asociada
     */
    public function index(){
        $alumnos = Alumno::where('estado_id', '=', EstadoAlumno::REGISTRADO)->get();
        return view('jefe_documentacion.index', [
            'alumnos' => $alumnos,
        ]);
    }

    public function asignarFechas(Request $request){
        $request->validate([
            'fecha_inicio' => ['required'],
            'fecha_fin' => ['required'],
        ]);

        $data = $request->all();

        $alumno = Alumno::find($request->id);

        $alumno->fecha_inicio = $data['fecha_inicio'];
        $alumno->fecha_fin = $data['fecha_fin'];
        $alumno->clave_dgose_id = ClaveDGOSE::getClaveActivaId();
        $alumno->estado_id = EstadoAlumno::PREACEPTADO;

        $alumno->save();

        return redirect()->back();
    }

    public function estadisticas(){
        return view('jefe_documentacion.estadisticas');
    }

}
