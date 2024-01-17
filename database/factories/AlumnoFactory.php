<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumno>
 */
class AlumnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pertenencia_unica = $this->faker->boolean;
        if ($pertenencia_unica){
            $departamento_id = $this->faker->numberBetween(1,5);
        } else {
            $departamento_id = 1;
        }

        $user = User::factory()->create();
        $user->assignRole('alumno');

        return [
            'user_id' => $user->id,
            'numero_cuenta' => $this->faker->numberBetween(310000000, 410000000),
            'curp' => $this->faker->regexify("[A-Z]{18}"),
            'fecha_nacimiento' => $this->faker->dateTimeBetween('1970-01-01', '2005-01-01'),
            'sexo' => $this->faker->randomElement(['H', 'M']),
            'genero' => $this->faker->randomElement(['M', 'F', 'O']),
            'telefono_alternativo' => $this->faker->phoneNumber(),
            'telefono_celular' => $this->faker->phoneNumber(),
            'fecha_ingreso_facultad' => $this->faker->dateTimeBetween('1990-01-01', '2023-06-01'),
            'creditos_pagados' => $this->faker->numberBetween(100, 800),
            'avance_porcentaje' => $this->faker->numberBetween(10, 100),
            'promedio' => $this->faker->randomFloat(2, 5.0, 10.0),
            'duracion_servicio' => $this->faker->randomElement([6, 12]),
            'hora_inicio' => $this->faker->time(),
            'hora_fin' => $this->faker->time(),
            'fecha_inicio' => $this->faker->optional()->date(),
            'fecha_fin' => $this->faker->optional()->date(),
            'pertenencia_unica' => $pertenencia_unica,
            'escuela_id' => $this->faker->numberBetween(1, 119),
            'carrera_id' => $this->faker->optional(0.7)->numberBetween(1,16),
            'departamento_id' => $departamento_id,
            'estado_id' => $this->faker->numberBetween(1,4),
            'fecha_estado' => now(),
            'clave_dgose_id' => 2023,
        ];
    }
}
