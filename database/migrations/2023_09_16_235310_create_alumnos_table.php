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

            $table->integer('numero_cuenta')->unique()->unsigned()->nullable();
            $table->string('curp', 18)->unique();

            $table->date('fecha_nacimiento');
            $table->string('sexo');

            $table->string('telefono_alternativo');
            $table->string('telefono_celular');

            $table->unsignedBigInteger('escuela_id');
            $table->foreign('escuela_id')
                ->references('id')
                ->on('escuelas')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            // interno facultad de ingenieria
            /* diseno de nueva tabla */
            //$table->boolean('interno'); // ya no necesario si se registra la escuela el id 1
            $table->unsignedBigInteger('carrera_id')->nullable();
            $table->foreign('carrera_id')
                    ->references('id')
                    ->on('carreras')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');


            // Puede ser null si no pertenence a la FI
            $table->date('fecha_ingreso_facultad')->nullable();

            // Son null cuando no son de la UNAM
            $table->integer('creditos_pagados')->unsigned()->nullable();
            $table->integer('avance_porcentaje')->unsigned()->nullable();

            // 4 dígitos, 2 de ellos son decimales
            $table->decimal('promedio', $precision=4, $scale=2)->unsigned();
            $table->integer('duracion_servicio')->unsigned();

            $table->time('hora_inicio');
            $table->time('hora_fin');

            // null ya que se asigna despues de registrarse
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();

            $table->boolean('pertenencia_unica');

            // valor por defecto el DSA en caso de que no haya colocado departamento
            $table->unsignedBigInteger('departamento_id')->default(1);

            $table->foreign('departamento_id')
                ->references('id')
                ->on('departamentos')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->unsignedBigInteger('domicilio_id')->nullable();
            $table->foreign('domicilio_id')
                ->references('id')
                ->on('domicilios')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('estados');

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
