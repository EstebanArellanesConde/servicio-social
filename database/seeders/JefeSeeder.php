<?php

namespace Database\Seeders;

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
        DB::table('users')->insert([ //1
            'name' => 'Bety',
            'apellido_paterno' => 'Lopez',
            'apellido_materno' => 'Perez',
            'email' => 'bety@ingenieria.unam.edu',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make('prueba123456789')
        ]);

        $user_1 = User::find(1);

        DB::table('jefes')->insert([
            'user_id' => $user_1->id,
            'titulo' => 'Ing',
        ]);

        $user_1->assignRole('jefe');

        DB::table('users')->insert([ //2
            'name' => 'Chary',
            'apellido_paterno' => 'Barragan',
            'apellido_materno' => 'Paz',
            'email' => 'chary.barragan@ingenieria.unam.edu',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make('prueba123456789')
        ]);

        $user_2 = User::find(2);
        DB::table('jefes')->insert([
            'user_id' => $user_2->id,
            'titulo' => 'Ing',
        ]);
        $user_2->assignRole('jefe');

        DB::table('users')->insert([ //3
            'name' => 'Rafael',
            'apellido_paterno' => 'Lopez',
            'apellido_materno' => 'Perez',
            'email' => 'rafa@gmail.com',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make('prueba123456789')
        ]);

        $user_3 = User::find(3);
        DB::table('jefes')->insert([
            'user_id' => $user_3->id,
            'titulo' => 'Ing',
        ]);

        $user_3->assignRole('jefe');

        DB::table('users')->insert([ //4
            'name' => 'Prueba4',
            'apellido_paterno' => 'Prueba4',
            'apellido_materno' => 'Prueba4',
            'email' => 'prueba20@gmail.com',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make('prueba123456789')
        ]);

        $user_4 = User::find(4);
        DB::table('jefes')->insert([
            'user_id' => $user_4->id,
            'titulo' => 'Ing',
        ]);

        $user_4->assignRole('jefe');
        DB::table('users')->insert([ //5
            'name' => 'Ibeth Graciela',
            'apellido_paterno' => 'Flores',
            'apellido_materno' => 'Muñoz',
            'email' => 'ibethfm@ingenieria.unam.edu',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make('ibeth_flores')
        ]);


        $user_5 = User::find(5);
        DB::table('jefes')->insert([
            'user_id' => $user_5->id,
            'titulo' => 'Ing',
        ]);
        $user_5->assignRole('jefe');
    }
}
