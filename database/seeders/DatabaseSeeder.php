<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(DivisionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(JefeSeeder::class); // debe estar antes de users o alumnos
        $this->call(DepartamentoSeeder::class);
        $this->call(CarreraSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(AlumnoSeeder::class);
        $this->call(HistoricoEstadoSeeder::class);
    }
}
