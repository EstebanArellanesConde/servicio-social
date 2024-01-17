<?php

namespace Database\Seeders;

use App\Models\Departamento;
use App\Models\Jefe;
use App\Models\User;
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
        // obtener jefes
        $userDSAId = User::where('email', '=', 'admin@admin.com')->first()->id;
        $jefeDSA = Jefe::where('user_id', '=', $userDSAId)->first();

        $userDIDId = User::where('email', '=', 'jefe@jefe.com')->first()->id;
        $jefeDID = Jefe::where('user_id', '=', $userDIDId)->first();

        $userDSCId = User::where('email', '=', 'rafael@ingenieria.unam.edu')->first()->id;
        $jefeDSC = Jefe::where('user_id', '=', $userDSCId)->first();

        $userSalasId = User::where('email', '=', 'cruz.aguilar@ingenieria.unam.edu')->first()->id;
        $jefeSalas = Jefe::where('user_id', '=', $userSalasId)->first();


        // DSA 1
        Departamento::create([
            'departamento' => 'Departamento de Servicios Académicos',
            'abreviatura_departamento' => 'DSA',
            'jefe_id' => $jefeDSA->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // DID 2
        Departamento::create([
            'departamento' => 'Departamento de Investigación y Desarrollo',
            'abreviatura_departamento' => 'DID',
            'jefe_id' => $jefeDID->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // DSC 3
        Departamento::create([
            'departamento' => 'Departamento de Seguridad en Cómputo',
            'abreviatura_departamento' => 'DSC',
            'jefe_id' => $jefeDSC->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // DROS 4
        Departamento::create([
            'departamento' => 'Departamento de Redes y Operación de Servidores',
            'abreviatura_departamento' => 'DROS',
            'jefe_id' => $jefeDSC->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Salas 5
        Departamento::create([
            'departamento' => 'Salas',
            'abreviatura_departamento' => 'Salas',
            'jefe_id' => $jefeSalas->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // PC Puma
        Departamento::create([
            'departamento' => 'PC PUMA',
            'abreviatura_departamento' => 'PCPUMA',
            'jefe_id' => $jefeDSA->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
