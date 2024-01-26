<?php


use App\Http\Controllers\Alumno\AlumnoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Alumno\ReporteController;

Route::middleware(['check_user', 'role:alumno'])->prefix('alumno')->group(function () {
    Route::get('/', [AlumnoController::class, 'index'])->name('alumno.index');

    Route::controller(ReporteController::class)->prefix('reportes')->group(function() {
        Route::get('/',  'index')->name('alumno.reportes');
        Route::get('/{reporte}', 'show')->name('alumno.reportes.download');
    });
});
