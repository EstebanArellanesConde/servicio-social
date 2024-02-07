<?php

namespace App\Http\Controllers\Jefe;

use App\app;
use App\Enums\ReporteOrden;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\ClaveDGOSE;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class FormatoController extends Controller
{

    private $id;
    private $data;
    private $alumno;
    private $saveDirectory;
    private $paperSize;
    public function __construct()
    {
    }

    public function reporte($id){
        $numeroReporte = ReporteOrden::PRIMER;
        $pdf = PDF::loadView('exports.jefe.pdf.formatos.ss03_reporte', [
            'nombreCompleto' => $this->data["nombreCompleto"],
            'jefeInmediato' => $this->data["jefeInmediato"],
            'alumno' => $this->alumno,
            'division' =>  $this->alumno->carrera->division,
            'numeroReporte' => $numeroReporte,
            'claveDGOSE' => $this->data['claveDGOSE'],
            'fechaInicio' => Carbon::create($this->alumno->fecha_inicio)->format('d/m/yy'),
            'fechaHoy' => $this->formatFecha(now()),
        ])
            ->setPaper($this->paperSize);
        $this->savePDF('ss03_reporte', $pdf);
        return $pdf->stream();
    }
}
