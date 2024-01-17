<?php

use App\Models\Alumno;
use App\Models\ClaveDGOSE;
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
        Schema::create('formato', function (Blueprint $table) {
            $table->foreignIdFor(ClaveDGOSE::class, 'clave_dgose_id');
            $table->id();

            $table->string('tipo', 4);
            $table->string('ruta');

            $table->date('fecha_expiracion');
            $table->foreignIdFor(Alumno::class, 'alumno_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formatos');
    }
};
