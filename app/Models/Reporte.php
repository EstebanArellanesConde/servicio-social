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
    ];

    public function sequence(){
        return [
            'group' => 'alumno_id',
            'fieldName' => 'num_reporte',
            'orderFrom1' => true,
            'notUpdateOnDelete' => true,
            'disableTimestamps' => false
        ];
    }

    public function estado(){
        return $this->hasOne(EstadoReporte::class, 'id', 'estado_id');
    }

    public function alumno(){
        return $this->hasOne(Alumno::class, 'id', 'alumno_id');
    }
}
