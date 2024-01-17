<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    protected $table = 'division';

    public function getNombreCoordinadorSS(){
        return $this->coordinador_ss_titulo . '. ' . $this->coordinador_ss_nombre;
    }
}
