<?php

use App\Enums\Departamento;
use App\Models\ClaveDGOSE;
use Carbon\Carbon;
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
        Schema::create('alumno', function (Blueprint $table) {
            $table->id();

            $table->string('curp', 18)->unique();

            $table->date('fecha_nacimiento');
            $table->string('sexo', 1);
            $table->string('genero', 1);

            $table->string('telefono_alternativo', 18);
            $table->string('telefono_celular', 18);

            $table->decimal('promedio', $precision=4, $scale=2)->unsigned();
            // duración en meses
            $table->unsignedSmallInteger('duracion_servicio');

            $table->time('hora_inicio');
            $table->time('hora_fin');


            $table->boolean('pertenencia_unica');

            $table->dateTime('fecha_estado');

            // interno facultad de ingenieria
            $table->integer('numero_cuenta')->unique()->unsigned()->nullable();
            // Puede ser null si no pertenence a la FI
            $table->date('fecha_ingreso_facultad')->nullable();

            // Son null cuando no son de la UNAM
            $table->unsignedSmallInteger('creditos_pagados')->nullable();
            $table->decimal('avance_porcentaje', $precision=5, $scale=2)->unsigned()->nullable();

            // null ya que se asigna despues de registrarse
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();

            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')
                ->references('id')
                ->on('estado_alumno')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('escuela_id');
            $table->foreign('escuela_id')
                ->references('id')
                ->on('escuela')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            // valor por defecto el DSA en caso de que no haya colocado departamento
            $table->unsignedBigInteger('departamento_id')->default(Departamento::Salas);
            $table->foreign('departamento_id')
                ->references('id')
                ->on('departamento')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('domicilio_id')->nullable();
            $table->foreign('domicilio_id')
                ->references('id')
                ->on('domicilio')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('carrera_id')->nullable();
            $table->foreign('carrera_id')
                ->references('id')
                ->on('carrera')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('clave_dgose_id')->nullable();
            $table->foreign('clave_dgose_id')
                ->references('anio')
                ->on('clave_dgose')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->integer('num_alumno')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno');
    }
};
