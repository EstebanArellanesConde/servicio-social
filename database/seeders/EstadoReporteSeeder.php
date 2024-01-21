<?php

namespace Database\Seeders;

use App\Models\EstadoReporte;
use Illuminate\Database\Seeder;

class EstadoReporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoReporte::create([
            'nombre' => 'ESPERA',
            'descripcion' => 'Puedes generar tu reporte'
        ]);
        EstadoReporte::create([
            'nombre' => 'REVISION',
            'descripcion' => 'El reporte está a la espera de ser revisado por tu jefe'
        ]);
        EstadoReporte::create([
            'nombre' => 'CORRECCION',
            'descripcion' => 'Se solicitó una correción en el reporte'
        ]);
        EstadoReporte::create([
            'nombre' => 'ACEPTADO',
            'descripcion' => 'El reporte ha sido revisado y firmado'
        ]);
    }
}
