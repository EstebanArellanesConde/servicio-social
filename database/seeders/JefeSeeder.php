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
            'name' => 'Beatriz',
            'apellido_paterno' => 'Barrera',
            'apellido_materno' => 'Hernández',
            'email' => 'bety@ingenieria.unam.edu',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make('password')
        ]);

        Jefe::create([
            'user_id' => $jefeDSA->id,
            'titulo' => 'Ing',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $jefeDSA->assignRole('jefe', 'dsa');

        $jefeDID = User::create([ //2
            'name' => 'Chary',
            'apellido_paterno' => 'Barragan',
            'apellido_materno' => 'Paz',
            'email' => 'chary.barragan@ingenieria.unam.edu',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make('password')
        ]);

        Jefe::create([
            'user_id' => $jefeDID->id,
            'titulo' => 'Ing',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $jefeDID->assignRole('jefe');

        $jefeRedesSeguridad = User::create([ //3
            'name' => 'Rafael',
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
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $jefeRedesSeguridad->assignRole('jefe');

        $coordinador = User::create([ //4
            'name' => 'Ibeth Graciela',
            'apellido_paterno' => 'Flores',
            'apellido_materno' => 'Muñoz',
            'email' => 'ibethfm@ingenieria.unam.edu',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make('password')
        ]);

        Jefe::create([
            'user_id' => $coordinador->id,
            'titulo' => 'Ing',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $coordinador->assignRole('coordinador');

        $jefeSalas = User::create([ // 5
            'name' => 'Cruz Sergio',
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
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $jefeSalas->assignRole('jefe');
    }
}
