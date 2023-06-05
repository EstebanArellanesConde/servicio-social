<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HoraInicioRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        dd($value);
        $hora_inicio = Carbon::parse($value[0]);
        $duracion = $value[1];
        if ($duracion == 6 && $hora_inicio->gt("15:01")){
            $fail("La hora de salida es hasta las 19:00");
        }
        else if($hora_inicio->gt("17:01")){
            $fail("La hora de salida es hasta las 19:00");
        }
    }
}
