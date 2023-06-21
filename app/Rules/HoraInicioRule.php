<?php

namespace App\Rules;

use App\app;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HoraInicioRule implements ValidationRule
{
    public $hora_inicio;
    public $hora_fin;
    public $duracion;
    public function __construct($hora_inicio, $duracion, $hora_fin){
        $this->hora_inicio = $hora_inicio;
        $this->hora_fin = Carbon::parse($hora_fin);
        $this->duracion = $duracion;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $this->hora_inicio = Carbon::parse($value);
        if (
            $this->duracion == "6"
            && $this->hora_inicio->lt($this->hora_fin) // hora de inicio menor a la hora de fin
            && $this->hora_inicio->gte(Carbon::parse(App::HORA_ENTRADA))
            && $this->hora_inicio->addHours(4)->lte(Carbon::parse(App::HORA_SALIDA))
        ){
            //
        }
        else if (
            $this->duracion == "12"
            && $this->hora_inicio->lt($this->hora_fin) // hora de inicio menor a la hora de fin
            && $this->hora_inicio->gte(Carbon::parse(App::HORA_ENTRADA))
            && $this->hora_inicio->addHours(2)->lte(Carbon::parse(App::HORA_SALIDA))
        ){
            //
        }
        else {
            $fail("La hora de entrada es las " . App::HORA_ENTRADA . " y de salida a las " . App::HORA_SALIDA);
        }
    }
}
