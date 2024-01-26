<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DomicilioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('domicilio')->insert([
            'calle' => 'MIGUEL HIDALGO',
            'numero_externo' => 20,
            'colonia_id' => 2,
        ]);
    }
}
