<?php

namespace App\Models;

use HighSolutions\EloquentSequence\Sequence;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoServicio extends Model
{
    use HasFactory, Sequence;
    protected $table = 'alumno_servicio';

    protected $fillable = [
        'clave_dgose_id',
        'alumno_id',
    ];

    public function sequence()
    {
        return [
            'group' => 'clave_dgose_id',
            'fieldName' => 'num_servicio',
            'orderFrom1' => true,
            'notUpdateOnDelete' => true,
            'disableTimestamps' => false
        ];
    }

    public function claveDGOSE(){
        return $this->hasOne(ClaveDGOSE::class, 'id', 'clave_dgose_id');
    }


    public function alumno(){
        return $this->hasOne(Alumno::class, 'id', 'alumno_id');
    }
}
