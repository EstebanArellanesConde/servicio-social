<?php

namespace Database\Seeders;

use App\Models\ClaveDGOSE;
use Illuminate\Database\Seeder;

class ClaveDGOSESeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        ClaveDGOSE::create([
            'anio' => 2023,
            'clave' => '2023-12/81-9',
        ]);

        ClaveDGOSE::create([
            'anio' => 2024,
            'clave' => '2024-12/81-9',
        ]);

        ClaveDGOSE::create([
            'anio' => 2025,
        ]);
    }
}
