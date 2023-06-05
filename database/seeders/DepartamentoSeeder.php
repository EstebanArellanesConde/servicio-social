<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DSA 1
        DB::table('departamentos')->insert([
            'departamento' => 'Departamento de Servicios Académicos',
            'abreviatura_departamento' => 'DSA',
            'jefe_id' => 1,
        ]);

        // DID 2
        DB::table('departamentos')->insert([
            'departamento' => 'Departamento de Investigación y Desarrollo',
            'abreviatura_departamento' => 'DID',
            'jefe_id' => 2,
        ]);

        // DSC 3
        DB::table('departamentos')->insert([
            'departamento' => 'Departamento de Seguridad en Cómputo',
            'abreviatura_departamento' => 'DSC',
            'jefe_id' => 3,
        ]);

        // DROS 4
        DB::table('departamentos')->insert([
            'departamento' => 'Departamento de Redes y Operación de Servidores',
            'abreviatura_departamento' => 'DROS',
            'jefe_id' => 3,
        ]);

        // Salas 5
        DB::table('departamentos')->insert([
            'departamento' => 'Salas',
            'abreviatura_departamento' => 'Salas',
            'jefe_id' => 4,
        ]);
    }
}
