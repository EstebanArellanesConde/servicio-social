<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\JefeController;
use App\Http\Controllers\ProfileController;
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
});

Route::middleware(['auth', 'verified', 'role:jefe'])->prefix('jefe')->group(function () {
    Route::get('/', [JefeController::class, 'index'])->name('jefe.index');
    Route::get('/inscritos', [JefeController::class, 'inscritos'])->name('jefe.inscritos');
    Route::get('/rechazados', [JefeController::class, 'rechazados'])->name('jefe.rechazados');
    Route::get('/finalizados', [JefeController::class, 'finalizados'])->name('jefe.finalizados');
    Route::get('/estadisticas', [JefeController::class, 'estadisticas'])->name('jefe.estadisticas')->middleware(['role:jefe_dsa|coordinador']);
    Route::get('/pendiente/{id}', [JefeController::class, 'pendiente'])->name('jefe.pendiente');
    Route::get('/aceptar/{id}', [JefeController::class, 'aceptar'])->name('jefe.aceptar');
    Route::get('/rechazar/{id}', [JefeController::class, 'rechazar'])->name('jefe.rechazar');
    Route::get('/finalizar/{id}', [JefeController::class, 'finalizar'])->name('jefe.finalizar');
    Route::get('/download/{type}', [JefeController::class, 'download'])->name('jefe.download');
});

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


require __DIR__.'/auth.php';

