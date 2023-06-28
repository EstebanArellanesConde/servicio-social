<?php

namespace App\Rules;

use App\Models\Escuela;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EscuelaExternaRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // verifica si la escuela del input ya existe y ademas es de la unam
        if(Escuela::where("escuela", strtoupper(trim($value)))->where("is_unam", true)->first()){
            $fail($value . " ya existe dentro de las escuelas de la UNAM");
        }
    }
}
