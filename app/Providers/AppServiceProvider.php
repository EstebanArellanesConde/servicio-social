<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            // Permite solo aceptar letras y espacios
            // Para usar guiones utilizar: /^[\pL\s-]+$/u.
            return preg_match('/^[\pL\s]+$/u', $value);

        });
    }
}
