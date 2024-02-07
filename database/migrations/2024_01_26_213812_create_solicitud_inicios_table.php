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
        Schema::create('solicitud_inicio', function (Blueprint $table) {
            $table->id();

            $table->text('path');

            $table->unsignedBigInteger('alumno_servicio_id')->unique();
            $table->foreign('alumno_servicio_id')
                ->references('id')
                ->on('alumno_servicio')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_inicio');
    }
};
