<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([ //1
            'name' => 'Luis Angel',
            'apellido_paterno' => 'Quintana',
            'apellido_materno' => 'Mora',
            'email' => 'luis.quintana@gmail.com',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make('password')
        ]);

        $alumno_1 = DB::table('users')->where('email', 'luis.quintana@gmail.com')->first();
        DB::table('alumnos')->insert([
            'user_id' => $alumno_1->id,
            'numero_cuenta' => 319183817,
            // Alumno datos
            'curp' => 'QUML030126HMCNRSA5',
            'fecha_nacimiento' => '2003-06-01',
            'genero' => 'H',

            'telefono_casa' => '5588414988',
            'telefono_celular' => '5523052838',

            'interno' => 0,
            'carrera_id' => 1,
            'fecha_ingreso_facultad' => '2021-06-01',

            'creditos_pagados' => 136,
            'avance_porcentaje' => 60,

            'promedio' => 9.43,
            'duracion_servicio' => 6,

            'hora_inicio' => '09:00:00',
            'hora_fin' => '13:00:00',
            'fecha_inicio' => '2023-07-01',
            'fecha_fin' => '2023-01-01',
            'pertenencia_unica' => 1,
            'departamento_id' => 2,
        ]);

        User::find($alumno_1->id)->assignRole('alumno');
    }
}
