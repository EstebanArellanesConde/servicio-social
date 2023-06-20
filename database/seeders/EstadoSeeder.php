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
        DB::table('estados')->insert([ //1
            'estado' => 'ACEPTADO',
            'fecha_estado' => now(),
        ]);

        DB::table('estados')->insert([ //2
            'estado' => 'RECHAZO',
            'fecha_estado' => now(),
        ]);

        DB::table('estados')->insert([ //3
            'estado' => 'PENDIENTE',
            'fecha_estado' => now(),
        ]);
    }
}
