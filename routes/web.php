<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FormatoController;
use App\Http\Controllers\JefeController;
use App\Http\Controllers\JefeDocumentacionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReporteController;
use App\Models\Reporte;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth', 'verified', 'role:alumno'])->prefix('alumno')->group(function () {
    Route::get('/', [AlumnoController::class, 'index'])->name('alumno.index');
    Route::get('/reportes', [AlumnoController::class, 'reportes'])->name('alumno.reportes');
    Route::get('/reportes/download/{id}', [ReporteController::class, 'download'])->name('alumno.reportes.download');
});

Route::middleware(['auth', 'verified', 'role:jefe'])->prefix('jefe')->group(function () {
    Route::get('/', [JefeController::class, 'inscritos'])->name('jefe.inscritos');
    Route::get('/rechazados', [JefeController::class, 'rechazados'])->name('jefe.rechazados');
    Route::get('/finalizados', [JefeController::class, 'finalizados'])->name('jefe.finalizados');
    Route::get('/reportes', [JefeController::class, 'reportes'])->name('jefe.reportes');
    Route::get('/reportes/{id}', [ReporteController::class, 'show'])->name('jefe.reportes.show');
    Route::put('/reportes/aceptar/{id}', [ReporteController::class, 'aceptar'])->name('jefe.reportes.aceptar');
    Route::put('/reportes/correcion/{id}', [ReporteController::class, 'correccion'])->name('jefe.reportes.correccion');

    Route::get('/estadisticas', [JefeController::class, 'estadisticas'])->name('jefe.estadisticas')->middleware(['can:ver estadisticas']);
    Route::get('/config', [JefeController::class, 'configuracion'])->name('jefe.configuracion')->middleware(['can:configurar']);
    Route::get('/pendiente/{id}', [JefeController::class, 'pendiente'])->name('jefe.pendiente');
    Route::get('/aceptar/{id}', [JefeController::class, 'aceptar'])->name('jefe.aceptar');
    Route::get('/rechazar/{id}', [JefeController::class, 'rechazar'])->name('jefe.rechazar');
    Route::get('/finalizar/{id}', [JefeController::class, 'finalizar'])->name('jefe.finalizar');
    Route::post('/download', [ExportController::class, 'store'])->name('jefe.download');
    Route::post('/download/carta_aceptacion/{id}', [FormatoController::class, 'cartaAceptacion'])->name('jefe.carta_aceptacion')->middleware(['role:jefe_documentacion']);
    Route::post('/download/solicitud_inicio/{id}', [FormatoController::class, 'solicitudInicio'])->name('jefe.solicitud_inicio')->middleware(['role:jefe_documentacion']);
    Route::post('/download/reporte/{id}', [FormatoController::class, 'reporte'])->name('jefe.reporte');
});

Route::middleware(['auth', 'verified', 'role:jefe_documentacion'])->prefix('jefe_documentacion')->group(function () {
    Route::get('/', [JefeDocumentacionController::class, 'index'])->name('jefe_documentacion.index');
    Route::get('/estadisticas', [JefeDocumentacionController::class, 'estadisticas'])->name('jefe_documentacion.estadisticas')->middleware(['can:ver estadisticas']);
    Route::get('/config', [JefeDocumentacionController::class, 'configuracion'])->name('jefe_documentacion.configuracion')->middleware(['can:configurar']);
});


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


Route::get('reporte/firmar', [ReporteController::class, 'firmar'])->name('reporte.firma');

require __DIR__.'/auth.php';

