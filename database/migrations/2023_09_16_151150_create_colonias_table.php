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
        Schema::create('colonias', function (Blueprint $table) {
            $table->id();
            // agregar zero fill
            $table->unsignedInteger('codigo_postal');
            $table->string('colonia');
            $table->unsignedBigInteger('id_municipio');
            $table->foreign('id_municipio')
                ->references('id')
                ->on('municipios')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colonias');
    }
};
