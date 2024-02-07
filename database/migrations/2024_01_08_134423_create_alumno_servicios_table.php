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
        Schema::create('alumno_servicio', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('clave_dgose_id');
            $table->foreign('clave_dgose_id')
                ->references('id')
                ->on('clave_dgose')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('alumno_id')->unique();
            $table->foreign('alumno_id')
                ->references('id')
                ->on('alumno')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('num_servicio');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno_servicio');
    }
};
