<?php

namespace App\Http\Controllers\JefeDocumentacion;

use App\Enums\EstadoAlumno;
use App\Exceptions\NoClaveDGOSEException;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\ClaveDGOSE;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class JefeDocumentacionController extends Controller
{
    /**
     * Alumnos que se registraron pero aun no se les asigna una fecha de inicio y
     * una clave dgose asociada
     */
    public function index(){
        try {
            $alumnos = Alumno::where('estado_id', '=', EstadoAlumno::PREACEPTADO)->get();
            $clave_dgose = Helper::getClaveActiva();

            return view('jefe_documentacion.index', [
                'alumnos' => $alumnos,
                'clave_dgose' => $clave_dgose,
            ]);

        } catch (NoClaveDGOSEException $ex){
            return view('jefe_documentacion.index');
        }
    }

    public function asignarFechas(Request $request){
        $request->validate([
            'fecha_inicio' => ['required', 'before:fecha_fin'],
            'fecha_fin' => ['required', 'after:fecha_inicio'],
        ]);

        $data = $request->all();

        $alumno = Alumno::find($request->id);

        DB::beginTransaction();
        try{
            $alumno->fecha_inicio = $data['fecha_inicio'];
            $alumno->fecha_fin = $data['fecha_fin'];
            $alumno->estado_id = EstadoAlumno::ACEPTADO;
            $claveActivaId = Helper::getClaveActivaId();
            $alumno->servicio()->create([
                'clave_dgose_id' => $claveActivaId,
            ]);
            $alumno->save();
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->back();
    }

    public function estadisticas(){
        return view('jefe_documentacion.estadisticas');
    }

}
