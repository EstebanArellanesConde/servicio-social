<?php

namespace App\Models;

use HighSolutions\EloquentSequence\Sequence;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Reporte extends Model
{
    use HasFactory, Sequence;
    protected $table = 'reporte';

    protected $fillable = [
        'horas_acumuladas',
        'path',
        'estado_id',
        'observaciones',
        'fecha_disponible_llenado',
        'alumno_servicio_id',
        'horas_bimestre_acumuladas',
    ];

    public function sequence(){
        return [
            'group' => 'alumno_servicio_id',
            'fieldName' => 'num_reporte',
            'orderFrom1' => true,
            'notUpdateOnDelete' => true,
            'disableTimestamps' => false
        ];
    }

    public function estado(){
        return $this->belongsTo(EstadoReporte::class);
    }

    public function servicio(){
        return $this->belongsTo(AlumnoServicio::class, 'alumno_servicio_id', 'id');
    }
}
