<?php


use App\Http\Controllers\ConfiguracionController;
use Illuminate\Support\Facades\Route;

Route::controller(ConfiguracionController::class)
    ->middleware(['check_user', 'role:jefe_documentacion|jefe'])
    ->prefix('configuracion')
    ->group(function () {

    Route::get('/', 'index')->name('configuracion.index')->middleware(['can:configurar']);
});
