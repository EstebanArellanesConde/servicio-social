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
        $clave = ClaveDGOSE::create([
            'anio' => 2023,
            'clave' => '2023-12/81-9',
        ]);

        $clave->periodos()->create([
            'periodo' => '2023-2',
            'fecha_inicio' => '2023-01-01',
            'fecha_fin' => '2023-06-30',
        ]);

        $clave->periodos()->create([
            'periodo' => '2024-1',
            'fecha_inicio' => '2024-07-01',
            'fecha_fin' => '2024-12-31',
        ]);

        for($i = 2024; $i < 2050; $i++){
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
