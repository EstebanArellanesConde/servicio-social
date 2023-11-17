<?php

namespace Database\Seeders;

use App\Models\Periodo;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periodosDefault = [
            '2010-1' => [
                'fecha_inicio' => '2010-01-01',
                'fecha_fin' => '2010-06-30',
            ],
            '2010-2' => [
                'fecha_inicio' => '2010-07-01',
                'fecha_fin' => '2010-12-31',
            ],
        ];

        // iniciara en 2010
        $twoDigitsYearInit = intval(Carbon::create('2010')->format('y'));
        // terminara 3 años adelante de la fecha actual
        $twoDigitsYearFinish = intval(Carbon::now()->addYear(3)->format('y'));

        for ($i = $twoDigitsYearInit ; $i <= $twoDigitsYearFinish; $i++){
            $currentIterYear = '20' . strval($i);
            $nextIterYear = '20' . strval($i + 1);
            // primer periodo del año (empieza con 2 en el nombre)
            Periodo::create([
                'periodo' => $currentIterYear . '-2',
                'fecha_inicio' => $currentIterYear . '-01-01',
                'fecha_fin' => $currentIterYear . '-06-30',
            ]);

            // segundo periodo que inicia con 1 del siguiente anio
            Periodo::create([
                'periodo' => $nextIterYear . '-1',
                'fecha_inicio' => $currentIterYear . '-07-01',
                'fecha_fin' => $currentIterYear . '-12-31',
            ]);
        }
    }
}
