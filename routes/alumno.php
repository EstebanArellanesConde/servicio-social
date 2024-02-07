<?php


use App\Http\Controllers\Alumno\AlumnoController;
use App\Http\Controllers\Alumno\CartaAceptacionController;
use App\Http\Controllers\Alumno\SolicitudInicioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Alumno\ReporteController;

Route::middleware(['check_user', 'role:alumno'])->prefix('alumno')->group(function () {
    Route::get('/', [AlumnoController::class, 'index'])->name('alumno.index');

    Route::controller(ReporteController::class)->prefix('reportes')->group(function() {
        Route::get('/',  'index')->name('alumno.reportes');
        Route::get('/{reporte}', 'show')->name('alumno.reportes.download');
    });

    Route::prefix('formato')
        ->group(function() {
            Route::post('solicitud_inicio/{alumno}', [SolicitudInicioController::class, 'store'])->name('alumno.solicitud_inicio.store');
            Route::post('carta_aceptacion/{alumno}', [CartaAceptacionController::class, 'store'])->name('alumno.carta_aceptacion.store');
        });
});
