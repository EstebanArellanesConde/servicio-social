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
        Schema::create('reporte', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('alumno_id');
            $table->foreign('alumno_id')
                ->references('id')
                ->on('alumno')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedSmallInteger('num_reporte');

            $table->unsignedSmallInteger('horas_bimestre_acumuladas')->nullable();
            $table->longText('path')->nullable();

            // status
            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')
                ->references('id')
                ->on('estado_reporte')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->text('observaciones')->nullable();

            $table->timestamps();
            $table->index(['alumno_id', 'num_reporte']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte');
    }
};
