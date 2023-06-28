<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carreras')->insert([ //1
            "clave_carrera" => "139",
            "carrera" => "Ingeniería Aeroespacial",
            "division_id" => 1
        ]);

        DB::table('carreras')->insert([ //2
            "clave_carrera" => "107",
            "carrera" => "Ingeniería Civil",
            "division_id" => 1
        ]);

        DB::table('carreras')->insert([ //3
            "clave_carrera" => "120",
            "carrera" => "Ingeniería Geomática",
            "division_id" => 1
        ]);

        DB::table('carreras')->insert([ //4
            "clave_carrera" => "137",
            "carrera" => "Ingeniería Ambiental",
            "division_id" => 1
        ]);

        DB::table('carreras')->insert([ //5
            "clave_carrera" => "114",
            "carrera" => "Ingeniería Industrial",
            "division_id" => 2
        ]);

        DB::table('carreras')->insert([ //6
            "clave_carrera" => "115",
            "carrera" => "Ingeniería Mecánica",
            "division_id" => 2
        ]);

        DB::table('carreras')->insert([ //7
            "clave_carrera" => "124",
            "carrera" => "Ingeniería Mecatrónica",
            "division_id" => 2
        ]);

        DB::table('carreras')->insert([ //8
            "clave_carrera" => "135",
            "carrera" => "Ingeniería en Sistemas Biomédicos",
            "division_id" => 2
        ]);

        DB::table('carreras')->insert([ //9
            "clave_carrera" => "109",
            "carrera" => "Ingeniería Eléctrica Electrónica",
            "division_id" => 3
        ]);

        DB::table('carreras')->insert([ //10
            "clave_carrera" => "110",
            "carrera" => "Ingeniería en Computación",
            "division_id" => 3
        ]);

        DB::table('carreras')->insert([ //11
            "clave_carrera" => "111",
            "carrera" => "Ingeniería en Telecomunicaciones",
            "division_id" => 3
        ]);

        DB::table('carreras')->insert([ //12
            "clave_carrera" => "108",
            "carrera" => "Ingeniería de Minas y Metalurgia",
            "division_id" => 4
        ]);

        DB::table('carreras')->insert([ //13
            "clave_carrera" => "113",
            "carrera" => "Ingeniería Geológica",
            "division_id" => 5
        ]);

        DB::table('carreras')->insert([ //14
            "clave_carrera" => "112",
            "carrera" => "Ingeniería Geofísica",
            "division_id" => 6
        ]);

        DB::table('carreras')->insert([ //15
            "clave_carrera" => "117",
            "carrera" => "Ingeniería Petrolera",
            "division_id" => 7
        ]);

        DB::table('carreras')->insert([ //16
            "clave_carrera" => "116",
            "carrera" => "Ingeniería Mecánica Eléctrica",
            "division_id" => 3
        ]);
    }
}
