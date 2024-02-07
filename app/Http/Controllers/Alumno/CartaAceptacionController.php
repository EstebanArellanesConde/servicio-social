<?php

namespace App\Http\Controllers\Alumno;

use App\app;
use App\Enums\EstadoAlumno;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Formato;
use App\Models\SolicitudInicio;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PDF;

class CartaAceptacionController extends Controller
{
    public string $saveDirectory;
    public string $paperSize;
    public function __construct()
    {
        $this->saveDirectory = 'formatos/ss01_solicitud_inicio';
        $this->paperSize = 'letter';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }


    // a un número le agregara hasta 2 ceros
    public function fillZero($num, $maxZeros) : string
    {
        return str_pad($num, $maxZeros, "0", STR_PAD_LEFT);
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

    public function getInicales(string $nombreCompleto){
        $nombreSeparado = explode(" ", $nombreCompleto);
        $iniciales = "";

        // se separa y se obtiene la primera letra de cada palabra para despues convertirlo a mayuscula
        foreach ($nombreSeparado as $nombreParte) {
            $iniciales .= strtoupper(mb_substr($nombreParte, 0, 1));
        }

        return $iniciales;
    }

    public function getPdfFromStorage($path){
        // verificar que el reporte este disponible para descargar
        return Storage::download($path, 'carta_aceptacion.pdf');
    }

    public function store(Alumno $alumno)
    {
        if ($alumno->servicio->carta_aceptacion){
            return $this->getPdfFromStorage($alumno->servicio->carta_aceptacion->path);
        }

        $jefeDirecto = $alumno->departamento->jefe;
        $jefeDirectoNombre = $jefeDirecto->user->nombre . $jefeDirecto->user->apellido_paterno . $jefeDirecto->user->apellido_materno;
        $data = $this->getAlumnoData($alumno);


        // agrega 0 a la izquierda
        $numAlumno = $this->fillZero($alumno->servicio->num_servicio, 3);
        $base64FirmaResponsable = base64_encode(Storage::get(app::RESPONSABLE_PROGRAMA['FIRMA_PATH']));
        $base64RubricaJefeDirecto = base64_encode(Storage::get($jefeDirecto->rubrica_url));
        $rubricaIniciales = $this->getInicales(app::RESPONSABLE_PROGRAMA['NOMBRE_COMPLETO']) . '/' .
                            $this->getInicales($jefeDirectoNombre) . '/' .
                            $this->getInicales('Ibeth graciela flores martinez');
        $nombreConTituloResponsable = Helper::capitalize(app::RESPONSABLE_PROGRAMA['TITULO'] . '. ' .
                                      app::RESPONSABLE_PROGRAMA['NOMBRE_COMPLETO']);

        $pdf = PDF::loadView('exports.jefe.pdf.formatos.ss02_carta_aceptacion',
            array_merge($data, [
                'carrera' => $alumno->carrera->carrera,
                'duracionMeses' => $alumno->duracion_servicio,
                'fechaInicio' => $this->formatFecha($alumno->fecha_inicio),
                'fechaFin' => $this->formatFecha($alumno->fecha_fin),
                'horasSemanales' => $alumno->duracion_servicio == 6 ? 20 : 10,
                'horaInicio' => Carbon::create($alumno->hora_inicio)->format('H:i'),
                'horaFin' =>Carbon::create($alumno->hora_fin)->format('H:i'),
                'fechaHoy' => $this->formatFecha(now()),
                'numAlumno' => $numAlumno,
                'base64FirmaResponsable' => $base64FirmaResponsable,
                'currentYear' => Carbon::now()->year,
                'base64RubricaJefeDirecto' => $base64RubricaJefeDirecto,
                'rubricaIniciales' => $rubricaIniciales,
                'nombreConTituloResponsable' => $nombreConTituloResponsable,
            ]))
            ->setPaper($this->paperSize);

        $filename = Str::random(40) . '.pdf';
        $path =  $this->savePdfInStorage($filename, $pdf);

        $alumno->servicio->carta_aceptacion()->create([
            'path' => $path,
        ]);

        $alumno->save();

        return $pdf->stream();
    }
    public function savePdfInStorage(string $filename, $pdf): string
    {
        $path = $this->saveDirectory . '/' . $filename;
        $content = $pdf->download()->getOriginalContent();
        Storage::put($path, $content);

        return $path;
    }

    public function formatFecha($fecha){
        $fechaInicioNoFormat = Carbon::create($fecha);
        return $fechaInicioNoFormat->day . ' de ' .
            $fechaInicioNoFormat->monthName . ' del ' .
            $fechaInicioNoFormat->year;
    }

    /**
     * Display the specified resource.
     */
    public function show(Formato $formato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formato $formato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formato $formato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formato $formato)
    {
        //
    }
}
