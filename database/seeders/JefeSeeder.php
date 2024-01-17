<?php

namespace Database\Seeders;

use App\Models\Jefe;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class JefeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DSA
        $jefeDSA = User::create([
            'nombre' => 'Beatriz',
            'apellido_paterno' => 'Barrera',
            'apellido_materno' => 'Hernández',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make('password')
        ]);

        Jefe::create([
            'user_id' => $jefeDSA->id,
            'titulo' => 'Ing',
            'cargo' => 'Jefa del Departamento de Servicios Académicos',
            'telefono' => '5556220925',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $jefeDSA->assignRole('jefe');
        $jefeDSA->givePermissionTo(['ver estadisticas', 'configurar']);

        $jefeDID = User::create([ //2
            'nombre' => 'María del Rosario',
            'apellido_paterno' => 'Barragán',
            'apellido_materno' => 'Paz',
            'email' => 'jefe@jefe.com',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make('password')
        ]);

        Jefe::create([
            'user_id' => $jefeDID->id,
            'titulo' => 'M. E',
            'cargo' => 'Jefa del Departamento de Investigación y Desarrollo',
            'telefono' => '5556220925',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $jefeDID->assignRole('jefe');

        $jefeRedesSeguridad = User::create([ //3
            'nombre' => 'Rafael',
            'apellido_paterno' => 'Lopez',
            'apellido_materno' => 'Perez',
            'email' => 'rafael@ingenieria.unam.edu',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make('password')
        ]);

        Jefe::create([
            'user_id' => $jefeRedesSeguridad->id,
            'titulo' => 'Ing',
            'cargo' => 'Jefe del Departamento de Seguridad en Cómputo',
            'telefono' => '5556220925',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $jefeRedesSeguridad->assignRole('jefe');

        $coordinador = User::create([ //4
            'nombre' => 'Ibeth Graciela',
            'apellido_paterno' => 'Flores',
            'apellido_materno' => 'Muñoz',
            'email' => 'ibethfm@ingenieria.unam.edu',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make('password')
        ]);

        $coordinador->assignRole('jefe_documentacion');

        $jefeSalas = User::create([ // 5
            'nombre' => 'Cruz Sergio',
            'apellido_paterno' => 'Aguilar',
            'apellido_materno' => 'Díaz',
            'email' => 'cruz.aguilar@ingenieria.unam.edu',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make('password')
        ]);

        Jefe::create([
            'user_id' => $jefeSalas->id,
            'titulo' => 'Ing',
            'cargo' => 'Jefe de Salas de Computo',
            'telefono' => '5556220925',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $jefeSalas->assignRole('jefe');
    }
}
