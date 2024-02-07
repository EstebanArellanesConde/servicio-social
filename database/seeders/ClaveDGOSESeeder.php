<?php

namespace Database\Seeders;

use App\Models\ClaveDGOSE;
use App\Models\Periodo;
use Illuminate\Database\Seeder;

class ClaveDGOSESeeder extends Seeder
{

    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $primerAnio = 2023;

        $clave = ClaveDGOSE::create([
            'anio' => $primerAnio,
            'clave' => $primerAnio . '-12/81-9',
        ]);

        $clave->periodos()->create([
            'periodo' => $primerAnio . '-2',
            'fecha_inicio' => $primerAnio . '-01-01',
            'fecha_fin' => $primerAnio . '-06-30',
        ]);

        $clave->periodos()->create([
            'periodo' => $primerAnio + 1 . '-1',
            'fecha_inicio' => $primerAnio . '-07-01',
            'fecha_fin' => $primerAnio . '-12-31',
        ]);

        for($i = $primerAnio + 1; $i < 2050; $i++){
            $clave = ClaveDGOSE::create([
                'anio' => $i,
            ]);

            $clave->periodos()->create([
                'periodo' => $i . '-2',
                'fecha_inicio' => $i . '-01-01',
                'fecha_fin' => $i . '-06-30',
            ]);

            $clave->periodos()->create([
                'periodo' => $i + 1 . '-1',
                'fecha_inicio' => $i . '-07-01',
                'fecha_fin' => $i . '-12-31',
            ]);
        }
    }
}
