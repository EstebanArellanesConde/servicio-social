<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoEstadoAlumno extends Model
{
    use HasFactory;
    protected $table = 'historico_estado_alumno';
    public $timestamps = false;

    protected $fillable = [
        'fecha_estado',
        'estado_id',
        'alumno_id'
    ];
}
