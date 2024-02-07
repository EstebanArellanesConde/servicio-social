<?php

namespace App\Http\Livewire\Alumno;

use App\app;
use App\Enums\EstadoReporte;
use App\Enums\ReporteOrden;
use App\Helpers\Helper;
use App\Models\Alumno;
use App\Models\ClaveDGOSE;
use App\Models\Reporte;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;

class ReporteModal extends ModalComponent
{
    public $breve_descripcion;
    public $horas;
    public $resultado_sociedad;
    public $numeroMaximoActividades;
    public $numeroMaximoCaracteresActividad;
    public $numeroMinimoActividades;
    public $numeroMinimoCaracteres;
    public $numeroMaximoCaracteres;
    public $numeroMaximoHoras;
    public $numeroMinimoHoras;
    public $resultado_profesional;
    public array $actividades;

    public int $num_reporte;

    protected $listeners = [
        'agregarActividad' => 'addActividad',
        'eliminarActividad' => 'deleteActividad'
    ];

    public function mount(){
        $this->actividades = [];
        $this->numeroMaximoActividades = 5;
        $this->numeroMinimoActividades = 1;
        $this->numeroMaximoHoras = 480;
        $this->numeroMinimoHoras = 2;
        $this->numeroMaximoCaracteres = 400;
        $this->numeroMinimoCaracteres = 8;
        $this->numeroMaximoCaracteresActividad = 100;
    }

    public function validarActividad(){
        if(count($this->actividades) >= $this->numeroMaximoActividades){
            $this->addError('actividades', 'El número máximo de actividades es ' . $this->numeroMaximoActividades);
            return false;
        }

        if($this->breve_descripcion == "" || $this->horas == ""){
            $this->addError('actividades', 'Debes agregar una descripción y horas a la actividad');
            return false;
        }

        if(strlen($this->breve_descripcion) < $this->numeroMinimoCaracteres){
            $this->addError('actividades', 'Número mínimo de caracteres para una actividad es ' . $this->numeroMinimoCaracteres);
            return false;
        }

        if(strlen($this->breve_descripcion) > $this->numeroMaximoCaracteresActividad){
            $this->addError('actividades', 'Número máximo de caracteres para una actividad es ' . $this->numeroMaximoCaracteresActividad);
            return false;
        }

        if($this->horas < $this->numeroMinimoHoras){
            $this->addError('actividades', 'Una actividad tiene mínimo ' . $this->numeroMinimoHoras . ' horas');
            return false;
        }

        return true;
    }


    public function addActividad(): bool
    {
        if(!$this->validarActividad()){
            return false;
        }

        $this->actividades[] = [
            "breve_descripcion" => $this->breve_descripcion,
            "horas" => intval($this->horas),
        ];
        return true;
    }

    public function deleteActividad($index){
        unset($this->actividades[$index]);
        $this->actividades = array_values($this->actividades);
    }

    protected function rules(){
        return [
            'resultado_sociedad' => ['required', 'min:'.$this->numeroMinimoCaracteres, 'max:'.$this->numeroMaximoCaracteres],
            'resultado_profesional' => ['required', 'min:'.$this->numeroMinimoCaracteres, 'max:'.$this->numeroMaximoCaracteres],
        ];
    }

    public function getHorasBimestre(): int
    {
        $total = 0;
        foreach ($this->actividades as $actividad){
            $total += intval($actividad['horas']);
        }

        return $total;
    }

    public function validar()
    {
        // verificar numero minimo de actividades
        if(count($this->actividades) < $this->numeroMinimoActividades){
            return $this->addError('actividades', 'El número mínimo de actividades es ' . $this->numeroMinimoActividades);
        }
        // verificar numero maximo de actividades
        if(count($this->actividades) > $this->numeroMaximoActividades){
            return $this->addError('actividades', 'El número máximo de actividades es ' . $this->numeroMaximoActividades);
        }

        $horasBimestre = $this->getHorasBimestre();

        // verificar numero máximo de horas
        if ($horasBimestre > $this->numeroMaximoHoras){
            return $this->addError('actividades', 'El número máximo de horas es ' . $this->numeroMaximoHoras);
        }
    }

    public function store(){
        $this->validar();

        $alumno = Alumno::where('user_id', auth()->user()->id)->first();

        $reporte = $alumno->servicio->reportes()
            ->where('num_reporte', $this->num_reporte)
            ->whereIn('estado_id', [EstadoReporte::ESPERA->value, EstadoReporte::CORRECCION->value])
            ->where('fecha_disponible_llenado', '<=', now())
            ->first();

        if(!$reporte){
            abort(403, 'El reporte aún no puede ser llenado');
        }

        $horasBimestre = $this->getHorasBimestre();

        $datosPersonales = $this->validate();
        $paperSize = 'letter';

        $data['nombreCompleto'] = Helper::concatenarNombre($alumno->user->nombre,
            $alumno->user->apellido_paterno, $alumno->user->apellido_materno);

        $jefeInmediatoTemp =  $alumno->departamento->jefe;
        $data['jefeInmediato'] = $jefeInmediatoTemp->getNombreCompletoConTitulo();

        $data['claveDGOSE'] = Helper::getClaveActiva();

        $numeroReporte = App::NUMERO_ORDINAL[strval($this->num_reporte)];
        $horasBimestre = $this->getHorasBimestre();


        $periodoFin = Carbon::create($reporte->fecha_disponible_llenado)
            ->format('d/m/Y')
        ;
        $periodoInicio = Carbon::create($reporte->fecha_disponible_llenado)->subMonths(2)
            ->format('d/m/Y')
        ;

        $totalAcumuladas = $alumno->servicio->reportes()
            ->where('estado_id', EstadoReporte::ACEPTADO)
            ->where('num_reporte', '<', $reporte->num_reporte)
            ->groupBy('alumno_servicio_id')
            ->sum('horas_bimestre_acumuladas')
            + $horasBimestre
        ;

        $pdf = PDF::loadView('exports.jefe.pdf.formatos.ss03_reporte', [
            'nombreCompleto' => $data["nombreCompleto"],
            'jefeInmediato' => $data["jefeInmediato"],
            'alumno' => $alumno,
            'division' =>  $alumno->carrera->division,
            'numeroReporte' => $numeroReporte,
            'claveDGOSE' => $data['claveDGOSE'],
            'fechaInicio' => Carbon::create($alumno->fecha_inicio)->format('d/m/Y'),
            'fechaHoy' => $this->formatFecha(now()),
            'datos' => $datosPersonales,
            'actividades' => $this->actividades,
            'horasBimestre' => $horasBimestre,
            'periodoInicio' => $periodoInicio,
            'periodoFin' => $periodoFin,
            'totalAcumuladas' => $totalAcumuladas,
        ])
            ->setPaper($paperSize)
        ;


        $filename = Str::random(40) . '.pdf';
        $path = 'reportes/' . $filename;

        Storage::put($path, $pdf->download()->getOriginalContent());

        $reporte->update([
            'horas_bimestre_acumuladas' => $horasBimestre,
            'path' => $path,
            'estado_id' => EstadoReporte::REVISION,
        ]);

        return redirect(request()->header('Referer'));

    }


    public function formatFecha($fecha){
        $fechaInicioNoFormat = Carbon::create($fecha);
        return $fechaInicioNoFormat->day . ' de ' .
            $fechaInicioNoFormat->monthName . ' del ' .
            $fechaInicioNoFormat->year;
    }

    public function render()
    {
        return view('livewire.alumno.reporte-modal', [
            'num_reporte' => $this->num_reporte,
            'actividades' => $this->actividades,
        ]);
    }
}
