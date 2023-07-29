<?php

namespace Database\Factories;

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
        return [
            'numero_cuenta' => $this->faker->numberBetween(310000000, 410000000),
            'curp' => $this->faker->regexify("[A-Z]{18}"),
            'fecha_nacimiento' => $this->faker->date(),
            'sexo' => $this->faker->randomElement(['H', 'M', 'O']),
            'telefono_alternativo' => $this->faker->phoneNumber(),
            'telefono_celular' => $this->faker->phoneNumber(),
            'fecha_ingreso_facultad' => $this->faker->date(),
            'creditos_pagados' => $this->faker->numberBetween(100, 800),
            'avance_porcentaje' => $this->faker->numberBetween(10, 100),
            'promedio' => $this->faker->randomFloat(2, 5.0, 10.0),
            'duracion_servicio' => $this->faker->randomElement([6, 12]),
            'hora_inicio' => $this->faker->time(),
            'hora_fin' => $this->faker->time(),
            'fecha_inicio' => $this->faker->date(),
            'fecha_fin' => $this->faker->date(),
            'pertenencia_unica' => $this->faker->boolean(),
            'escuela_id' => $this->faker->numberBetween(1, 99),
            'carrera_id' => $this->faker->optional(0.7)->numberBetween(1,16),
            'departamento_id' => $this->faker->numberBetween(1,5),
            'estado_id' => $this->faker->numberBetween(1,3)

        ];
    }
}
