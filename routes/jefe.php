<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jefe\ExportController;
use App\Http\Controllers\Jefe\FormatoController;
use App\Http\Controllers\Jefe\JefeController;
use App\Http\Controllers\Jefe\ReporteController;

Route::middleware(['check_user', 'role:jefe'])
    ->prefix('jefe')
    ->group(function () {
        Route::get('/', [JefeController::class, 'inscritos'])->name('jefe.inscritos');
        Route::get('/rechazados', [JefeController::class, 'rechazados'])->name('jefe.rechazados');
        Route::get('/finalizados', [JefeController::class, 'finalizados'])->name('jefe.finalizados');
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

    Route::controller(ReporteController::class)->prefix('reportes')->group(function() {
        Route::get('/', 'index')->name('jefe.reportes');
        Route::get('/{id}', 'show')->name('jefe.reportes.show');
        Route::put('/aceptar/{id}', 'aceptar')->name('jefe.reportes.aceptar');
        Route::put('/correcion/{id}', 'correccion')->name('jefe.reportes.correccion');
    });
});
