<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HistoricoEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('historico_estado_alumno')->insert([
            'fecha_estado' => now(),
            'estado_id' => 1,
            'alumno_id' => 1
        ]);

    }
}
