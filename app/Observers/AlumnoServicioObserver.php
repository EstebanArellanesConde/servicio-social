<?php

namespace App\Observers;

use App\Enums\EstadoReporte;
use App\Models\AlumnoServicio;

class AlumnoServicioObserver
{
    /**
     * Handle the AlumnoServicio "created" event.
     */
    public function created(AlumnoServicio $alumnoServicio): void
    {
        $numReportesBimestrales = $alumnoServicio->alumno->duracion_servicio / 2;

        // Cuando el reporte cambie de estado a REVISION se asignará
        // valor a horas acumuladas y a path

        for($i = 0; $i < $numReportesBimestrales; $i++){
            $alumnoServicio->reportes()->create([
                'horas_bimestre_acumuladas' => 0, 'path' => null, 'estado_id' => EstadoReporte::ESPERA
            ]);
        }
    }

    /**
     * Handle the AlumnoServicio "updated" event.
     */
    public function updated(AlumnoServicio $alumnoServicio): void
    {
        //
    }

    /**
     * Handle the AlumnoServicio "deleted" event.
     */
    public function deleted(AlumnoServicio $alumnoServicio): void
    {
        //
    }

    /**
     * Handle the AlumnoServicio "restored" event.
     */
    public function restored(AlumnoServicio $alumnoServicio): void
    {
        //
    }

    /**
     * Handle the AlumnoServicio "force deleted" event.
     */
    public function forceDeleted(AlumnoServicio $alumnoServicio): void
    {
        //
    }
}
