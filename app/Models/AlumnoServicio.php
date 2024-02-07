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

    public function clave_dgose(){
        return $this->belongsTo(ClaveDGOSE::class);
    }


    public function alumno(){
        return $this->belongsTo(Alumno::class);
    }

    public function solicitud_inicio(){
        return $this->hasOne(SolicitudInicio::class);
    }

    public function carta_aceptacion(){
        return $this->hasOne(CartaAceptacion::class);
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class);
    }
}
