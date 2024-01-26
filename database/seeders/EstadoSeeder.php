<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_alumno')->insert([ //1
            'nombre' => 'REGISTRADO',
            'activo' => true,
        ]);

        DB::table('estado_alumno')->insert([ //2
            'nombre' => 'PREACEPTADO',
            'activo' => true,
        ]);

        DB::table('estado_alumno')->insert([ //3
            'nombre' => 'ACEPTADO',
            'activo' => true,
        ]);

        DB::table('estado_alumno')->insert([ //4
            'nombre' => 'FINALIZADO',
            'activo' => true,
        ]);

        DB::table('estado_alumno')->insert([ //4
            'nombre' => 'RECHAZADO',
            'activo' => true,
        ]);
    }
}
