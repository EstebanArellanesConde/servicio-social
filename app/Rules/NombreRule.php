<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NombreRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Permite solo aceptar letras y espacios
        // Para usar guiones utilizar: /^[\pL\s-]+$/u.
        if(!preg_match('/^[\pL\s-]+$/u', $value)){
            $fail("El :attribute puede contener solo letras, espacios y guiones");
        }

    }
}
