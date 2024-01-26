<?php

namespace Database\Seeders;

use App\Models\Colonia;
use App\Models\EstadoMexico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Symfony\Component\HttpFoundation\File\Exception\NoFileException;

class ColoniaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public static function run(): void
    {
        $path = 'database/data/colonias.txt';
        $csvFile = fopen(base_path($path), "r");

        while (($data = fgetcsv($csvFile, 2000, "|")) !== FALSE) {
            Colonia::create([
                "codigo_postal" => $data['0'],
                "colonia" => $data['1'],
                "municipio" => $data['3'],
                "estado" => $data['4'],
            ]);
        }

        fclose($csvFile);

        // cambiar nombre de México a estado de méxico
        Colonia::where('estado', '=', 'México')
            ->update(['estado' => 'Estado de México']);
    }
}
