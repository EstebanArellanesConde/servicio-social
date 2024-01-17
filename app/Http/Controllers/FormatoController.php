<?php

namespace App\Http\Controllers;

use App\app;
use App\Enums\ReporteOrden;
use App\Helpers\Helper;
use App\Models\Alumno;
use App\Models\ClaveDGOSE;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
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
        $this->id = Route::current()->parameter('id');
        $this->alumno = Alumno::find($this->id);

        $this->saveDirectory = 'formatos/';
        $this->paperSize = 'letter';

        $this->data = [];

        $this->data['nombreCompleto'] = Helper::concatenarNombre($this->alumno->user->nombre,
            $this->alumno->user->apellido_paterno, $this->alumno->user->apellido_materno);

        $jefeInmediatoTemp =  $this->alumno->departamento->jefe;
        $this->data['jefeInmediato'] = $jefeInmediatoTemp->getNombreCompletoConTitulo();

        $this->data['numeroCuenta'] = $this->alumno->numero_cuenta;

        $this->data['claveDGOSE'] = ClaveDGOSE::getClaveActiva();
    }

    public function solicitudInicio($id){
        $jefe = $this->alumno->departamento->jefe;

        $domicilio = $this->alumno->domicilio;
        $direccion =  $domicilio->calle . ', ' .
            $domicilio->numero_externo . ' Col ' .
            $domicilio->colonia->nombre . ', ' .
            $domicilio->colonia->codigo_postal;

        $fechaNacimientoObject = Carbon::create($this->alumno->fecha_nacimiento);
        $fechaNacimiento = $fechaNacimientoObject->format('d') . '-' .
            $fechaNacimientoObject->monthName . '-' .
            $fechaNacimientoObject->format('Y');

        $pdf = PDF::loadView('exports.jefe.pdf.formatos.ss01_solicitud_inicio',
            array_merge($this->data, [
                'alumno' => $this->alumno,
                'fechaInicio' =>  $this->formatFecha($this->alumno->fecha_inicio),
                'fechaFin' => $this->formatFecha($this->alumno->fecha_fin),
                'horasSemanales' => $this->alumno->duracion_servicio == 6 ? 20 : 10,
                'horaInicio' => Carbon::create($this->alumno->hora_inicio)->format('H:i'),
                'horaFin' => Carbon::create($this->alumno->hora_fin)->format('H:i'),
                'jefe' => $jefe,
                'fechaHoy' => $this->formatFecha(now()),
                'domicilio' => $domicilio,
                'direccion' => $direccion,
                'fechaNacimiento' => $fechaNacimiento,
                'division' =>  $this->alumno->carrera->division,
            ]))
            ->setPaper($this->paperSize);

        $this->savePDF('ss02_carta_aceptacion', $pdf);
        return $pdf->stream();
    }

    // a un número le agregara hasta 2 ceros
    public function fillZero($num, $maxZeros) : string
    {
        return str_pad($num, $maxZeros, "0", STR_PAD_LEFT);
    }

    public function cartaAceptacion($id){

        // agrega 0 a la izquierda
        $numAlumno = $this->fillZero($this->alumno->num_alumno, 3);

        $pdf = PDF::loadView('exports.jefe.pdf.formatos.ss02_carta_aceptacion',
        array_merge($this->data, [
            'carrera' => $this->alumno->carrera->carrera,
            'duracionMeses' => $this->alumno->duracion_servicio,
            'fechaInicio' => $this->formatFecha($this->alumno->fecha_inicio),
            'fechaFin' => $this->formatFecha($this->alumno->fecha_fin),
            'horasSemanales' => $this->alumno->duracion_servicio == 6 ? 20 : 10,
            'horaInicio' => Carbon::create($this->alumno->hora_inicio)->format('H:i'),
            'horaFin' =>Carbon::create($this->alumno->hora_fin)->format('H:i'),
            'fechaHoy' => $this->formatFecha(now()),
            'numAlumno' => $numAlumno,
            'jefeUNICAFirmaPath' => app::RESPONSABLE_PROGRAMA['FIRMA_PATH'],
            'currentYear' => Carbon::now()->year,
        ]))
            ->setPaper($this->paperSize);

        $this->savePDF('ss02_carta_aceptacion', $pdf);
        return $pdf->stream();
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

    public function formatFecha($fecha){
        $fechaInicioNoFormat = Carbon::create($fecha);
        return $fechaInicioNoFormat->day . ' de ' .
            $fechaInicioNoFormat->monthName . ' del ' .
            $fechaInicioNoFormat->year;
    }

    public function savePDF(string $dir, $pdf){
        $filename = $this->id . '.pdf';
        Storage::directoryExists($this->saveDirectory . $dir);
        $fullPath = $this->saveDirectory . $dir . '/' . $filename;
        $content = $pdf->download()->getOriginalContent();
        Storage::put($fullPath, $content);
    }
}
