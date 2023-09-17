<?php

namespace Database\Seeders;

use App\Models\EstadoMexico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ColoniaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public static function run(): void
    {
        $file = file_get_contents('database/seeders/domicilios.json');
        $estados = json_decode($file, true);

        foreach ($estados as $estado => $municipios){
            foreach ($municipios as $municipio => $colonias){
                DB::table('municipios')->insert([
                    'estado' => $estado,
                    'municipio' => $municipio
                ]);
                $municipioId = DB::table('municipios')->where('municipio', '=', $municipio)->first('id')->id;
                foreach ($colonias as $colonia){
                    DB::table('colonias')->insert([
                        'id_municipio' => $municipioId,
                        'codigo_postal' => $colonia['codigo_postal'],
                        'colonia' => $colonia['colonia'],
                    ]);
                }
            }
        }
    }
}
