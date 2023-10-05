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
            $estadoId = DB::table('estado_mexico')->insertGetId([
                'nombre' => $estado,
            ]);
            foreach ($municipios as $municipio => $colonias){
                $municipioId = DB::table('municipios')->insertGetId([
                    'nombre' => $municipio,
                    'estado_id' => $estadoId,
                ]);
                foreach ($colonias as $colonia){
                    DB::table('colonias')->insert([
                        'municipio_id' => $municipioId,
                        'nombre' => $colonia['colonia'],
                        'codigo_postal' => $colonia['codigo_postal'],
                    ]);
                }
            }
        }
    }
}
