<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Alumno;
use App\Models\Escuela;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DivisionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(JefeSeeder::class); // debe estar antes de users o alumnos
        $this->call(DepartamentoSeeder::class);
        $this->call(CarreraSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(EscuelaSeeder::class);
        $this->call(AlumnoSeeder::class);
        $this->call(HistoricoEstadoSeeder::class);

        Escuela::factory(20)->create();
        Alumno::factory(500)->create();
    }
}
