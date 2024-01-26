<?php


use App\Http\Controllers\JefeDocumentacion\ConfiguracionController;
use App\Http\Controllers\JefeDocumentacion\JefeDocumentacionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['check_user', 'role:jefe_documentacion'])
    ->prefix('jefe_documentacion')
    ->group(function () {
    Route::controller(JefeDocumentacionController::class)->group(function () {
        Route::get('/', 'index')->name('jefe_documentacion.index');
        Route::put('/aceptar/{id}', 'asignarFechas')->name('jefe_documentacion.aceptar');
        Route::get('/estadisticas', 'estadisticas')->name('jefe_documentacion.estadisticas')->middleware(['can:ver estadisticas']);
    });
});
