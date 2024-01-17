<?php

namespace App\Observers;

use App\Enums\Departamento;
use App\Enums\EstadoReporte;
use App\Models\Alumno;
use App\Models\Reporte;

class AlumnoObserver
{
    /**
     * Handle the Alumno "created" event.
     */
    public function created(Alumno $alumno): void
    {
        $numReportesBimestrales = $alumno->duracion_servicio / 2;

        // Cuando el reporte cambie de estado a REVISION se asignará
        // valor a horas acumuladas y a path

        for($i = 0; $i < $numReportesBimestrales; $i++){
            Reporte::create([
                'alumno_id' => $alumno->id,
                'horas_bimestre_acumuladas' => 0,
                'path' => null,
                'estado_id' => EstadoReporte::INICIAL
            ]);
        }

        // cuando el alumno no es de unica se va directo a salas a realizar el servicio
        if (!$this->alumnoEsDeUnica($alumno)){
            $alumno->departamento_id = Departamento::Salas;
        }
    }

    // realiza consulta externa para saber si es becario o no
    public function alumnoEsDeUnica(Alumno $alumno): bool
    {
        if ($alumno->pertenencia_unica){
            return true;
        }

        return false;
    }


    /**
     * Handle the Alumno "updated" event.
     */
    public function updated(Alumno $alumno): void
    {
        //
    }

    /**
     * Handle the Alumno "deleted" event.
     */
    public function deleted(Alumno $alumno): void
    {
        //
    }

    /**
     * Handle the Alumno "restored" event.
     */
    public function restored(Alumno $alumno): void
    {
        //
    }

    /**
     * Handle the Alumno "force deleted" event.
     */
    public function forceDeleted(Alumno $alumno): void
    {
        //
    }
}
