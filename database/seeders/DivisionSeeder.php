<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('division')->insert([ //1
            "nombre" => "División de Ingenierías Civil y Geomática",
            "abreviatura" => "DCyG",
            "coordinador_ss_titulo" => "M. I",
            "coordinador_ss_nombre" => "Claudia Elisa Sánchez Navarro",
            "coordinador_ss_genero" => "F",
        ]);

        DB::table('division')->insert([ //2
            "nombre" => "División de Ingeniería Mecánica e Industrial",
            "abreviatura" => "DIMEI",
            "coordinador_ss_titulo" => "M. I",
            "coordinador_ss_nombre" => "Víctor Manuel Vázquez Huarota",
            "coordinador_ss_genero" => "M",
        ]);

        DB::table('division')->insert([ //3
            "nombre" => "División de Ingeniería Eléctrica",
            "abreviatura" => "DIE",
            "coordinador_ss_titulo" => "Lic",
            "coordinador_ss_nombre" => "Angélica Gutiérrez Vázquez",
            "coordinador_ss_genero" => "F",
        ]);

        DB::table('division')->insert([ //4
            "nombre" => "División de Ingeniería en Ciencias de la Tierra",
            "abreviatura" => "DICT",
            "subdivision" => "Carrera de Ingeniería de Minas y Metalurgia",
            "coordinador_ss_titulo" => "Ing",
            "coordinador_ss_nombre" => "Soledad Viridiana",
            "coordinador_ss_genero" => "F",
        ]);

        DB::table('division')->insert([ //5
            "nombre" => "División de Ingeniería en Ciencias de la Tierra",
            "abreviatura" => "DICT",
            "subdivision" => "Carrera de Ingeniería Geológica",
            "coordinador_ss_titulo" => "Ing",
            "coordinador_ss_nombre" => "Isabel Domínguez",
            "coordinador_ss_genero" => "F",
        ]);

        DB::table('division')->insert([ //6
            "nombre" => "División de Ingeniería en Ciencias de la Tierra",
            "abreviatura" => "DICT",
            "subdivision" => "Carrera de Ingeniería Geofísica",
            "coordinador_ss_titulo" => "Ing",
            "coordinador_ss_nombre" => "Thalía Alfonsina Reyes Pimentel",
            "coordinador_ss_genero" => "F",
        ]);

        DB::table('division')->insert([ //7
            "nombre" => "División de Ingeniería en Ciencias de la Tierra",
            "abreviatura" => "DICT",
            "subdivision" => "Carrera de Ingeniería Petrolera",
            "coordinador_ss_titulo" => "M. I",
            "coordinador_ss_nombre" => "Berenice Anell Martínez Cabañas",
            "coordinador_ss_genero" => "F",
        ]);
    }
}
