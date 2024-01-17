<?php

namespace App\Providers;

use App\Models\Alumno;
use App\Observers\AlumnoObserver;
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
        Carbon::setLocale('es');
        setlocale(LC_ALL, 'es_MX');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Alumno::observe(AlumnoObserver::class);
    }
}
