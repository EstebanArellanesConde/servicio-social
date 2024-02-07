<?php

namespace App\Http\Controllers\Alumno;

use App\Enums\EstadoReporte;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\ClaveDGOSE;
use App\Models\Domicilio;
use App\Models\Formato;
use App\Models\SolicitudInicio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SolicitudInicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public string $saveDirectory;
    public string $paperSize;
    public function __construct()
    {
        $this->saveDirectory = 'formatos/ss01_solicitud_inicio';
        $this->paperSize = 'letter';
    }

    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function getAlumnoData(Alumno $alumno): array
    {
        $data = [];

        $data['nombreCompleto'] = Helper::concatenarNombre($alumno->user->nombre,
            $alumno->user->apellido_paterno, $alumno->user->apellido_materno);

        $jefeInmediatoTemp =  $alumno->departamento->jefe;

        $data['jefeInmediato'] = $jefeInmediatoTemp->getNombreCompletoConTitulo();

        $data['numeroCuenta'] = $alumno->numero_cuenta;

        $data['claveDGOSE'] = $alumno->servicio->clave_dgose->clave;

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Alumno $alumno)
    {
        if ($alumno->servicio->solicitud_inicio){
            return $this->getPdfFromStorage($alumno->servicio->solicitud_inicio->path);
        }

        $data = $this->getAlumnoData($alumno);
        $pdf = PDF::loadView('exports.jefe.pdf.formatos.ss01_solicitud_inicio',
            array_merge($data, [
                'alumno' => $alumno,
                'fechaInicio' =>  $this->formatFecha($alumno->fecha_inicio),
                'fechaFin' => $this->formatFecha($alumno->fecha_fin),
                'horasSemanales' => $alumno->duracion_servicio == 6 ? 20 : 10,
                'horaInicio' => Carbon::create($alumno->hora_inicio)->format('H:i'),
                'horaFin' => Carbon::create($alumno->hora_fin)->format('H:i'),
                'jefe' => $alumno->departamento->jefe,
                'fechaHoy' => $this->formatFecha(now()),
                'direccion' => $this->formatDomicilio($alumno->domicilio),
                'domicilio' => $alumno->domicilio,
                'fechaNacimiento' => $this->formatFechaNacimiento($alumno->fecha_nacimiento),
                'division' =>  $alumno->carrera->division,
            ]))
            ->setPaper($this->paperSize);

        $filename = Str::random(40) . '.pdf';
        $path =  $this->savePdfInStorage($filename, $pdf);

        $alumno->servicio->solicitud_inicio()->create([
            'path' => $path,
        ]);

        $alumno->save();

        return $pdf->stream();
    }

    public function getPdfFromStorage($path){
        // verificar que el reporte este disponible para descargar
        return Storage::download($path, 'solicitud_inicio.pdf');
    }

    public function savePdfInStorage(string $filename, $pdf): string
    {
        $path = $this->saveDirectory . '/' . $filename;
        $content = $pdf->download()->getOriginalContent();
        Storage::put($path, $content);

        return $path;
    }

    public function formatDomicilio(Domicilio $domicilio){
        return $domicilio->calle . ', ' .
            $domicilio->numero_externo . ' Col ' .
            $domicilio->colonia->colonia . ', ' .
            $domicilio->colonia->codigo_postal;
    }

    public function formatFechaNacimiento(string $fecha_nacimiento){
        $fechaNacimientoObject = Carbon::create($fecha_nacimiento);
        return $fechaNacimientoObject->format('d') . '-' .
            $fechaNacimientoObject->monthName . '-' .
            $fechaNacimientoObject->format('Y');
    }

    public function formatFecha($fecha){
        $fechaInicioNoFormat = Carbon::create($fecha);
        return $fechaInicioNoFormat->day . ' de ' .
            $fechaInicioNoFormat->monthName . ' del ' .
            $fechaInicioNoFormat->year;
    }

    public function savePDF(string $dir, $pdf, $id){
    }

    /**
     * Display the specified resource.
     */
    public function show(SolicitudInicio $solicitudInicio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SolicitudInicio $solicitudInicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SolicitudInicio $solicitudInicio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SolicitudInicio $solicitudInicio)
    {
        //
    }
}
