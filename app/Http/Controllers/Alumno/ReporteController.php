<?php

namespace App\Http\Controllers\Alumno;

use App\Enums\EstadoReporte;
use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumno = Alumno::firstWhere("user_id", auth()->user()->id);
        $reportes = $alumno->reportes->where('fecha_disponible_llenado', '<=', now());

        return view('alumno.reportes', [
            'alumno' => $alumno,
            'reportes' => $reportes,
        ]);
    }

    public function show(Reporte $reporte){
        // verificar que el reporte este disponible para descargar
        if(Auth::user() && Auth::id() === $reporte->alumno->user->id &&
            $reporte->estado_id === EstadoReporte::ACEPTADO->value
        )
        {
            $filename = $reporte->alumno_id . $reporte->num_reporte . '.pdf';
            return Storage::download('reportes/' . $filename, 'reporte_' . $reporte->num_reporte . '.pdf');
        } else {
            return abort(404);
        }

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
     * Show the form for editing the specified resource.
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reporte $reporte)
    {
        //
    }
}
