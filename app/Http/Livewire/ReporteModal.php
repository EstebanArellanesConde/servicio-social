<?php

namespace App\Http\Livewire;

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
use LivewireUI\Modal\ModalComponent;

class ReporteModal extends ModalComponent
{
    public $periodo_inicio;
    public $periodo_fin;
    public $breve_descripcion;
    public $horas;
    public $resultado_sociedad;
    public $numeroMaximoActividades;
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
    }

    public function addActividad(): bool
    {
        if(count($this->actividades) >= $this->numeroMaximoActividades ||
            $this->breve_descripcion == "" | $this->horas == ""
        ){
            return false;
        }

        $this->actividades[] = [
            "breve_descripcion" => $this->breve_descripcion,
            "horas" => $this->horas
        ];
        return true;
    }

    public function deleteActividad($index){
        unset($this->actividades[$index]);
        $this->actividades = array_values($this->actividades);
    }

    protected function rules(){
        return [
            'periodo_inicio' => ['required'],
            'periodo_fin' => ['required'],
            'resultado_sociedad' => ['required'],
            'resultado_profesional' => ['required'],
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

    public function store(){
        $datosPersonales = $this->validate();
        $paperSize = 'letter';

        $alumno = Alumno::where('user_id', auth()->user()->id)->first();
        $data['nombreCompleto'] = Helper::concatenarNombre($alumno->user->nombre,
            $alumno->user->apellido_paterno, $alumno->user->apellido_materno);

        $jefeInmediatoTemp =  $alumno->departamento->jefe;
        $data['jefeInmediato'] = $jefeInmediatoTemp->getNombreCompletoConTitulo();

        $data['claveDGOSE'] = ClaveDGOSE::getClaveActiva();

        $numeroReporte = App::NUMERO_ORDINAL[strval($this->num_reporte)];

        $horasBimestre = $this->getHorasBimestre();

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
        ])
            ->setPaper($paperSize)
        ;


        $filename = $alumno->id . $this->num_reporte . '.pdf';
        $path = 'reportes/' . $filename;

        Storage::put($path, $pdf->download()->getOriginalContent());

        $reporte = Reporte::where('alumno_id', $alumno->id)
            ->where('num_reporte', $this->num_reporte)
            ->first();

        $reporte->update([
            'horas_bimestre_acumuladas' => $horasBimestre,
            'path' => 'app/' . $path,
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
        return view('livewire.reporte-modal', [
            'num_reporte' => $this->num_reporte,
            'actividades' => $this->actividades,
        ]);
    }
}
