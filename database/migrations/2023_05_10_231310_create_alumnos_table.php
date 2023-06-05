<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('numero_cuenta')->unique()->unsigned();
            $table->string('curp', 18)->unique();


            $table->date('fecha_nacimiento');
            $table->char('genero');

            $table->string('telefono_casa');
            $table->string('telefono_celular');

            $table->boolean('interno');

            $table->unsignedBigInteger('carrera_id');
            $table->foreign('carrera_id')
                    ->references('id')
                    ->on('carreras')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');

            $table->date('fecha_ingreso_facultad');
            $table->integer('creditos_pagados')->unsigned();
            $table->integer('avance_porcentaje')->unsigned();
            $table->decimal('promedio', $precision=4, $scale=2);
            $table->integer('duracion_servicio')->unsigned();

            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();

            $table->boolean('pertenencia_unica');

            /*
             *
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('estado');

            */


            $table->unsignedBigInteger('departamento_id')->default(1);
            $table->foreign('departamento_id')
                ->references('id')
                ->on('departamentos')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};
