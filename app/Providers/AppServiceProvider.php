<?php

namespace App\Providers;

use App\Models\Alumno;
use App\Models\AlumnoServicio;
use App\Models\Reporte;
use App\Observers\AlumnoObserver;
use App\Observers\AlumnoServicioObserver;
use App\Observers\ReporteObserver;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Alumno::observe(AlumnoObserver::class);
        AlumnoServicio::observe(AlumnoServicioObserver::class);
        Reporte::observe(ReporteObserver::class);

        Carbon::setLocale('es');
        setlocale(LC_ALL, 'es_MX');
    }
}
