<?php

namespace App\Helpers;

class Helper
{
    public static function concatenarNombre(){
        $args = func_get_args();
        return implode(" ", $args);
    }

    public static function capitalize(string $string) : string
    {
        return ucwords(mb_strtolower($string));
    }
}
