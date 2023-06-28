<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class EscuelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        $file = file_get_contents('database/seeders/escuelas.json');
        $escuelas = json_decode($file, false);

        // agrega a facultad de ingeniería con el id 1
        DB::table('escuelas')->insert([
            'escuela' => "FACULTAD DE INGENIERIA (UNAM)",
            'is_unam' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // agregar escuelas del json
        for ($i = 0; $i < count($escuelas); $i++){
            DB::table('escuelas')->insert([
                'escuela' => $escuelas[$i],
                'is_unam' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
