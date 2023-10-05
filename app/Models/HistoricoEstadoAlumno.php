<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoEstadoAlumno extends Model
{
    use HasFactory;
    protected $table = 'historico_estado_alumno';
    public $timestamps = false;
}
