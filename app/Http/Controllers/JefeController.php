<?php

namespace App\Http\Controllers;

use App\Models\Jefe;
use Illuminate\Http\Request;

class JefeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnosPendientes = $this->alumnosPendientes();
        return view('jefe.index', ['alumnosPendientes' => $alumnosPendientes]);
    }


    public function inscritos(){
        $alumnosInscritos = $this->alumnosInscritos();
        return view('jefe.inscritos', ['alumnosInscritos' => $alumnosInscritos]);
    }


    public function rechazados(){
        $alumnosRechazados = $this->alumnosRechazados();
        return view('jefe.rechazados', ['alumnosRechazados' => $alumnosRechazados]);
    }


    public function estadisticas(){
        return view('jefe.estadisticas');
    }


    /**
     * Functions to obtain alumnos
     */
    
    public function alumnosInscritos()
    {
        $alumnosInscritos = \DB::table('alumnos')
                    ->select('alumnos.numero_cuenta', 'users.name', 'users.apellido_paterno', 'users.apellido_materno', 'alumnos.fecha_inicio', 'alumnos.fecha_fin', 'carreras.carrera')
                    ->join('users', 'alumnos.user_id', '=', 'users.id')
                    ->join('carreras', 'alumnos.carrera_id', '=', 'carreras.id')
                    ->where('alumnos.estado_id', '=', 1)
                    ->orderBy('alumnos.id', 'ASC')
                    ->get();
 
        return $alumnosInscritos;
    }


    public function alumnosRechazados()
    {
        $alumnosRechazados = \DB::table('alumnos')
                    ->select('alumnos.numero_cuenta', 'users.name', 'users.apellido_paterno', 'users.apellido_materno', 'alumnos.fecha_inicio', 'alumnos.fecha_fin', 'carreras.carrera')
                    ->join('users', 'alumnos.user_id', '=', 'users.id')
                    ->join('carreras', 'alumnos.carrera_id', '=', 'carreras.id')
                    ->where('alumnos.estado_id', '=', 2)
                    ->orderBy('alumnos.id', 'ASC')
                    ->get();

        return $alumnosRechazados;
    }


    public function alumnosPendientes()
    {
        $alumnosPendientes = \DB::table('alumnos')
                    ->select('alumnos.id','alumnos.curp','alumnos.sexo','alumnos.numero_cuenta','users.email','alumnos.telefono_celular','alumnos.telefono_alternativo','alumnos.promedio','alumnos.duracion_servicio','alumnos.hora_inicio','alumnos.hora_fin','alumnos.pertenencia_unica','users.name', 'users.apellido_paterno', 'users.apellido_materno', 'alumnos.fecha_inicio', 'alumnos.fecha_fin', 'carreras.carrera')
                    ->join('users', 'alumnos.user_id', '=', 'users.id')
                    ->join('carreras', 'alumnos.carrera_id', '=', 'carreras.id')
                    ->where('alumnos.estado_id', '=', 3)
                    ->orderBy('alumnos.id', 'ASC')
                    ->get();

        return $alumnosPendientes;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Jefe $jefe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jefe $jefe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jefe $jefe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jefe $jefe)
    {
        //
    }
}
